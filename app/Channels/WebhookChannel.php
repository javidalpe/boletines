<?php

namespace App\Channels;

use App\Services\Webhooks\WebhookService;
use Illuminate\Notifications\Notification;

class WebhookChannel
{

    private $webhookService;

    /**
     * WebhooksController constructor.
     * @param $webhookService
     */
    public function __construct(WebhookService $webhookService)
    {
        $this->webhookService = $webhookService;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWebhook($notifiable);
        $notifiable->webhooks;
        foreach ($notifiable->webhooks as $webhook) {
            $this->webhookService->sendToWebhook($webhook, $message);
        }
    }
}
