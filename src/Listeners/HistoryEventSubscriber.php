<?php

namespace Nastasin\History\Listeners;

use Nastasin\History\Events\ModelChanged;
use Nastasin\History\HistoryObserver;
use Nastasin\History\History;

class HistoryEventSubscriber
{
    /**
     * Handle the event.
     *
     * @param  ModelChanged  $event
     * @return void
     */
    public function onModelChanged($event)
    {
        if(!HistoryObserver::filter(null)) return;

        $event->model->morphMany(History::class, 'model')->create([
            'message' => $event->message,
            'meta' => $event->meta,
            'user_id' => HistoryObserver::getUserID(),
            'user_type' => HistoryObserver::getUserType(),
            'performed_at' => time(),
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \Nastasin\History\Events\ModelChanged::class,
            static::class.'@onModelChanged'
        );
    }
}
