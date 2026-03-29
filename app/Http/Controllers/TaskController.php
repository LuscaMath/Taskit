<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $tasks = $project->tasks()->get();

        return view("projects.tasks.index", compact("tasks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view("projects.tasks.create", compact("project"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            "title"=> "required|string|max:100",
            'description' => 'nullable|string',
            'status' => 'required|string'
        ]);

        $data['user_id'] = auth()->id();

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
        if ($task->project_id !== $project->id) {
            abort(404);
        }
        return view('projects.tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {
        if ($task->project_id !== $project->id) {
            abort(404);
        }
        return view('projects.tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        if ($task->project_id !== $project->id) {
            abort(404);
        }

        $data = $request->validate([
            "title"=> "required|string|max:100",
            'description' => 'nullable|string',
            'status' => 'required|string'
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
        if ($task->project_id !== $project->id) {
            abort(404);
        }

        $task->delete();

        return redirect()->route(
            'projects.tasks.index',
            $project
        ); 
    }
}
