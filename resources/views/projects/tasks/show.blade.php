<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7a5af8]">Detalhes da tarefa</p>
                <h2 class="mt-2 text-3xl font-bold leading-tight text-[#2f2853]">{{ $task->title }}</h2>
                <p class="mt-2 text-sm text-[#6f678e]">Informações completas da tarefa vinculada ao projeto {{ $project->name }}.</p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="rounded-full border border-[#d9cff6] bg-white px-4 py-2 text-sm font-semibold text-[#4d4676] transition hover:bg-[#fbf9ff]">Editar</a>
                <a href="{{ route('projects.tasks.index', $project) }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">Voltar</a>
            </div>
        </div>
    </x-slot>

    @php
        $statusLabels = [
            'pending' => 'A fazer',
            'in_progress' => 'Em andamento',
            'done' => 'Concluída',
        ];

        $statusClasses = [
            'pending' => 'bg-[#efe6ff] text-[#6c63ff]',
            'in_progress' => 'bg-sky-100 text-sky-700',
            'done' => 'bg-emerald-100 text-emerald-700',
        ];
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[1fr_0.38fr]">
                <section class="rounded-[30px] bg-white p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.55)] ring-1 ring-[#ebe3fb] sm:p-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] {{ $statusClasses[$task->status] ?? 'bg-[#f6f1fb] text-[#6d648f]' }}">
                            {{ $statusLabels[$task->status] ?? ucfirst($task->status) }}
                        </span>
                        <span class="rounded-full bg-[#f6f1fb] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#6d648f] ring-1 ring-[#ece3fb]">
                            Projeto {{ $project->name }}
                        </span>
                    </div>

                    <div class="mt-5 rounded-[24px] bg-[#fcfbff] p-5 ring-1 ring-[#ece3fb]">
                        <h3 class="text-lg font-semibold text-[#2f2853]">Descrição</h3>
                        <p class="mt-2 text-sm leading-7 text-[#766f94]">{{ $task->description ?: 'Sem descrição cadastrada.' }}</p>
                    </div>

                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-[22px] bg-[#f6f1fb] p-4 ring-1 ring-[#ece3fb]">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#7d73a8]">Criada em</p>
                            <p class="mt-2 text-base font-semibold text-[#2f2853]">{{ $task->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="rounded-[22px] bg-[#f6f1fb] p-4 ring-1 ring-[#ece3fb]">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#7d73a8]">Última atualização</p>
                            <p class="mt-2 text-base font-semibold text-[#2f2853]">{{ $task->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </section>

                <aside class="rounded-[30px] bg-[#fcfbff] p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.4)] ring-1 ring-[#ebe3fb]">
                    <h3 class="text-lg font-bold text-[#2f2853]">Ações rápidas</h3>
                    <div class="mt-4 space-y-3">
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="block rounded-[20px] bg-white px-4 py-3 text-sm font-semibold text-[#4d4676] ring-1 ring-[#ece3fb] transition hover:bg-[#fbf9ff]">
                            Editar tarefa
                        </a>
                        <a href="{{ route('projects.tasks.index', $project) }}" class="block rounded-[20px] bg-white px-4 py-3 text-sm font-semibold text-[#4d4676] ring-1 ring-[#ece3fb] transition hover:bg-[#fbf9ff]">
                            Ver todas as tarefas
                        </a>

                        <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full rounded-[20px] bg-[#fce7ef] px-4 py-3 text-left text-sm font-semibold text-[#a33b79] transition hover:bg-[#f8d9e7]">
                                Excluir tarefa
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
