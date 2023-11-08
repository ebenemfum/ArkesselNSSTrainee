<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        // Define the number of tasks to seed
        $numberOfTasks = 10;

        // Seed tasks for a specific user (you can change the user_id)
        $user_id = 1;

        // Create and insert tasks into the tasks table
        for ($i = 1; $i <= $numberOfTasks; $i++) {
            Task::create([
                'user_id' => $user_id,
                'title' => "Task $i",
                'completed' => false,
            ]);
        }
    }
}
