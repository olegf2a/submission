<?php

namespace App\DTO;

use App\Http\Requests\SubmissionRequest;

class SubmissionData
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $message
    )
    {}

    public static function fromRequest(SubmissionRequest $request): static
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            message: $request->validated('message'),
        );
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Convert the DTO to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];
    }
}
