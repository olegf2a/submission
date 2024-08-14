<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\SubmissionSaved  $event
     * @return void
     */
    public function handle(SubmissionSaved $event): void
    {
        /** @var \App\Models\Submission $submission */
        $submission  = $event->getSubmission();
        Log::info('Submission saved: ', ['name' => $submission->name, 'email' => $submission->email]);
    }
}
