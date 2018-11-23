<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class AuditingListener
{
    /**
     * Handle the event.
     *
     * @param  object  $model
     * @return void
     */
    public function handle($model)
    {
        if (property_exists($model, 'created_by')) {
            $model->created_by = Auth::user();
        }
    }
}
