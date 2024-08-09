<?php

namespace Modules\UserManagementSystem\Notifications;

use Closure;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailChange extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable): array
    {
        return config('user_management_system.email_change_notification_channel');
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return $this->buildMailMessage();

    }

    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage(): MailMessage
    {
        return (new MailMessage())
            ->subject('Musora Account Email Change Link')
            ->view(
                'user-management-system::emails.general-email',
                [
                    'input' => [
                        'line-one' => "You are receiving this email because we received an email change request for your account.  ",
                        'request-email-change' => true,
                        'button-name' => 'Confirm Email Change',
                        'url' => url()->route('user_management_system.email-change.confirm', ['code' => $this->token]),
                        'logo' => 'https://www.musora.com/musora-cdn/image/width=400,quality=85/https://musora-web-platform.s3.amazonaws.com/musora/logo.png',
                        'display-name' => user()->display_name
                    ]
                ]
            )
            ->from('support@musora.com', 'Musora');
    }


    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure $callback
     * @return void
     */
    public static function toMailUsing(Closure $callback): void
    {
        static::$toMailCallback = $callback;
    }
}
