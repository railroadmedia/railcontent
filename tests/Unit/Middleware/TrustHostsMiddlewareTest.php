<?php

namespace Middleware;

use App\Http\Middleware\TrustHosts;
use App\Modules\Brand\Enums\Brand;
use Tests\TestCase;

class TrustHostsMiddlewareTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // just to be safe, set the app_url to our testing environment
        config(['app.url' => 'https://testing.musora.com']);
    }

    public function test_trust_hosts_approves_all_brands()
    {
        $hostString = 'testing.%s.com';

        foreach (Brand::cases() as $brand) {
            $host = sprintf($hostString, $brand->value);
            $this->assertTrue($this->matchesTrustHosts($host));
        }
    }

    public function test_trust_hosts_rejects_all_brands_with_different_environment()
    {
        $hostString = 'dev.%s.com';

        foreach (Brand::cases() as $brand) {
            $host = sprintf($hostString, $brand->value);
            $this->assertFalse($this->matchesTrustHosts($host));
        }
    }

    public function test_trust_hosts_rejects_attacker()
    {
        $attackers = [
            'attacker.com',
            'testing.attacker.com',
            'testing1.musora.com',
            'testing.drume0.com',
        ];

        foreach ($attackers as $attacker) {
            $this->assertFalse($this->matchesTrustHosts($attacker));
        }
    }

    public function test_trust_hosts_approves_all_brands_with_beta_testing()
    {
        // set the production app_url
        config(['app.url' => 'https://beta-testing.musora.com']);
        $hostString = 'beta-testing.%s.com';

        foreach (Brand::cases() as $brand) {
            $host = sprintf($hostString, $brand->value);
            $this->assertTrue($this->matchesTrustHosts($host));
        }
    }

    /**
     * Helper function to check if the given host would be found to match
     * any of the regex qualifiers defined in our TrustHosts middleware
     *
     * @param  string  $host
     * @return bool
     */
    private function matchesTrustHosts(string $host): bool
    {
        $trustHost = app(TrustHosts::class);
        $trustedHosts = $trustHost->hosts();
        foreach ($trustedHosts as $pattern) {
            if (preg_match("/$pattern/", $host)) {
                return true;
            }
        }
        return false;
    }
}
