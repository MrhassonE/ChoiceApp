<?php

namespace App\Events;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;

class ActivityLog implements ShouldQueue
{
    use Dispatchable, Queueable;

    public $activity;
    public $by;

    public function __construct($activity, $by)
    {
        $this->activity = $activity;
        $this->by = $by;
    }

}
