<?php

namespace Hivelink\Laravel\Channel;

use Hivelink\HivelinkApi;
use Hivelink\Laravel\Message\HivelinkMessage;
use \Hivelink\Laravel\Facade as Hivelink;

class HivelinkChannel
{
    /**
     * The Hivelink client instance.
     *
     * @var Hivelink\HivelinkApi
     */
    protected $hivelink;

    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * Create a new Hivelink channel instance.
     *
     * @param Hivelink\HivelinkApi $hivelink
     * @param string $from
     * @return void
     */
    public function __construct(HivelinkApi $hivelink, $from = null)
    {
        $this->from = $from;
        $this->hivelink = $hivelink;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return \Hivelink\Laravel\Message\HivelinkMessage
     */
    public function send($notifiable, $notification)
    {
        $message = $notification->toHivelink($notifiable);

        $message->to($message->to ?: $notifiable->routeNotificationFor('hivelink', $notification));
        if (!$message->to || !($message->from || $message->method)) {
            return;
        }

        return $message->method ?
            $this->verifyLookup($message) :
            Hivelink::Send($message->from, $message->to, $message->content);
    }

    public function verifyLookup(HivelinkMessage $message)
    {
        $token2  = isset($message->tokens[1]) ? $message->tokens[1] : null;
        $token3  = isset($message->tokens[2]) ? $message->tokens[2] : null;
        $token10 = isset($message->tokens[3]) ? $message->tokens[3] : null;
        $token20 = isset($message->tokens[4]) ? $message->tokens[4] : null;
        return Hivelink::VerifyLookup($message->to, $message->tokens[0], $token2, $token3, $message->method, null, $token10, $token20);
    }
}