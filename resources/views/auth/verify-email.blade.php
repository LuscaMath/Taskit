<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-b from-purple-100 to-white">
        <div class="w-full max-w-sm p-8 rounded-3xl shadow-lg bg-white/60 backdrop-blur-md">
            <div class="flex flex-col items-center mb-8">
                <div class="bg-indigo-500 rounded-xl p-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H3m0 0a4 4 0 014-4h2m0 0V3m0 0a4 4 0 014 4v2m0 0h2a4 4 0 014 4v2a4 4 0 01-4 4h-2" /></svg>
                </div>
                <h1 class="text-2xl font-bold tracking-wide text-indigo-900 mb-1">Verifique seu e-mail</h1>
                <p class="text-gray-500 text-sm text-center">Antes de começar, confirme seu endereço de e-mail clicando no link que enviamos para você.</p>
            </div>
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 text-center">
                    {{ __('Um novo link de verificação foi enviado para o e-mail informado no cadastro.') }}
                </div>
            @endif
            <div class="flex flex-col gap-4 mt-4">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-400 text-white font-bold text-lg shadow-md hover:from-indigo-600 hover:to-purple-500 transition">Reenviar e-mail de verificação</button>
                </form>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full py-3 rounded-xl border border-gray-300 text-indigo-600 font-semibold bg-white/80 hover:bg-gray-50 transition">Sair</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
