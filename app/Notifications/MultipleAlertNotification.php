<?php

namespace App\Notifications;

use App\Services\Alerts\ReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MultipleAlertNotification extends Notification
{
    use Queueable;

    private $alerts;

    /**
     * MultipleAlertNotification constructor.
     * @param $alerts
     */
    public function __construct(array $alerts)
    {
        $this->alerts = $alerts;
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
        $mail = (new MailMessage())
            ->subject('Tenemos varias alertas para ti')
            ->greeting('¡Hola!')
            ->line("Hemos encontrado varios términos en los boletines oficiales.");

        foreach ($this->alerts as $alert) {
            $service = new ReportService();
            $url = $service->getReportUrlForTodayAlert($alert);

            $mail = $mail->line(sprintf('El término -%s- ha aparecido en los siguientes boletines:', $alert->query))
                ->action('Ver boletines', $url);
        }

        return $mail->line(sprintf('Podrás gestionar tus alertas desde el área privada de %s.', config('app.name')))
            ->salutation('Saludos del equipo');
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
