<div class="w-full max-w-sm p-8 rounded-3xl shadow-lg bg-white/60 backdrop-blur-md">
    <div class="flex flex-col items-center mb-8">
        <div class="bg-indigo-500 rounded-xl p-4 mb-4">
            {{ $icon ?? '' }}
        </div>
        <h1 class="text-3xl font-bold tracking-wide text-indigo-900 mb-1">{{ $title }}</h1>
        <p class="text-gray-500 text-sm text-center">{{ $subtitle ?? '' }}</p>
    </div>
    <div>
        {{ $slot }}
    </div>
</div>