<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-b from-purple-100 to-white">
        <div class="w-full max-w-sm p-8 rounded-3xl shadow-lg bg-white/60 backdrop-blur-md">
            <div class="flex flex-col items-center mb-8">
                <div class="bg-indigo-500 rounded-xl p-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H3m0 0a4 4 0 014-4h2m0 0V3m0 0a4 4 0 014 4v2m0 0h2a4 4 0 014 4v2a4 4 0 01-4 4h-2" /></svg>
                </div>
                <h1 class="text-2xl font-bold tracking-wide text-indigo-900 mb-1">Recuperar senha</h1>
                <p class="text-gray-500 text-sm text-center">Esqueceu sua senha? Informe seu e-mail e enviaremos um link para redefinição.</p>
            </div>
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-600 mb-1">EMAIL</label>
                    <input id="email" name="email" type="email" required autofocus placeholder="exemplo@taskit.com" value="{{ old('email') }}" class="w-full px-4 py-3 pl-4 rounded-xl bg-white/80 border border-gray-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none text-gray-700 placeholder-gray-400" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <button type="submit" class="w-full py-3 mt-2 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-400 text-white font-bold text-lg shadow-md hover:from-indigo-600 hover:to-purple-500 transition">Enviar link de redefinição</button>
                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Voltar para login</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
