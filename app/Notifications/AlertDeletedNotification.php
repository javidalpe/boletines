<?php

namespace App\Notifications;

use App\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AlertDeletedNotification extends Notification
{
    use Queueable;

    private $alert;

    /**
     * AlertDeletedNotification constructor.
     * @param $alert
     */
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
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
            ->subject("Has borrado una alerta")
            ->greeting('¡Hola!')
            ->line(sprintf('Has dado de baja la alerta para el término: %s', $this->alert->query))
            ->line(sprintf('No te enviáremos ninguna alerta mas relacionada con este término. Si quieres volver
             a activar esta u otra alerta, podrás hacerlo desde tu área privada de %s.', config('app.name')))
            ->salutation('Saludos del equipo.');
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
