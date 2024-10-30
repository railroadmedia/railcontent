<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\ValidateRedirectUrl;
use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class ValidateRedirectUrlTest extends TestCase
{
    public function test_login_with_redirect_to_internal_url_keeps_value()
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        User::factory()->create(['email' => $email, 'password' => Hash::make($password)]);

        $redirectTo = '/guitareo/songs/king-for-a-day/408404';
        $route = url()->route('user_management_system.login', ['redirect_to' => $redirectTo]);

        $response = $this->post($route, ['email' => $email, 'password' => $password]);
        $response->assertJson(['redirect_to' => $redirectTo]);
    }

    public function test_login_with_redirect_to_external_url_drops_value()
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $user = User::factory()->create(['email' => $email, 'password' => Hash::make($password)]);

        $redirectTo = '//google.com';
        $route = url()->route('user_management_system.login', ['redirect_to' => $redirectTo]);

        $response = $this->post($route, ['email' => $email, 'password' => $password]);
        $response->assertJsonMissing(['redirect_to' => $redirectTo]);

        // when there's no redirect_to value, the AuthenticationController function uses the home page for the user's last used brand
        $brand = BrandService::getLastUsedBrand($user);
        $response->assertJson(['redirect_to' => "/$brand"]);
    }

    public function test_middleware_keeps_valid_value_for_redirect_to()
    {
        $key = 'redirect_to';
        $redirect = sprintf('%s/redirect_test', config('app.url'));
        $response = $this->makeTestRequest($key, $redirect);
        $response->assertContent(sprintf('%s:%s', $key, $redirect));
    }

    public function test_middleware_drops_invalid_value_for_redirect_to()
    {
        $key = 'redirect_to';
        $redirect = '//google.com';
        $response = $this->makeTestRequest($key, $redirect);
        $response->assertContent('');
    }

    public function test_middleware_keeps_valid_value_for_redirectTo()
    {
        $key = 'redirectTo';
        $redirect = sprintf('%s/redirect_test', config('app.url'));
        $response = $this->makeTestRequest($key, $redirect);
        $response->assertContent(sprintf('%s:%s', $key, $redirect));
    }

    public function test_middleware_drops_invalid_value_for_redirectTo()
    {
        $key = 'redirectTo';
        $redirect = '//google.com';
        $response = $this->makeTestRequest($key, $redirect);
        $response->assertContent('');
    }

    public function test_middleware_keeps_valid_value_for_redirect_to_json_requests()
    {
        $key = 'redirect_to';
        $redirect = sprintf('%s/redirect_test', config('app.url'));
        $response = $this->makeTestRequest($key, $redirect, true);
        $response->assertJson([$key => $redirect]);
    }

    public function test_middleware_drops_invalid_value_for_redirect_to_json_requests()
    {
        $key = 'redirect_to';
        $redirect = '//google.com';
        $response = $this->makeTestRequest($key, $redirect, true);
        $response->assertJsonMissing([$key => $redirect]);
        $response->assertJson([]);
    }

    public function test_middleware_keeps_valid_value_for_redirectTo_json_requests()
    {
        $key = 'redirectTo';
        $redirect = sprintf('%s/redirect_test', config('app.url'));
        $response = $this->makeTestRequest($key, $redirect, true);
        $response->assertJson([$key => $redirect]);
    }

    public function test_middleware_drops_invalid_value_for_redirectTo_json_requests()
    {
        $key = 'redirectTo';
        $redirect = '//google.com';
        $response = $this->makeTestRequest($key, $redirect, true);
        $response->assertJsonMissing([$key => $redirect]);
        $response->assertJson([]);
    }

    public function test_middleware_keeps_valid_value_for_redirect_to_internal_path()
    {
        $key = 'redirect_to';
        $redirect = '/guitareo/songs/king-for-a-day/408404';
        $response = $this->makeTestRequest($key, $redirect);
        $response->assertContent(sprintf('%s:%s', $key, $redirect));
    }

    public function test_middleware_keeps_valid_value_for_each_brand()
    {
        $key = 'redirect_to';

        $baseUrl = config('app.url');
        // this should be something like https://testing.musora.com
        $this->assertStringContainsString('musora', $baseUrl);

        $brands = array_column(Brand::cases(), 'value');
        foreach ($brands as $brand) {
            $url = Str::replaceFirst('musora', $brand, $baseUrl);
            $redirect = sprintf('%s/redirect_test', $url);
            $response = $this->makeTestRequest($key, $redirect);
            $response->assertContent(sprintf('%s:%s', $key, $redirect));
        }
    }

    public function test_middleware_keeps_valid_value_for_subdomains()
    {
        $key = 'redirect_to';
        // use a subdomain like https://api.testing.musora.com
        $baseUrl = config('app.url');
        $parsedUrl = parse_url($baseUrl);
        $host = sprintf('api.%s', $parsedUrl['host']);

        $redirect = sprintf('%s://%s/redirect_test', $parsedUrl['scheme'], $host);
        $response = $this->makeTestRequest($key, $redirect);
        $response->assertContent(sprintf('%s:%s', $key, $redirect));
    }

    /**
     * Helper function to keep the tests DRY
     */
    private function makeTestRequest(string $key, string $redirect, bool $isJson = false): TestResponse
    {
        $this->setUpTestRoute();
        $url = sprintf('%s?%s=%s', $this->testRouteName, $key, $redirect);
        if ($isJson) {
            return $this->getJson($url);
        }
        return $this->get($url);
    }

    /**
     * Set up a simple test route that works with either form of the "redirect to" key, that will return the
     * redirect to key and value as the content; for standard web requests or JSON
     *
     * @return void
     */
    private function setUpTestRoute(): void
    {
        Route::get(
            $this->testRouteName,
            function () {
                $key = null;
                $redirect = null;
                if (request()->get('redirect_to')) {
                    $key = 'redirect_to';
                    $redirect = request()->get('redirect_to');
                } elseif (request()->get('redirectTo')) {
                    $key = 'redirectTo';
                    $redirect = request()->get('redirectTo');
                }
                if ($key) {
                    $responseContent = request()->wantsJson() ? [$key => $redirect] : "$key:$redirect";
                } else {
                    $responseContent = null;
                }
                return  request()->wantsJson() ? response()->json($responseContent) : response($responseContent);
            }
        )->middleware([ValidateRedirectUrl::class]);
    }
}
