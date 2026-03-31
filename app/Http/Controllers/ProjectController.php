<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $projects = Project::query()
            ->where('user_id', $user->id)
            ->withCount('tasks')
            ->withCount([
                'tasks as pending_tasks_count' => fn ($query) => $query->where('status', 'pending'),
                'tasks as in_progress_tasks_count' => fn ($query) => $query->where('status', 'in_progress'),
                'tasks as done_tasks_count' => fn ($query) => $query->where('status', 'done'),
            ])
            ->latest()
            ->get();

        return view('projects.index', compact('projects', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();

        Project::create($data);

        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        if ($project->user_id != Auth::id()) {
            abort(403);
        }

        $project
            ->load(['tasks' => fn ($query) => $query->latest()])
            ->loadCount([
                'tasks',
                'tasks as pending_tasks_count' => fn ($query) => $query->where('status', 'pending'),
                'tasks as in_progress_tasks_count' => fn ($query) => $query->where('status', 'in_progress'),
                'tasks as done_tasks_count' => fn ($query) => $query->where('status', 'done'),
            ]);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        if ($project->user_id != Auth::id()) {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        if ($project->user_id != Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Projeto editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->user_id != Auth::id()) {
            abort(403);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projeto removido com sucesso!');
    }
}
