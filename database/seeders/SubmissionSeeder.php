<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Submission;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Submission::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ]);

        Submission::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'message' => 'Another test message.'
        ]);
    }
}
