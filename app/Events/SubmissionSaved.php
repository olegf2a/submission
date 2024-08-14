<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Submission;

class SubmissionSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private readonly Submission $submission
    )
    { }

    /**
     * @return Submission
     */
    public function getSubmission(): Submission
    {
        return $this->submission;
    }
}
