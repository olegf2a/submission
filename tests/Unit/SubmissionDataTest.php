<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\DTO\SubmissionData;

class SubmissionDataTest extends TestCase
{
    /**
     * Test converting the DTO to an array.
     *
     * @return void
     */
    public function testToArray()
    {
        $dto = new SubmissionData('John Doe', 'john.doe@example.com', 'This is a test message.');
        $array = $dto->toArray();

        $this->assertEquals([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ], $array);
    }
}
