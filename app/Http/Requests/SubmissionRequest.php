<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionRequest  extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'unique:submissions'],
            'message' => ['required', 'string', 'max:255'],
        ];
    }
}
