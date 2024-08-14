<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\DTO\SubmissionData;
use App\Jobs\ProcessSubmission;
use App\Repositories\SubmissionRepositoryInterface;

/**
 * @OA\Info(
 *     title="Laravel API",
 *     version="1.0.0"
 * )
 */
class SubmissionController extends Controller
{
    public function __construct(
        private readonly SubmissionRepositoryInterface $submissionRepository
    ) {}

    /**
     * Handle the incoming request.
     *
     * @OA\Post(
     *     path="/api/v1/submit",
     *     operationId="submit",
     *     tags={"Submissions"},
     *     summary="Submit a new entry",
     *     description="Handles the submission of a new entry",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *             @OA\Property(property="message", type="string", example="This is a test message.")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Submission received!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    public function submit(Request $request)
    {
        $submissionData = SubmissionData::fromRequest($request);
        if ($this->submissionRepository->getSubmissionByEmail($submissionData->getEmail())) {
            return response()->json(['error' => 'The submission with this email already exists.'], 400);
        }

        try {
            ProcessSubmission::dispatch($submissionData);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['message' => 'Submission received!'], 200);
    }
}
