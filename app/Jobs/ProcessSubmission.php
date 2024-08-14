<?php

namespace App\Jobs;

use App\DTO\SubmissionData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\SubmissionRepositoryInterface;
use App\Exceptions\SubmissionAlreadyExistsException;
use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly SubmissionData $data
    ) {}

    /**
     * Execute the job.
     *
     * @param SubmissionRepositoryInterface $submissionRepository
     * @return void
     * @throws SubmissionAlreadyExistsException
     */
    public function handle(SubmissionRepositoryInterface $submissionRepository)
    {
        try {
            // Create the submission
            $submission = $submissionRepository->createSubmission($this->data);

            // Trigger the event
            event(new SubmissionSaved($submission));

        } catch (SubmissionAlreadyExistsException $e) {
            Log::error('SubmissionAlreadyExistsException: ' . $e->getMessage());
            // You can handle the exception or rethrow it
            throw $e;
        }
    }
}
