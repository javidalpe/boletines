<?php

namespace App\Notifications;

use App\Services\Invitations\InvitationService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class YouHaveBeenInvitedNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * YouHaveBeenInvitedNotification constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $service = new InvitationService;
        $url = $service->getInvitationUrl($this->user);

        return (new MailMessage)
                    ->subject(sprintf("Invitación a %s", config('app.name')))
                    ->greeting("¡Hola!")
                    ->line(sprintf("Tu amigo %s te ha regalado una alerta gratis en %s.", $this->user->name, config('app.name')))
                    ->line(sprintf("%s es el único buscador que te permite, desde un único sitio, buscar en el Boletín Oficial del Estado, en el Diario Oficial de la Unión Europea, en el Boletín Oficial del Registro Mercantil, en los Boletines Oficiales de las Comunidades Autónomas y en todos los boletines provinciales y de ayuntamientos de España.",
                        config('app.name')))
                    ->line(sprintf('Las alertas de %s te permiten supervisar los boletines automáticamente y recibir avisos.', config('app.name')))
                    ->line('Para solicitar tu alerta gratis, crea una cuenta a través del siguiente enlace.')
                    ->action('Crear una cuenta', $url)
                    ->salutation('Saludos');
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
