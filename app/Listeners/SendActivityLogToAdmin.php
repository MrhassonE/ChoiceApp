<?php

namespace App\Listeners;

use App\Events\ActivityLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivityLogToAdmin implements ShouldQueue
{
    use Queueable;

    public function handle(ActivityLog $event)
    {
        \App\Models\ActivityLog::create([
            'activity'=>$event->activity,
            'user_id'=>$event->by,
        ]);
    }
}
