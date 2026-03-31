<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7a5af8]">Editar tarefa</p>
            <h2 class="mt-2 text-3xl font-bold leading-tight text-[#2f2853]">Atualizar {{ $task->title }}</h2>
            <p class="mt-2 text-sm text-[#6f678e]">Revise os detalhes e mantenha o fluxo do projeto sincronizado.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[1fr_0.38fr]">
                <div class="rounded-[30px] bg-white p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.55)] ring-1 ring-[#ebe3fb] sm:p-8">
                    <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="text-sm font-semibold text-[#4d4676]">Título</label>
                            <input id="title" name="title" type="text" value="{{ old('title', $task->title) }}" required autofocus
                                class="mt-2 block w-full rounded-[18px] border-[#d9cff6] bg-[#fcfbff] px-4 py-3 text-sm text-[#2f2853] shadow-sm focus:border-[#6c63ff] focus:ring-[#6c63ff]" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <label for="description" class="text-sm font-semibold text-[#4d4676]">Descrição</label>
                            <textarea id="description" name="description" rows="5"
                                class="mt-2 block w-full rounded-[18px] border-[#d9cff6] bg-[#fcfbff] px-4 py-3 text-sm text-[#2f2853] shadow-sm focus:border-[#6c63ff] focus:ring-[#6c63ff]">{{ old('description', $task->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <label for="status" class="text-sm font-semibold text-[#4d4676]">Status</label>
                            <select id="status" name="status"
                                class="mt-2 block w-full rounded-[18px] border-[#d9cff6] bg-[#fcfbff] px-4 py-3 text-sm text-[#2f2853] shadow-sm focus:border-[#6c63ff] focus:ring-[#6c63ff]" required>
                                <option value="pending" @selected(old('status', $task->status) === 'pending')>A fazer</option>
                                <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>Em andamento</option>
                                <option value="done" @selected(old('status', $task->status) === 'done')>Concluída</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div class="flex flex-wrap items-center gap-3 pt-2">
                            <button type="submit" class="inline-flex items-center rounded-full bg-[#6c63ff] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">
                                Salvar alterações
                            </button>

                            <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="inline-flex items-center rounded-full border border-[#d9cff6] bg-white px-5 py-3 text-sm font-semibold text-[#4d4676] transition hover:bg-[#fbf9ff]">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>

                <aside class="rounded-[30px] bg-[#fcfbff] p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.4)] ring-1 ring-[#ebe3fb]">
                    <h3 class="text-lg font-bold text-[#2f2853]">Contexto da tarefa</h3>
                    <div class="mt-4 space-y-3 text-sm text-[#766f94]">
                        <div class="rounded-[20px] bg-white p-4 ring-1 ring-[#ece3fb]">
                            <p class="font-semibold text-[#2f2853]">Projeto</p>
                            <p class="mt-1">{{ $project->name }}</p>
                        </div>
                        <div class="rounded-[20px] bg-white p-4 ring-1 ring-[#ece3fb]">
                            <p class="font-semibold text-[#2f2853]">Criada em</p>
                            <p class="mt-1">{{ $task->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="rounded-[20px] bg-white p-4 ring-1 ring-[#ece3fb]">
                            <p class="font-semibold text-[#2f2853]">Dica</p>
                            <p class="mt-1">Atualize o status sempre que houver avanço real na entrega.</p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
