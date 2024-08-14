<?php

namespace Tests\Unit;

use App\DTO\SubmissionData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Submission;
use App\Repositories\SubmissionRepository;
use App\Exceptions\SubmissionAlreadyExistsException;
use Tests\TestCase;

class SubmissionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The submission repository instance.
     *
     * @var SubmissionRepository
     */
    protected $submissionRepository;

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        # TODO add siders with dummy data
        parent::setUp();

        // Bind the repository interface to the implementation for testing
        $this->submissionRepository = $this->app->make(SubmissionRepository::class);
    }

    /**
     * Test creating a submission.
     */
    public function testCreateSubmission()
    {
        $data = $this->createSubmission();

        $submission = $this->submissionRepository->createSubmission($data);

        $this->assertInstanceOf(Submission::class, $submission);
        $this->assertEquals('John Doe', $submission->name);
        $this->assertEquals('john.doe@example.com', $submission->email);
        $this->assertEquals('This is a test message.', $submission->message);
    }

    /**
     * Test retrieving a submission by email.
     */
    public function testGetSubmissionByEmail()
    {
        $data = $this->createSubmission();

        $this->submissionRepository->createSubmission($data);

        $submission = $this->submissionRepository->getSubmissionByEmail('john.doe@example.com');

        $this->assertInstanceOf(Submission::class, $submission);
        $this->assertEquals('John Doe', $submission->name);
        $this->assertEquals('john.doe@example.com', $submission->email);
        $this->assertEquals('This is a test message.', $submission->message);
    }

    /**
     * Test creating a submission with an existing email.
     */
    public function testCreateSubmissionWithExistingEmail()
    {
        $data = $this->createSubmission();

        $this->submissionRepository->createSubmission($data);

        $this->expectException(SubmissionAlreadyExistsException::class);

        $this->submissionRepository->createSubmission($data);
    }

    /**
     * Create submission.
     *
     * @return SubmissionData
     */
    private function createSubmission()
    {
        return new SubmissionData(
            'John Doe',
            'john.doe@example.com',
            'This is a test message.',
        );
    }
}
