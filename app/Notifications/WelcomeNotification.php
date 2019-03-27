<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
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
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(sprintf("Bienvenido a %s", config('app.name')))
            ->greeting(sprintf("Bienvenido a %s!", config('app.name')))
            ->line('Te has registrado correctamente.')
            ->line(sprintf('%s te permitirte buscar cada día en todos los boletines oficiales de 
            España. Nuestro motor de búsqueda es gratuito y puedes usarlo todas las veces que lo necesites. Pero si 
            quieres que busquemos por tí automáticamente todos los días y te avisemos cuando encontremos un resultado 
            de búsqueda nuevo, %s ofrece un sistema de alertas.', config('app.name'), config('app.name')))
            ->action("Crea tu primera alerta", route('alerts.create'))
            ->salutation("Saludos del equipo");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
