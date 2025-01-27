<?php

namespace Nastasin\History\Events;

use Illuminate\Queue\SerializesModels;

class ModelChanged
{
    use SerializesModels;

    public $model;

    public $message;

    public $meta;

    /**
     * Create a new event instance.
     *
     * @param  Model  $model
     * @param  string  $message
     * @param  array  $meta
     * 
     * @return void
     */
    public function __construct($model, $message, $meta = null)
    {
        $this->model = $model;
        $this->message = $message;
        $this->meta = $meta;
    }
}
