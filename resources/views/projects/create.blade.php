<x-layout title="Séries">
    <form action="{{ route('projects.store') }}" method="post" class="max-w-2xl">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="name">Nome do Projeto:</label>
                <input id="name" autofocus type="text" name="name" placeholder="Nome do Projeto"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="description">Descrição do
                    Projeto:</label>
                <input id="description" type="text" name="description" placeholder="Descrição do Projeto"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors" />
            </div>
        </div>

        <button type="submit"
            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
            Adicionar
        </button>
    </form>
</x-layout>
