<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Taskit | Gestão visual de projetos</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-[#f6f1fb] font-sans text-[#2f2853] antialiased">
        <div class="relative overflow-hidden">
            <div class="absolute inset-x-0 top-0 h-[420px] bg-gradient-to-br from-[#efe6ff] via-[#f8f3ff] to-[#f6f1fb]"></div>

            <header class="relative z-10 mx-auto flex max-w-6xl items-center justify-between px-4 py-5 sm:px-6 lg:px-8">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#6c63ff] text-lg font-bold text-white shadow-[0_12px_30px_-12px_rgba(108,99,255,0.7)]">T</span>
                    <div>
                        <p class="text-xl font-semibold tracking-tight">Taskit</p>
                        <p class="text-xs text-[#7a7299]">produtividade com clareza</p>
                    </div>
                </a>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-2 sm:gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">
                                Abrir dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-full border border-[#d9cff6] bg-white/80 px-4 py-2 text-sm font-semibold text-[#443b74] transition hover:bg-white">
                                Entrar
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-full bg-[#6c63ff] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#5b56d8]">
                                    Criar conta
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="relative z-10 mx-auto max-w-6xl px-4 pb-12 sm:px-6 lg:px-8 lg:pb-20">
                <section class="grid items-center gap-8 py-6 lg:grid-cols-[1.05fr_0.95fr] lg:gap-12 lg:py-10">
                    <div>
                        <span class="inline-flex rounded-full bg-[#eadfff] px-3 py-1 text-xs font-semibold uppercase tracking-[0.22em] text-[#7a5af8]">
                            Gestão visual para equipes ágeis
                        </span>

                        <h1 class="mt-5 max-w-xl text-4xl font-bold leading-tight sm:text-5xl">
                            Planeje projetos, acompanhe tarefas e entregue com mais foco.
                        </h1>

                        <p class="mt-4 max-w-xl text-base leading-7 text-[#6f678e] sm:text-lg">
                            O Taskit reúne prazos, prioridades e progresso em uma interface simples, leve e com o visual das telas que você aprovou.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-full bg-[#6c63ff] px-5 py-3 text-sm font-semibold text-white shadow-[0_18px_40px_-18px_rgba(108,99,255,0.8)] transition hover:bg-[#5b56d8]">
                                    Começar agora
                                </a>
                            @endif

                            <a href="#recursos" class="rounded-full border border-[#d9cff6] bg-white px-5 py-3 text-sm font-semibold text-[#443b74] transition hover:border-[#c7b7f4] hover:bg-[#fbf9ff]">
                                Explorar recursos
                            </a>
                        </div>

                        <div class="mt-8 grid gap-3 sm:grid-cols-3">
                            <div class="rounded-3xl bg-white p-4 shadow-[0_20px_45px_-30px_rgba(77,62,137,0.45)] ring-1 ring-[#ebe3fb]">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#8a80b5]">Progresso</p>
                                <p class="mt-2 text-3xl font-bold text-[#4f46d8]">68%</p>
                                <p class="mt-1 text-sm text-[#776f98]">visão semanal</p>
                            </div>
                            <div class="rounded-3xl bg-[#efe6ff] p-4 shadow-[0_20px_45px_-30px_rgba(77,62,137,0.35)] ring-1 ring-[#e5dafb]">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#8a80b5]">Ativos</p>
                                <p class="mt-2 text-3xl font-bold">3</p>
                                <p class="mt-1 text-sm text-[#776f98]">projetos em andamento</p>
                            </div>
                            <div class="rounded-3xl bg-[#a33b79] p-4 text-white shadow-[0_20px_45px_-30px_rgba(163,59,121,0.65)]">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/80">Pendências</p>
                                <p class="mt-2 text-3xl font-bold">12</p>
                                <p class="mt-1 text-sm text-white/80">tarefas para hoje</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[32px] bg-white p-4 shadow-[0_30px_70px_-35px_rgba(83,67,151,0.45)] ring-1 ring-[#e8defb]">
                        <div class="rounded-[28px] bg-[#f4effb] p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#9a3880]">Projeto prioritário</p>
                                    <h2 class="mt-2 text-2xl font-bold leading-tight">Redesign do Site</h2>
                                    <p class="mt-1 text-sm text-[#766f94]">Organização do fluxo e entregas do time.</p>
                                </div>
                                <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-[#6c63ff]">Taskit</span>
                            </div>

                            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                                <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-[#ece5fb]">
                                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#7d73a8]">Concluído</p>
                                    <p class="mt-2 text-3xl font-bold text-[#4f46d8]">64%</p>
                                </div>
                                <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-[#ece5fb]">
                                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#7d73a8]">Prazo</p>
                                    <p class="mt-2 text-3xl font-bold text-[#a33b79]">12 dias</p>
                                </div>
                            </div>

                            <div class="mt-5 rounded-[22px] bg-white p-2 shadow-sm ring-1 ring-[#ece5fb]">
                                <div class="grid grid-cols-3 gap-2 text-center text-sm font-medium text-[#655d87]">
                                    <span class="rounded-2xl bg-[#6c63ff] px-3 py-3 text-white">A fazer</span>
                                    <span class="rounded-2xl px-3 py-3">Em andamento</span>
                                    <span class="rounded-2xl px-3 py-3">Concluído</span>
                                </div>
                            </div>

                            <div class="mt-5 space-y-3">
                                <div class="rounded-[22px] border-l-4 border-[#6c63ff] bg-white p-4 shadow-sm ring-1 ring-[#ece5fb]">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="font-semibold">Definição da paleta de cores</p>
                                            <p class="mt-1 text-sm text-[#776f98]">Ajuste visual do produto e tokens da interface.</p>
                                        </div>
                                        <span class="rounded-full bg-[#efe6ff] px-3 py-1 text-[11px] font-semibold uppercase text-[#7a5af8]">Alta</span>
                                    </div>
                                </div>

                                <div class="rounded-[22px] border-l-4 border-[#a33b79] bg-white p-4 shadow-sm ring-1 ring-[#ece5fb]">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="font-semibold">Aprovação do wireframe mobile</p>
                                            <p class="mt-1 text-sm text-[#776f98]">Validar fluxo da landing e dashboard com o time.</p>
                                        </div>
                                        <span class="rounded-full bg-[#f5deeb] px-3 py-1 text-[11px] font-semibold uppercase text-[#a33b79]">Design</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="recursos" class="mt-6 grid gap-4 md:grid-cols-3">
                    <div class="rounded-[28px] bg-white p-6 shadow-[0_20px_50px_-35px_rgba(83,67,151,0.4)] ring-1 ring-[#ebe3fb]">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#efe6ff] text-sm font-bold text-[#6c63ff]">01</div>
                        <h3 class="text-lg font-semibold">Resumo instantâneo</h3>
                        <p class="mt-2 text-sm leading-6 text-[#766f94]">Veja progresso, projetos ativos e pendências do dia logo ao abrir a aplicação.</p>
                    </div>

                    <div class="rounded-[28px] bg-white p-6 shadow-[0_20px_50px_-35px_rgba(83,67,151,0.4)] ring-1 ring-[#ebe3fb]">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#f5deeb] text-sm font-bold text-[#a33b79]">02</div>
                        <h3 class="text-lg font-semibold">Prioridades claras</h3>
                        <p class="mt-2 text-sm leading-6 text-[#766f94]">Separe o que é urgente, o que está em andamento e o que já foi concluído.</p>
                    </div>

                    <div class="rounded-[28px] bg-white p-6 shadow-[0_20px_50px_-35px_rgba(83,67,151,0.4)] ring-1 ring-[#ebe3fb]">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#eceaff] text-sm font-bold text-[#4f46d8]">03</div>
                        <h3 class="text-lg font-semibold">Entrega com previsibilidade</h3>
                        <p class="mt-2 text-sm leading-6 text-[#766f94]">Organize responsáveis, acompanhe prazos e mantenha o time alinhado sem ruído.</p>
                    </div>
                </section>

                <section class="mt-6 rounded-[32px] bg-gradient-to-r from-[#342c62] to-[#5b56d8] px-6 py-8 text-white shadow-[0_30px_70px_-35px_rgba(67,55,134,0.8)] sm:px-8">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-white/70">Landing simples, visual forte</p>
                            <h2 class="mt-2 text-2xl font-bold sm:text-3xl">Uma apresentação direta do produto, alinhada ao dashboard e aos detalhes do projeto.</h2>
                            <p class="mt-2 text-sm leading-6 text-white/80">Ideal para receber novos usuários e encaminhar rapidamente para login ou cadastro.</p>
                        </div>

                        @if (Route::has('login'))
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('login') }}" class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#3f3675] transition hover:bg-[#f3efff]">
                                    Entrar
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="rounded-full border border-white/30 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                                        Criar conta
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
