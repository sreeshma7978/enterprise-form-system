<?php

namespace App\Listeners;

use App\Events\FormSubmitted;
use Illuminate\Support\Facades\Log;

class SendSubmissionNotification
{
    public function handle(FormSubmitted $event)
    {
        Log::info('New Form Submission ID: '.$event->submission->id);
    }
}