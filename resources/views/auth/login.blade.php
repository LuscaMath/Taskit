<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-b from-purple-100 to-white">
        <x-auth-card :title="'Taskit'" :subtitle="'Sua produtividade em harmonia.'">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H3m0 0a4 4 0 014-4h2m0 0V3m0 0a4 4 0 014 4v2m0 0h2a4 4 0 014 4v2a4 4 0 01-4 4h-2" />
                </svg>
            </x-slot:icon>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-600 mb-1">EMAIL</label>
                    <div class="relative">
                        <input id="email" name="email" type="email" required autofocus autocomplete="username"
                            placeholder="exemplo@taskit.com" value="{{ old('email') }}"
                            class="w-full px-4 py-3 pl-12 rounded-xl bg-white/80 border border-gray-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none text-gray-700 placeholder-gray-400" />
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12H8m8 0a4 4 0 01-8 0m8 0a4 4 0 00-8 0" />
                            </svg>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <label for="password" class="block text-xs font-semibold text-gray-600 mb-1">SENHA</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3 pl-12 rounded-xl bg-white/80 border border-gray-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none text-gray-700 placeholder-gray-400" />
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2zm0 0V7m0 4v4" />
                            </svg>
                        </span>
                        <a href="{{ route('password.request') }}"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-indigo-600 hover:underline">Esqueci
                            minha senha</a>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <button type="submit"
                    class="w-full py-3 mt-2 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-400 text-white font-bold text-lg shadow-md hover:from-indigo-600 hover:to-purple-500 transition">Entrar</button>
                <div class="text-center mt-6">
                    <span class="text-gray-500 text-sm">Novo por aqui?</span>
                    <a href="{{ route('register') }}" class="ml-1 text-indigo-600 font-semibold hover:underline">Criar
                        conta</a>
                </div>
            </form>
        </x-auth-card>
        </div>
    </div>
</x-guest-layout>
