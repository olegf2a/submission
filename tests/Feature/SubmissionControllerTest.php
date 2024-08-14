<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use App\Models\Submission;

class SubmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test submitting a valid message.
     *
     * @return void
     */
    public function testSubmitValidMessage()
    {
        Queue::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $response = $this->postJson('/api/v1/submit', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Submission received!']);

    }

    /**
     * Test submitting an invalid message.
     *
     * @return void
     */
    public function testSubmitInvalidMessage()
    {
        $data = [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ];

        $response = $this->postJson('/api/v1/submit', $data);

        $response->assertStatus(422)
            ->assertJsonStructure(['errors' => ['name', 'email', 'message']]);
    }

    /**
     * Test submitting a message with an existing email.
     *
     * @return void
     */
    public function testSubmitMessageWithExistingEmail()
    {
        // Create an existing submission
        Submission::create([
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'message' => 'Existing message.',
        ]);

        $data = [
            'name' => 'John Doe',
            'email' => 'existing@example.com',
            'message' => 'This is a new test message.',
        ];

        $response = $this->postJson('/api/v1/submit', $data);

        $response->assertStatus(400)
            ->assertJson(['error' => 'The submission with this email already exists.']);
    }
}
