<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

function createProjectFor(User $user, array $attributes = []): Project
{
    return Project::create(array_merge([
        'name' => 'Projeto Teste',
        'description' => 'Projeto criado no teste',
        'user_id' => $user->id,
    ], $attributes));
}

function createTaskFor(Project $project, User $user, array $attributes = []): Task
{
    return Task::create(array_merge([
        'title' => 'Tarefa Teste',
        'description' => 'Tarefa criada no teste',
        'status' => 'pending',
        'project_id' => $project->id,
        'user_id' => $user->id,
    ], $attributes));
}

test('user cannot view another users task list', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $project = createProjectFor($owner);

    createTaskFor($project, $owner);

    $response = $this
        ->actingAs($intruder)
        ->get(route('projects.tasks.index', $project));

    $response->assertForbidden();
});

test('user cannot create tasks in another users project', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $project = createProjectFor($owner);

    $response = $this
        ->actingAs($intruder)
        ->post(route('projects.tasks.store', $project), [
            'title' => 'Tentativa indevida',
            'description' => 'Sem permissão',
            'status' => 'pending',
        ]);

    $response->assertForbidden();

    $this->assertDatabaseMissing('tasks', [
        'project_id' => $project->id,
        'title' => 'Tentativa indevida',
    ]);
});

test('user cannot view another users task details', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $project = createProjectFor($owner);
    $task = createTaskFor($project, $owner);

    $response = $this
        ->actingAs($intruder)
        ->get(route('projects.tasks.show', [$project, $task]));

    $response->assertForbidden();
});

test('project owner can access task management pages', function () {
    $owner = User::factory()->create();
    $project = createProjectFor($owner);
    $task = createTaskFor($project, $owner);

    $this->actingAs($owner)
        ->get(route('projects.tasks.index', $project))
        ->assertOk();

    $this->actingAs($owner)
        ->get(route('projects.tasks.create', $project))
        ->assertOk();

    $this->actingAs($owner)
        ->get(route('projects.tasks.show', [$project, $task]))
        ->assertOk();

    $this->actingAs($owner)
        ->get(route('projects.tasks.edit', [$project, $task]))
        ->assertOk();
});

test('project owner can access project pages', function () {
    $owner = User::factory()->create();
    $project = createProjectFor($owner);

    $this->actingAs($owner)
        ->get(route('projects.index'))
        ->assertOk()
        ->assertSee('Meus projetos');

    $this->actingAs($owner)
        ->get(route('projects.create'))
        ->assertOk()
        ->assertSee('Novo projeto');

    $this->actingAs($owner)
        ->get(route('projects.show', $project))
        ->assertOk()
        ->assertSee($project->name);

    $this->actingAs($owner)
        ->get(route('projects.edit', $project))
        ->assertOk()
        ->assertSee('Editar projeto');
});
