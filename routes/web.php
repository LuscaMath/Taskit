<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = request()->user();

    $projects = Project::query()
        ->where('user_id', $user->id)
        ->withCount('tasks')
        ->withCount([
            'tasks as pending_tasks_count' => fn ($query) => $query->where('status', 'pending'),
            'tasks as in_progress_tasks_count' => fn ($query) => $query->where('status', 'in_progress'),
            'tasks as done_tasks_count' => fn ($query) => $query->where('status', 'done'),
        ])
        ->latest()
        ->take(3)
        ->get();

    $totalProjects = Project::query()->where('user_id', $user->id)->count();
    $totalTasks = Task::query()->where('user_id', $user->id)->count();
    $pendingTasks = Task::query()->where('user_id', $user->id)->where('status', 'pending')->count();
    $inProgressTasks = Task::query()->where('user_id', $user->id)->where('status', 'in_progress')->count();
    $doneTasks = Task::query()->where('user_id', $user->id)->where('status', 'done')->count();
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class);
});

require __DIR__ . '/auth.php';
