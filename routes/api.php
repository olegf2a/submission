<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;

Route::group(['prefix' => 'v1'], function () {
    Route::post('/submit', [SubmissionController::class, 'submit'])->middleware(\App\Http\Middleware\ValidateSubmission::class);
});
