<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#7a5af8]">Novo projeto</p>
            <h2 class="mt-2 text-3xl font-bold leading-tight text-[#2f2853]">Crie uma nova entrega</h2>
            <p class="mt-2 text-sm text-[#6f678e]">Defina nome e contexto do projeto para começar a organizar tarefas com clareza.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[1fr_0.38fr]">
                <div class="rounded-[30px] bg-white p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.55)] ring-1 ring-[#ebe3fb] sm:p-8">
                    <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="text-sm font-semibold text-[#4d4676]">Nome do projeto</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                                class="mt-2 block w-full rounded-[18px] border-[#d9cff6] bg-[#fcfbff] px-4 py-3 text-sm text-[#2f2853] shadow-sm focus:border-[#6c63ff] focus:ring-[#6c63ff]" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <label for="description" class="text-sm font-semibold text-[#4d4676]">Descrição</label>
                            <textarea id="description" name="description" rows="6"
                                class="mt-2 block w-full rounded-[18px] border-[#d9cff6] bg-[#fcfbff] px-4 py-3 text-sm text-[#2f2853] shadow-sm focus:border-[#6c63ff] focus:ring-[#6c63ff]">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex flex-wrap items-center gap-3 pt-2">
                            <button type="submit" class="inline-flex items-center rounded-full bg-[#6c63ff] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">
                                Salvar projeto
                            </button>

                            <a href="{{ route('projects.index') }}" class="inline-flex items-center rounded-full border border-[#d9cff6] bg-white px-5 py-3 text-sm font-semibold text-[#4d4676] transition hover:bg-[#fbf9ff]">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>

                <aside class="rounded-[30px] bg-[#fcfbff] p-6 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.4)] ring-1 ring-[#ebe3fb]">
                    <h3 class="text-lg font-bold text-[#2f2853]">Boas práticas</h3>
                    <ul class="mt-4 space-y-3 text-sm text-[#766f94]">
                        <li class="rounded-[20px] bg-white p-4 ring-1 ring-[#ece3fb]">Use um nome curto e fácil de reconhecer.</li>
                        <li class="rounded-[20px] bg-white p-4 ring-1 ring-[#ece3fb]">Explique o objetivo do projeto na descrição.</li>
                        <li class="rounded-[20px] bg-white p-4 ring-1 ring-[#ece3fb]">Depois, adicione tarefas para visualizar o progresso.</li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
