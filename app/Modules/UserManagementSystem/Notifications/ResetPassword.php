<?php

namespace Modules\UserManagementSystem\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends ResetPasswordBase
{
    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return $this->buildMailMessage(''); // url not used since we have it hard coded in the function override
    }

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
                'user-management-system::emails.password-reset-email',
                [
                    'input' => [
                        'url' => url()->route(
                            'user_management_system.password.show-reset-form',
                            ['token' => $this->token, 'email' => request('email')]
                        ),
                        'logo' => 'https://musora-ui.s3.amazonaws.com/logos/musora-white.svg',
                    ]
                ]
            )->from('system@musora.com', 'Musora');
    }
}
