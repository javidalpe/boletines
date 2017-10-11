<?php

namespace App\Notifications;

use App\Alert;
use App\Services\Alerts\ReportService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AlertNotification extends Notification
{
    use Queueable;

    private $alert;

    /**
     * AlertNotification constructor.
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
        $service = new ReportService();
        $url = $service->getReportUrlForTodayAlert($this->alert);

        return (new MailMessage())
            ->subject('Tenemos una alerta para ti')
            ->greeting('¡Hola!')
            ->line(sprintf('Hemos encontrado el término -%s- en al menos uno de los boletines oficiales.', $this->alert->query))
            ->action('Ver boletines', $url)
            ->line(sprintf('Podrás gestionar tus alertas desde el área privada de %s.', config('app.name')))
            ->salutation('Saludos del equipo');
    }
}
