<?php

namespace Modules\UserManagementSystem\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;

class ResetPassword extends ResetPasswordBase
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'user-management-system::emails.action',
            [
                'input' => [
                    'lines' => [
                    'We\'ve received a request to reset your password. To reset your password, click the button below.',
                    'If you did not initiate this request please contact support@pianote.com',
                    'If the button does not work, copy and paste this url into your browser: ' . url()->route(
                        'platform.password.reset',
                        ['token' => $this->token, 'email' => request('email')]),
                    ],
                    'callToAction' => [
                        'text' => 'RESET PASSWORD',
                        'url' => url()->route(
                            'platform.password.reset',
                            ['token' => $this->token, 'email' => request('email')]
                        ),
                    ],
                    'logo' => 'https://musora-center.s3.amazonaws.com/logos/pianote-logo-red.png',
                    'brand' => 'pianote'
                ]
            ]
        )->from('system@musora.com', 'Musora');
    }
}
