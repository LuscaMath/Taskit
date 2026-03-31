<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#9a3880]">Detalhes do projeto</p>
                <h2 class="mt-2 text-3xl font-bold leading-tight text-[#2f2853]">{{ $project->name }}</h2>
                <p class="mt-2 max-w-2xl text-sm text-[#6f678e]">Acompanhe o andamento, revise prioridades e navegue pelas tarefas com o novo visual.</p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('projects.edit', $project) }}" class="rounded-full border border-[#d9cff6] bg-white px-4 py-2 text-sm font-semibold text-[#4d4676] transition hover:bg-[#fbf9ff]">Editar projeto</a>
                <a href="{{ route('projects.tasks.create', $project) }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">+ Nova tarefa</a>
            </div>
        </div>
    </x-slot>

    @php
        $progress = $project->tasks_count > 0 ? (int) round(($project->done_tasks_count / $project->tasks_count) * 100) : 0;

        if ($project->tasks_count === 0) {
            $projectLabel = 'Backlog';
            $projectTone = 'bg-[#efe6ff] text-[#6c63ff]';
            $projectBorder = 'border-[#8c82ff]';
        } elseif ($project->done_tasks_count === $project->tasks_count) {
            $projectLabel = 'Concluído';
            $projectTone = 'bg-emerald-100 text-emerald-700';
            $projectBorder = 'border-emerald-500';
        } elseif ($project->in_progress_tasks_count > 0) {
            $projectLabel = 'Em andamento';
            $projectTone = 'bg-sky-100 text-sky-700';
            $projectBorder = 'border-[#6c63ff]';
        } else {
            $projectLabel = 'Prioritário';
            $projectTone = 'bg-[#f5deeb] text-[#a33b79]';
            $projectBorder = 'border-[#a33b79]';
        }

        $statusLabels = [
            'pending' => 'A fazer',
            'in_progress' => 'Em andamento',
            'done' => 'Concluído',
        ];

        $statusClasses = [
            'pending' => 'border-[#6c63ff] bg-[#fcfbff] text-[#6c63ff]',
            'in_progress' => 'border-[#8c82ff] bg-[#f7f4ff] text-[#5a54d4]',
            'done' => 'border-emerald-500 bg-emerald-50 text-emerald-700',
        ];
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded-[24px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
                <section class="rounded-[30px] bg-white p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.55)] ring-1 ring-[#ebe3fb] sm:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.22em] text-[#9a3880]">Projeto prioritário</p>
                            <h3 class="mt-2 text-3xl font-bold text-[#2f2853]">{{ $project->name }}</h3>
                            <p class="mt-3 max-w-2xl text-sm leading-6 text-[#766f94]">{{ $project->description ?: 'Sem descrição cadastrada.' }}</p>
                        </div>

                        <span class="rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] {{ $projectTone }}">{{ $projectLabel }}</span>
                    </div>

                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-[22px] bg-[#f6f1fb] p-4 ring-1 ring-[#ece3fb]">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#7d73a8]">Concluído</p>
                            <p class="mt-2 text-3xl font-bold text-[#4f46d8]">{{ $progress }}%</p>
                        </div>
                        <div class="rounded-[22px] bg-[#f6f1fb] p-4 ring-1 ring-[#ece3fb]">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#7d73a8]">Criado em</p>
                            <p class="mt-2 text-2xl font-bold text-[#a33b79]">{{ $project->created_at->format('d/m') }}</p>
                            <p class="mt-1 text-sm text-[#766f94]">{{ $project->created_at->format('Y') }}</p>
                        </div>
                    </div>

                    <div class="mt-5 h-3 overflow-hidden rounded-full bg-[#eadfff]">
                        <div class="h-full rounded-full bg-gradient-to-r from-[#6c63ff] to-[#8a7dff]" style="width: {{ $progress }}%"></div>
                    </div>

                    <div class="mt-5 rounded-[22px] bg-[#f6f1fb] p-2 ring-1 ring-[#ece3fb]">
                        <div class="grid grid-cols-3 gap-2 text-center text-sm font-medium text-[#655d87]">
                            <div class="rounded-2xl bg-white px-3 py-3 ring-1 ring-[#ece3fb]">
                                <div class="font-bold text-[#2f2853]">{{ $project->pending_tasks_count }}</div>
                                <div class="mt-1 text-xs uppercase tracking-[0.18em] text-[#7a7299]">A fazer</div>
                            </div>
                            <div class="rounded-2xl bg-white px-3 py-3 ring-1 ring-[#ece3fb]">
                                <div class="font-bold text-[#2f2853]">{{ $project->in_progress_tasks_count }}</div>
                                <div class="mt-1 text-xs uppercase tracking-[0.18em] text-[#7a7299]">Andamento</div>
                            </div>
                            <div class="rounded-2xl bg-white px-3 py-3 ring-1 ring-[#ece3fb]">
                                <div class="font-bold text-[#2f2853]">{{ $project->done_tasks_count }}</div>
                                <div class="mt-1 text-xs uppercase tracking-[0.18em] text-[#7a7299]">Concluído</div>
                            </div>
                        </div>
                    </div>
                </section>

                <aside class="rounded-[30px] border-l-4 {{ $projectBorder }} bg-[#fcfbff] p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.45)] ring-1 ring-[#ebe3fb] sm:p-7">
                    <h3 class="text-xl font-bold text-[#2f2853]">Visão rápida</h3>
                    <p class="mt-2 text-sm leading-6 text-[#766f94]">Use esta área para navegar entre as ações principais do projeto.</p>

                    <div class="mt-5 space-y-3">
                        <div class="rounded-[22px] bg-white p-4 ring-1 ring-[#ece3fb]">
                            <p class="text-sm font-semibold text-[#2f2853]">Gerenciar tarefas</p>
                            <p class="mt-1 text-sm text-[#766f94]">Abra a lista completa e organize as prioridades do time.</p>
                        </div>
                        <div class="rounded-[22px] bg-white p-4 ring-1 ring-[#ece3fb]">
                            <p class="text-sm font-semibold text-[#2f2853]">Atualizar projeto</p>
                            <p class="mt-1 text-sm text-[#766f94]">Revise título, descrição e mantenha as informações alinhadas.</p>
                        </div>
                        <div class="rounded-[22px] bg-white p-4 ring-1 ring-[#ece3fb]">
                            <p class="text-sm font-semibold text-[#2f2853]">Criar nova entrega</p>
                            <p class="mt-1 text-sm text-[#766f94]">Adicione uma tarefa e categorize o status em segundos.</p>
                        </div>
                    </div>

                    <div class="mt-5 flex flex-wrap gap-2">
                        <a href="{{ route('projects.tasks.index', $project) }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">Ver tarefas</a>
                        <a href="{{ route('projects.edit', $project) }}" class="rounded-full border border-[#d9cff6] bg-white px-4 py-2 text-sm font-semibold text-[#4d4676] transition hover:bg-[#fbf9ff]">Editar</a>
                    </div>
                </aside>
            </div>

            <section class="rounded-[30px] bg-white p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.55)] ring-1 ring-[#ebe3fb] sm:p-7">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-[#2f2853]">Tarefas do projeto</h3>
                        <p class="mt-1 text-sm text-[#766f94]">Lista visual das tarefas vinculadas a este projeto.</p>
                    </div>

                    <a href="{{ route('projects.tasks.create', $project) }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">
                        + Adicionar tarefa
                    </a>
                </div>

                <div class="mt-5 space-y-3">
                    @forelse ($project->tasks as $task)
                        <article class="rounded-[24px] border-l-4 {{ $statusClasses[$task->status] ?? 'border-[#d9cff6] bg-[#fcfbff] text-[#4d4676]' }} p-4 shadow-[0_14px_40px_-36px_rgba(83,67,151,0.55)] ring-1 ring-[#ece3fb]">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h4 class="text-lg font-semibold text-[#2f2853]">{{ $task->title }}</h4>
                                        <span class="rounded-full bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#6d648f] ring-1 ring-[#ece3fb]">
                                            {{ $statusLabels[$task->status] ?? ucfirst($task->status) }}
                                        </span>
                                    </div>
                                    <p class="mt-2 text-sm leading-6 text-[#766f94]">{{ $task->description ?: 'Sem descrição cadastrada.' }}</p>
                                    <p class="mt-2 text-xs font-medium uppercase tracking-[0.18em] text-[#8a80b5]">Criada {{ $task->created_at->diffForHumans() }}</p>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="rounded-full bg-white px-3.5 py-2 text-xs font-semibold text-[#4d4676] ring-1 ring-[#d9cff6] transition hover:bg-[#fbf9ff]">Ver</a>
                                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="rounded-full bg-[#efe6ff] px-3.5 py-2 text-xs font-semibold text-[#6c63ff] transition hover:bg-[#e5d9ff]">Editar</a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[24px] border border-dashed border-[#d9cff6] bg-[#fcfbff] p-8 text-center text-[#6f678e]">
                            <h4 class="text-lg font-semibold text-[#2f2853]">Ainda não há tarefas vinculadas</h4>
                            <p class="mt-2 text-sm">Crie a primeira tarefa para começar a acompanhar o fluxo deste projeto.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
