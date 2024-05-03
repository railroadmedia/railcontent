<?php

namespace Modules\UserManagementSystem\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\UserManagementSystem\Models\User;

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

        return $this->buildMailMessage('');
    }

    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param string $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        $user = User::where('email', request('email'))->first();

        return (new MailMessage())
            ->subject('Musora Account Password Reset Link')
            ->view(
                'user-management-system::emails.general-email',
                [
                    'input' => [
                        'line-one' => "We've received a request to reset your password. To reset your password, click the button below. ",
                        'button-name' => 'Reset Password',
                        'url' => url()->route(
                            'user_management_system.password.show-reset-form',
                            ['token' => $this->token, 'email' => request('email')]
                        ),
                        'logo' => 'https://www.musora.com/musora-cdn/image/width=400,quality=85/https://musora-web-platform.s3.amazonaws.com/musora/logo.png',
                        'display-name' => $user->display_name
                    ]
                ]
            )->from('system@musora.com', 'Musora');
    }
}
