<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\DTO\SubmissionData;
use Illuminate\Http\Request;

class SubmissionDataTest extends TestCase
{
    /**
     * Test creating a DTO from request data.
     *
     * @return void
     */
    public function testFromRequest()
    {
        $request = new Request([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ]);

        $dto = SubmissionData::fromRequest($request);

        $this->assertEquals('John Doe', $dto->getName());
        $this->assertEquals('john.doe@example.com', $dto->getEmail());
        $this->assertEquals('This is a test message.', $dto->getMessage());
    }

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
