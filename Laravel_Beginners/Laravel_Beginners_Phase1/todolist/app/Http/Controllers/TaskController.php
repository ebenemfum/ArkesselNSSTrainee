<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'user_id' => auth()->id(), // Assuming you have user authentication
            'title' => $request->title,
            'completed' => false,
        ]);

        return redirect()->route('tasks.index');
    }

    public function markAsCompleted(Task $task)
    {
        $task->markAsCompleted();
        return redirect()->back();
    }

    public function markAsIncomplete(Task $task)
    {
        $task->markAsIncomplete();
        return redirect()->back();
    }
}
