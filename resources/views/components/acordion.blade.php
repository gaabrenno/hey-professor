@props(['title', 'description'])
<div class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-4 my-4 dark:text-gray-400">
    <div x-data="{ open: false }" class="w-full">
        <h2 class="text-lg font-semibold text-left">{{ $title }}</h2>

        <button @click="open = !open" class="text-gray-400 text-left w-full">
            <span x-text="open ? '{{ $description }}' : '{{ Str::limit($description, 50) }}...'"></span>
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

