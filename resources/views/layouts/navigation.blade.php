@php
    $isDashboard = request()->routeIs('dashboard');
    $isProjects = request()->routeIs('projects.*');
    $userInitial = strtoupper(substr(Auth::user()->name, 0, 1));
@endphp

<nav x-data="{ open: false }" class="border-b border-[#e8defb] bg-white/80 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#6c63ff] text-lg font-bold text-white shadow-[0_12px_30px_-12px_rgba(108,99,255,0.75)]">T</span>
                    <div class="hidden sm:block">
                        <p class="text-base font-semibold text-[#2f2853]">Taskit</p>
                        <p class="text-xs text-[#7a7299]">projetos com clareza</p>
                    </div>
                </a>

                <div class="hidden items-center gap-1 rounded-full bg-[#f6f1fb] p-1 ring-1 ring-[#ece3fb] sm:flex">
                    <a href="{{ route('dashboard') }}"
                       class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $isDashboard ? 'bg-[#6c63ff] text-white shadow-[0_12px_30px_-18px_rgba(108,99,255,0.7)]' : 'text-[#6d648f] hover:text-[#2f2853]' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('projects.index') }}"
                       class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $isProjects ? 'bg-[#6c63ff] text-white shadow-[0_12px_30px_-18px_rgba(108,99,255,0.7)]' : 'text-[#6d648f] hover:text-[#2f2853]' }}">
                        Projetos
                    </a>
                </div>
            </div>

            <div class="hidden items-center gap-3 sm:flex">
                <a href="{{ route('projects.create') }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">
                    + Novo projeto
                </a>

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 rounded-full border border-[#e6dbfb] bg-white px-2.5 py-2 text-sm text-[#5c547e] shadow-sm transition hover:border-[#d5c7f7] hover:bg-[#fbf9ff] focus:outline-none">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#efe6ff] font-semibold text-[#6c63ff]">{{ $userInitial }}</span>
                            <span class="text-left">
                                <span class="block font-semibold text-[#2f2853]">{{ Auth::user()->name }}</span>
                                <span class="block text-xs text-[#7a7299]">Minha conta</span>
                            </span>
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 text-xs text-[#7a7299]">
                            {{ Auth::user()->email }}
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-2xl border border-[#e6dbfb] bg-white p-2 text-[#6c63ff] shadow-sm transition hover:bg-[#fbf9ff] focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-[#eee7fb] bg-white sm:hidden">
        <div class="space-y-2 px-4 py-4">
            <a href="{{ route('dashboard') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold {{ $isDashboard ? 'bg-[#6c63ff] text-white' : 'bg-[#f7f3ff] text-[#4d4676]' }}">
                Dashboard
            </a>
            <a href="{{ route('projects.index') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold {{ $isProjects ? 'bg-[#6c63ff] text-white' : 'bg-[#f7f3ff] text-[#4d4676]' }}">
                Projetos
            </a>
            <a href="{{ route('projects.create') }}" class="block rounded-2xl bg-[#efe6ff] px-4 py-3 text-sm font-semibold text-[#6c63ff]">
                + Novo projeto
            </a>
        </div>

        <div class="border-t border-[#eee7fb] px-4 py-4">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#efe6ff] font-semibold text-[#6c63ff]">{{ $userInitial }}</span>
                <div>
                    <div class="font-semibold text-[#2f2853]">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-[#7a7299]">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 space-y-2">
                <a href="{{ route('profile.edit') }}" class="block rounded-2xl bg-[#f7f3ff] px-4 py-3 text-sm font-semibold text-[#4d4676]">Perfil</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full rounded-2xl bg-[#f7f3ff] px-4 py-3 text-left text-sm font-semibold text-[#4d4676]">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
