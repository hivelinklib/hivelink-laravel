<?php

namespace Hivelink\Laravel\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Hivelink\Laravel\Channel\HivelinkChannel;
use Hivelink\Laravel\Message\HivelinkMessage;

class HivelinkBaseNotification extends Notification
{

    /**
     * Get the notification's delivery channel.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['hivelink'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Hivelink\Laravel\Message\HivelinkMessage
     */
    public function toHivelink($notifiable)
    {
        return new HivelinkMessage();
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}