<?php

namespace Edujugon\PushNotification\Channels;

use Edujugon\PushNotification\Messages\PushMessage;

class ApnChannel extends PushChannel
{
    /**
     * {@inheritdoc}
     */
    protected function pushServiceName()
    {
        return 'apn';
    }

    /**
     * {@inheritdoc}
     */
    protected function buildData(PushMessage $message)
    {
        $data = [
            'aps' => [
                'alert' => [
                    'title' => $message->title,
                    'body' => $message->body,
                ],
                'category' => $message->category,
                'sound' => $message->sound,
            ],
        ];

        if (is_numeric($message->badge)) {
            $data['aps']['badge'] = $message->badge;
        }

        if (! empty($message->extra)) {
            $data = array_merge($message->extra, $data);
        }

        return $data;
    }
}
