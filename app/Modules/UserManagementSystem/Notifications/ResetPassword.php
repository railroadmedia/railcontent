<?php

namespace Modules\UserManagementSystem\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends ResetPasswordBase
{
    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param string $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Musora Account Password Reset Link')
            ->view(
                'user-management-system::emails.action',
                [
                    'input' => [
                        'lines' => [
                            'We\'ve received a request to reset your password. To reset your password, click the button below.',
                            'If you did not initiate this request please contact support@musora.com',
                            'If the button does not work, copy and paste this url into your browser: ' . url()->route(
                                'platform.password.reset',
                                ['token' => $this->token, 'email' => request('email')]
                            ),
                        ],
                        'callToAction' => [
                            'text' => 'RESET PASSWORD',
                            'url' => url()->route(
                                'platform.password.reset',
                                ['token' => $this->token, 'email' => request('email')]
                            ),
                        ],
                        'logo' => 'https://musora-ui.s3.amazonaws.com/logos/musora-black.svg',
                        'brand' => ''
                    ]
                ]
            )->from('system@musora.com', 'Musora');
    }
}
