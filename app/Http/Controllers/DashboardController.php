<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $projects = Project::query()
            ->whereBelongsTo($user)
            ->withCount('tasks')
            ->withCount([
                'tasks as pending_tasks_count' => fn ($query) => $query->where('status', 'pending'),
                'tasks as in_progress_tasks_count' => fn ($query) => $query->where('status', 'in_progress'),
                'tasks as done_tasks_count' => fn ($query) => $query->where('status', 'done'),
            ])
            ->latest()
            ->take(3)
            ->get();

        $taskStats = Task::query()
            ->whereBelongsTo($user)
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending")
            ->selectRaw("SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) as in_progress")
            ->selectRaw("SUM(CASE WHEN status = 'done' THEN 1 ELSE 0 END) as done")
            ->first();

        $totalProjects = Project::query()->whereBelongsTo($user)->count();
        $totalTasks = (int) ($taskStats->total ?? 0);
        $pendingTasks = (int) ($taskStats->pending ?? 0);
        $inProgressTasks = (int) ($taskStats->in_progress ?? 0);
        $doneTasks = (int) ($taskStats->done ?? 0);
        $completionRate = $totalTasks > 0 ? (int) round(($doneTasks / $totalTasks) * 100) : 0;

        return view('dashboard', compact(
            'projects',
            'totalProjects',
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'doneTasks',
            'completionRate'
        ));
    }
}
