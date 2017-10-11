<?php

namespace App\Notifications;

use App\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AlertCreatedNotification extends Notification
{
    use Queueable;

    private $alert;

    /**
     * AlertCreatedNotification constructor.
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
            ->subject("Has creado una alerta")
            ->greeting('¡Hola!')
            ->line(sprintf('Has creado una alerta de búsqueda diario en los boletines oficiales para el siguiente término: %s', $this->alert->query))
            ->line('Todos los días que encontremos en algún boletín oficial este término, te haremos llegar un mail para informarte.')
            ->line(sprintf('Podrás gestionar tus alertas desde el área privada de %s.', config('app.name')))
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
