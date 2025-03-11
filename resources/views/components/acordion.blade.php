@props(['title', 'description'])
<div class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-4 my-4 dark:text-gray-400 flex justify-between items-center">
    <div x-data="{ open: false }" class="w-full">
        <button @click="open = !open" class="w-[98%] mx-auto block px-4 py-2 text-center text-lg font-medium text-white bg-blue-500 rounded-lg focus:outline-none dark:bg-gray-700 dark:text-gray-300">
            {{ $title }}
        </button>

        <div x-show="open" class="px-4 pt-2 pb-2 text-gray-400">
            {{ $description }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
