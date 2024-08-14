<?php

namespace App\DTO;

class SubmissionData
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $message
    )
    {}

    /**
     * Create a new instance from request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return self
     */
    public static function fromRequest($request): self
    {
        return new self(
            $request->input('name'),
            $request->input('email'),
            $request->input('message')
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
