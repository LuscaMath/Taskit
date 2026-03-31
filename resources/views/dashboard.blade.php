<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7a5af8]">Dashboard</p>
                <h2 class="mt-2 text-3xl font-bold leading-tight text-[#2f2853]">Olá, {{ auth()->user()->name }}!</h2>
                <p class="mt-2 max-w-2xl text-sm text-[#6f678e]">Prepare-se para um dia produtivo. Aqui está o resumo do que está acontecendo agora.</p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('projects.index') }}" class="rounded-full border border-[#d9cff6] bg-white px-4 py-2 text-sm font-semibold text-[#4d4676] transition hover:bg-[#fbf9ff]">
                    Ver projetos
                </a>
                <a href="{{ route('projects.create') }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">
                    Novo projeto
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded-[24px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-4 xl:grid-cols-[1.2fr_0.8fr]">
                <section class="rounded-[30px] bg-white p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.55)] ring-1 ring-[#ebe3fb] sm:p-7">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.22em] text-[#6c63ff]">Progresso geral</p>
                            <h3 class="mt-2 text-4xl font-bold text-[#2f2853] sm:text-5xl">{{ $completionRate }}%</h3>
                        </div>
                        <span class="rounded-full bg-[#efe6ff] px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-[#6c63ff]">
                            {{ $doneTasks }} concluídas
                        </span>
                    </div>

                    <p class="mt-3 max-w-xl text-sm leading-6 text-[#766f94]">
                        Você concluiu {{ $doneTasks }} de {{ $totalTasks }} tarefas cadastradas e mantém {{ $totalProjects }} projeto(s) ativo(s) na plataforma.
                    </p>

                    <div class="mt-5 h-3 overflow-hidden rounded-full bg-[#eadfff]">
                        <div class="h-full rounded-full bg-gradient-to-r from-[#6c63ff] to-[#8a7dff]" style="width: {{ $completionRate }}%"></div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-3 text-xs font-semibold uppercase tracking-[0.18em] text-[#7a7299]">
                        <span>{{ $pendingTasks }} pendentes</span>
                        <span>{{ $inProgressTasks }} em andamento</span>
                        <span>{{ $doneTasks }} concluídas</span>
                    </div>
                </section>

                <div class="grid gap-4 sm:grid-cols-3 xl:grid-cols-1">
                    <div class="rounded-[28px] bg-[#efe6ff] p-5 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.4)] ring-1 ring-[#e4d7fb]">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#7d73a8]">Projetos ativos</p>
                        <p class="mt-3 text-3xl font-bold text-[#2f2853]">{{ $totalProjects }}</p>
                        <p class="mt-1 text-sm text-[#766f94]">visão geral da sua operação</p>
                    </div>

                    <div class="rounded-[28px] bg-[#a33b79] p-5 text-white shadow-[0_24px_60px_-40px_rgba(163,59,121,0.6)]">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-white/80">Tarefas pendentes</p>
                        <p class="mt-3 text-3xl font-bold">{{ $pendingTasks }}</p>
                        <p class="mt-1 text-sm text-white/80">itens aguardando ação</p>
                    </div>

                    <div class="rounded-[28px] bg-white p-5 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.4)] ring-1 ring-[#ebe3fb]">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#7d73a8]">Em andamento</p>
                        <p class="mt-3 text-3xl font-bold text-[#2f2853]">{{ $inProgressTasks }}</p>
                        <p class="mt-1 text-sm text-[#766f94]">entregas sendo executadas</p>
                    </div>
                </div>
            </div>

            <section class="rounded-[30px] bg-white p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.55)] ring-1 ring-[#ebe3fb] sm:p-7">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-[#2f2853]">Seus projetos</h3>
                        <p class="mt-1 text-sm text-[#766f94]">Gerencie suas entregas e prazos em um visual mais claro.</p>
                    </div>

                    <a href="{{ route('projects.index') }}" class="text-sm font-semibold text-[#6c63ff] transition hover:text-[#564fd6]">
                        Ver todos os projetos
                    </a>
                </div>

                <div class="mt-5 grid gap-4 lg:grid-cols-3">
                    @forelse ($projects as $project)
                        @php
                            $progress = $project->tasks_count > 0 ? (int) round(($project->done_tasks_count / $project->tasks_count) * 100) : 0;

                            if ($project->tasks_count === 0) {
                                $label = 'Backlog';
                                $tone = 'bg-[#efe6ff] text-[#6c63ff]';
                                $bar = 'bg-[#8c82ff]';
                            } elseif ($project->done_tasks_count === $project->tasks_count) {
                                $label = 'Concluído';
                                $tone = 'bg-emerald-100 text-emerald-700';
                                $bar = 'bg-emerald-500';
                            } elseif ($project->in_progress_tasks_count > 0) {
                                $label = 'Em andamento';
                                $tone = 'bg-sky-100 text-sky-700';
                                $bar = 'bg-[#6c63ff]';
                            } else {
                                $label = 'Urgente';
                                $tone = 'bg-[#f5deeb] text-[#a33b79]';
                                $bar = 'bg-[#a33b79]';
                            }
                        @endphp

                        <article class="rounded-[26px] border-l-4 border-[#6c63ff] bg-[#fcfbff] p-5 shadow-[0_18px_45px_-38px_rgba(83,67,151,0.6)] ring-1 ring-[#eee6fc]">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <span class="rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] {{ $tone }}">{{ $label }}</span>
                                    <h4 class="mt-3 text-xl font-bold text-[#2f2853]">{{ $project->name }}</h4>
                                </div>
                                <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-[#6c63ff] ring-1 ring-[#ece3fb]">{{ $project->tasks_count }} tarefas</span>
                            </div>

                            <p class="mt-3 text-sm leading-6 text-[#766f94]">{{ $project->description ?: 'Sem descrição cadastrada.' }}</p>

                            <div class="mt-4">
                                <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.18em] text-[#7a7299]">
                                    <span>Progresso</span>
                                    <span>{{ $progress }}%</span>
                                </div>
                                <div class="mt-2 h-2 overflow-hidden rounded-full bg-[#eadfff]">
                                    <div class="h-full rounded-full {{ $bar }}" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-3 gap-2 text-center text-xs text-[#6f678e]">
                                <div class="rounded-2xl bg-white px-2 py-3 ring-1 ring-[#ece3fb]">
                                    <div class="font-bold text-[#2f2853]">{{ $project->pending_tasks_count }}</div>
                                    <div>Pend.</div>
                                </div>
                                <div class="rounded-2xl bg-white px-2 py-3 ring-1 ring-[#ece3fb]">
                                    <div class="font-bold text-[#2f2853]">{{ $project->in_progress_tasks_count }}</div>
                                    <div>Andam.</div>
                                </div>
                                <div class="rounded-2xl bg-white px-2 py-3 ring-1 ring-[#ece3fb]">
                                    <div class="font-bold text-[#2f2853]">{{ $project->done_tasks_count }}</div>
                                    <div>Done</div>
                                </div>
                            </div>

                            <div class="mt-5 flex flex-wrap gap-2">
                                <a href="{{ route('projects.show', $project) }}" class="rounded-full bg-[#6c63ff] px-3.5 py-2 text-xs font-semibold text-white transition hover:bg-[#5b56d8]">Abrir</a>
                                <a href="{{ route('projects.tasks.index', $project) }}" class="rounded-full border border-[#d9cff6] bg-white px-3.5 py-2 text-xs font-semibold text-[#4d4676] transition hover:bg-[#fbf9ff]">Tarefas</a>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[26px] border border-dashed border-[#d9cff6] bg-[#fcfbff] p-8 text-center text-[#6f678e] lg:col-span-3">
                            <h4 class="text-lg font-semibold text-[#2f2853]">Nenhum projeto cadastrado ainda</h4>
                            <p class="mt-2 text-sm">Crie seu primeiro projeto para começar a acompanhar tarefas com este novo visual.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
