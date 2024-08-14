<?php

namespace App\Repositories;

use App\DTO\SubmissionData;

interface SubmissionRepositoryInterface
{
    /**
     * Get all submissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllSubmissions();

    /**
     * Get a submission by ID.
     *
     * @param  int  $id
     * @return \App\Models\Submission|null
     */
    public function getSubmissionById($id);

    /**
     * Get a submission by email.
     *
     * @param  string  $email
     * @return \App\Models\Submission|null
     */
    public function getSubmissionByEmail($email);

    /**
     * Create a new submission.
     *
     * @param  SubmissionData  $data
     * @return \App\Models\Submission
     * @throws \App\Exceptions\SubmissionAlreadyExistsException
     */
    public function createSubmission(SubmissionData $data);

    /**
     * Update an existing submission.
     *
     * @param  int  $id
     * @param  SubmissionData  $data
     * @return \App\Models\Submission|null
     */
    public function updateSubmission($id, SubmissionData $data);

    /**
     * Delete a submission.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteSubmission($id);
}
