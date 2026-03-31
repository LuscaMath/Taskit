<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $this->authorizeProjectAccess($project);

        $tasks = $project->tasks()->latest()->get();

        return view("projects.tasks.index", compact("tasks", "project"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $this->authorizeProjectAccess($project);

        return view("projects.tasks.create", compact("project"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $this->authorizeProjectAccess($project);

        $data = $request->validate([
            "title" => "required|string|max:100",
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,done',
        ]);

        $data['user_id'] = Auth::id();

        $project->tasks()->create($data);

        return redirect()->route(
            'projects.tasks.index',
            $project
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Task $task)
    {
        $this->authorizeProjectAccess($project);
        $this->authorizeTaskAccess($project, $task);

        return view('projects.tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {
        $this->authorizeProjectAccess($project);
        $this->authorizeTaskAccess($project, $task);

        return view('projects.tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $this->authorizeProjectAccess($project);
        $this->authorizeTaskAccess($project, $task);

        $data = $request->validate([
            "title" => "required|string|max:100",
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,done',
        ]);

        $task->update($data);

        return redirect()->route(
            'projects.tasks.index',
            $project
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $this->authorizeProjectAccess($project);
        $this->authorizeTaskAccess($project, $task);

        $task->delete();

        return redirect()->route(
            'projects.tasks.index',
            $project
        );
    }

    private function authorizeProjectAccess(Project $project): void
    {
        abort_unless($project->user_id === Auth::id(), 403);
    }

    private function authorizeTaskAccess(Project $project, Task $task): void
    {
        abort_if($task->project_id !== $project->id, 404);
    }
}
