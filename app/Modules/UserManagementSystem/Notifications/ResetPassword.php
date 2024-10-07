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
     */
    public function toMail($notifiable): MailMessage
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return $this->buildMailMessage('');
    }

    /**
     * @inheritDoc
     */
    protected function buildMailMessage($url): MailMessage
    {
        $user = User::where('email', request('email'))->first();
        $token = encodeURISub($this->token);
        $email = encodeURISub(request('email'));
        $resetURL = "https://www.musora.com/user-management-system/password/password-reset-form?token=$token&email=$email";
        return (new MailMessage())
            ->subject('Musora Account Password Reset Link')
            ->view(
                'user-management-system::emails.general-email',
                [
                    'input' => [
                        'line-one' => "We've received a request to reset your password. To reset your password, click the button below. ",
                        'button-name' => 'Reset Password',
                        'url' => $resetURL,
                        'logo' => 'https://www.musora.com/musora-cdn/image/width=400,quality=85/https://musora-web-platform.s3.amazonaws.com/musora/logo.png',
                        'display-name' => $user->display_name
                    ]
                ]
            )->from('system@musora.com', 'Musora');
    }
}
