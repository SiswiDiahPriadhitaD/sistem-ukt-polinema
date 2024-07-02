<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;

class AddCustomHeadersToEmail
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Mail\Events\MessageSending  $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        $event->message->getHeaders()->addTextHeader('X-Company', 'My Company');
        $event->message->getHeaders()->addTextHeader('X-Additional-Header', 'HeaderValue');
    }
}
