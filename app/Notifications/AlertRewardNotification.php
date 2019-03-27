<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AlertRewardNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $money = money_format('%.2n', config('mgm.rewards.inviter'));
        return (new MailMessage)
            ->subject(sprintf("Felicidades, has ganado %s de descuento", $money))
            ->greeting('Hola!')
            ->line(sprintf('Un amigo tuyo ha creado su primera alerta. Como agradecimiento por recomendarnos, te hemos hecho un descuento de %s en tu cuenta.', $money))
            ->action('Accede a tu cuenta', route('account.index'))
            ->salutation('Gracias por confiar en nosotros.');
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
