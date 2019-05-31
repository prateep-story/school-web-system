<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;

class VerifyEmail extends VerifyEmailNotification
{
    use Queueable;
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
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
        return (new MailMessage)
          ->from(env('MAIL_USERNAME'), env('APP_NAME'))
          ->greeting('เรียน '.'คุณ'.$this->name)
          ->subject('การแจ้งเตือนยืนยันที่อยู่อีเมล')
          ->line('โปรดคลิกปุ่มด้านล่างเพื่อยืนยันที่อยู่อีเมลของคุณ.')
          ->action('ยืนยันที่อยู่อีเมล', $this->verificationUrl($notifiable))
          ->line('หากคุณไม่ได้สร้างบัญชีคุณไม่จำเป็นต้องดำเนินการใดๆอีก.');
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
