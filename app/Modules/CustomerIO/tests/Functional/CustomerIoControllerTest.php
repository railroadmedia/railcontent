<?php

namespace App\Modules\CustomerIO\tests\Functional;

use App\Modules\CustomerIO\tests\CustomerIoTestCase;

class CustomerIoControllerTest extends CustomerIoTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_submit_email_form_failed_validation()
    {
        $this->post('customer-io/submit-email-form');

        $this->assertEquals("The email field is required.", session()->get('errors')->get('email')[0]);
        $this->assertEquals("The form name field is required.", session()->get('errors')->get('form_name')[0]);
    }

    public function test_submit_email_form_success_form_redirect()
    {
        $email = $this->faker->email;
        $formName = 'Blog Signup';
        $redirectUrl = $this->faker->url;

        config(['customer-io.brand' => 'singeo']);
        $response = $this->post('customer-io/submit-email-form', ['email' => $email, 'form_name' => $formName, 'success_redirect' => $redirectUrl]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect($redirectUrl);
    }

    public function test_submit_email_invalid_form()
    {
        $email = $this->faker->email;
        $formName = 'Invalid Form Name';
        $redirectUrl = $this->faker->url;

        config(['customer-io.brand' => 'singeo']);
        $response = $this->post('customer-io/submit-email-form', ['email' => $email, 'form_name' => $formName, 'success_redirect' => $redirectUrl]);

        $this->assertEquals("The selected form name is invalid.", session()->get('errors')->get('form_name')[0]);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
