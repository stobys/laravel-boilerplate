<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

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
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this -> token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $result1 = (new MailMessage)
        //     -> view(
        //         'auth.passwords.reset-link',
        //         ['token' => $this->token]
        //     )
        //     -> subject(__('Reset Password Notification'));

        // $result2 = (new MailMessage)
        //                     ->line('The introduction to the notification.')
        //                     ->action('Notification Action', url('/'))
        //                     ->line('Thank you for using our application!');

        return (new MailMessage)
            -> subject(Lang::getFromJson('Reset Password Notification'))
            -> line(Lang::getFromJson('You are receiving this email because we received a password reset request for your account.'))
            -> action(Lang::getFromJson('Reset Password'), url(config('app.url').route('password-reset-token', ['token' => $this->token], false)))
            -> line(Lang::getFromJson('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
            -> line(Lang::getFromJson('If you did not request a password reset, no further action is required.'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
