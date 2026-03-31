<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7a5af8]">Tarefas do projeto</p>
                <h2 class="mt-2 text-3xl font-bold leading-tight text-[#2f2853]">{{ $project->name }}</h2>
                <p class="mt-2 text-sm text-[#6f678e]">Organize o fluxo entre tarefas a fazer, em andamento e concluídas.</p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('projects.show', $project) }}" class="rounded-full border border-[#d9cff6] bg-white px-4 py-2 text-sm font-semibold text-[#4d4676] transition hover:bg-[#fbf9ff]">Voltar ao projeto</a>
                <a href="{{ route('projects.tasks.create', $project) }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">+ Nova tarefa</a>
            </div>
        </div>
    </x-slot>

    @php
        $statusMeta = [
            'pending' => [
                'label' => 'A fazer',
                'chip' => 'bg-[#efe6ff] text-[#6c63ff]',
                'border' => 'border-[#6c63ff]',
                'panel' => 'bg-[#fcfbff]',
            ],
            'in_progress' => [
                'label' => 'Em andamento',
                'chip' => 'bg-sky-100 text-sky-700',
                'border' => 'border-sky-400',
                'panel' => 'bg-[#f9fbff]',
            ],
            'done' => [
                'label' => 'Concluído',
                'chip' => 'bg-emerald-100 text-emerald-700',
                'border' => 'border-emerald-500',
                'panel' => 'bg-[#fbfffd]',
            ],
        ];

        $groupedTasks = [
            'pending' => $tasks->where('status', 'pending'),
            'in_progress' => $tasks->where('status', 'in_progress'),
            'done' => $tasks->where('status', 'done'),
        ];
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded-[24px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-[28px] bg-white p-5 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.45)] ring-1 ring-[#ebe3fb]">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#7d73a8]">A fazer</p>
                    <p class="mt-3 text-3xl font-bold text-[#2f2853]">{{ $groupedTasks['pending']->count() }}</p>
                </div>
                <div class="rounded-[28px] bg-[#efe6ff] p-5 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.35)] ring-1 ring-[#e4d7fb]">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#7d73a8]">Em andamento</p>
                    <p class="mt-3 text-3xl font-bold text-[#2f2853]">{{ $groupedTasks['in_progress']->count() }}</p>
                </div>
                <div class="rounded-[28px] bg-white p-5 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.45)] ring-1 ring-[#ebe3fb]">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#7d73a8]">Concluídas</p>
                    <p class="mt-3 text-3xl font-bold text-[#2f2853]">{{ $groupedTasks['done']->count() }}</p>
                </div>
            </div>

            @if ($tasks->isEmpty())
                <div class="rounded-[30px] border border-dashed border-[#d9cff6] bg-[#fcfbff] p-10 text-center shadow-[0_20px_50px_-40px_rgba(83,67,151,0.45)]">
                    <h3 class="text-xl font-semibold text-[#2f2853]">Nenhuma tarefa cadastrada</h3>
                    <p class="mt-2 text-sm text-[#766f94]">Adicione a primeira tarefa deste projeto para começar a acompanhar o andamento.</p>
                </div>
            @else
                <section class="grid gap-4 xl:grid-cols-3">
                    @foreach (['pending', 'in_progress', 'done'] as $status)
                        @php
                            $meta = $statusMeta[$status];
                            $items = $groupedTasks[$status];
                        @endphp

                        <div class="rounded-[28px] {{ $meta['panel'] }} p-4 shadow-[0_24px_60px_-42px_rgba(83,67,151,0.45)] ring-1 ring-[#ebe3fb]">
                            <div class="flex items-center justify-between gap-3 rounded-[22px] bg-white px-4 py-3 ring-1 ring-[#ece3fb]">
                                <div>
                                    <p class="text-sm font-semibold text-[#2f2853]">{{ $meta['label'] }}</p>
                                    <p class="text-xs text-[#766f94]">{{ $items->count() }} tarefa(s)</p>
                                </div>
                                <span class="rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] {{ $meta['chip'] }}">{{ $items->count() }}</span>
                            </div>

                            <div class="mt-4 space-y-3">
                                @forelse ($items as $task)
                                    <article class="rounded-[22px] border-l-4 {{ $meta['border'] }} bg-white p-4 shadow-[0_14px_40px_-36px_rgba(83,67,151,0.55)] ring-1 ring-[#ece3fb]">
                                        <h3 class="text-base font-semibold text-[#2f2853]">{{ $task->title }}</h3>
                                        <p class="mt-2 text-sm leading-6 text-[#766f94]">{{ $task->description ?: 'Sem descrição cadastrada.' }}</p>
                                        <p class="mt-2 text-xs font-medium uppercase tracking-[0.18em] text-[#8a80b5]">Criada {{ $task->created_at->diffForHumans() }}</p>

                                        <div class="mt-4 flex flex-wrap gap-2">
                                            <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="rounded-full bg-white px-3.5 py-2 text-xs font-semibold text-[#4d4676] ring-1 ring-[#d9cff6] transition hover:bg-[#fbf9ff]">Ver</a>
                                            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="rounded-full bg-[#efe6ff] px-3.5 py-2 text-xs font-semibold text-[#6c63ff] transition hover:bg-[#e5d9ff]">Editar</a>

                                            <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-full bg-[#fce7ef] px-3.5 py-2 text-xs font-semibold text-[#a33b79] transition hover:bg-[#f8d9e7]">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </article>
                                @empty
                                    <div class="rounded-[22px] border border-dashed border-[#d9cff6] bg-white p-5 text-sm text-[#766f94]">
                                        Nenhuma tarefa nesta etapa.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
