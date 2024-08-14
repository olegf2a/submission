<?php

namespace App\Repositories;

use App\DTO\SubmissionData;
use App\Models\Submission;
use App\Exceptions\SubmissionAlreadyExistsException;

class SubmissionRepository implements SubmissionRepositoryInterface
{
    /**
     * Get all submissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllSubmissions()
    {
        return Submission::all();
    }

    /**
     * Get a submission by ID.
     *
     * @param  int  $id
     * @return \App\Models\Submission|null
     */
    public function getSubmissionById($id)
    {
        return Submission::find($id);
    }

    /**
     * Get a submission by email.
     *
     * @param  string  $email
     * @return \App\Models\Submission|null
     */
    public function getSubmissionByEmail($email)
    {
        return Submission::where('email', $email)->first();
    }

    /**
     * Create a new submission.
     *
     * @param  SubmissionData  $data
     * @return \App\Models\Submission
     * @throws \App\Exceptions\SubmissionAlreadyExistsException
     */
    public function createSubmission(SubmissionData $data)
    {
        $existingSubmission = $this->getSubmissionByEmail($data->getEmail());
        if ($existingSubmission) {
            throw new SubmissionAlreadyExistsException();
        }
        return Submission::create($data->toArray());
    }

    /**
     * Update an existing submission.
     *
     * @param  int  $id
     * @param  SubmissionData  $data
     * @return \App\Models\Submission|null
     */
    public function updateSubmission($id, SubmissionData $data)
    {
        $submission = Submission::find($id);
        if ($submission) {
            $submission->update($data->toArray());
            return $submission;
        }
        return null;
    }

    /**
     * Delete a submission.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteSubmission($id)
    {
        $submission = Submission::find($id);
        if ($submission) {
            return $submission->delete();
        }
        return false;
    }
}
