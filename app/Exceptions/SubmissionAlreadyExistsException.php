<?php

namespace App\Exceptions;

use Exception;

class SubmissionAlreadyExistsException extends Exception
{
    protected $message = 'A submission with this email already exists.';
}
