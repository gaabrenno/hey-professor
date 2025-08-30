@props(['question', 'anchorId' => null])
<div @if($anchorId) id="{{ $anchorId }}" @endif class="group rounded-lg border border-slate-200/60 dark:border-slate-700/60 bg-gradient-to-b from-white to-slate-50 dark:from-slate-800 dark:to-slate-900 shadow-sm hover:shadow-md transition-shadow duration-200 p-4 my-4 dark:text-gray-300">
    <div x-data="{ open: false }" class="w-full">
        <button @click="open = !open" :aria-expanded="open" class="w-full text-left">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-90 text-blue-500' : ''">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 0 1 0-1.414L10.586 10 7.293 6.707a1 1 0 1 1 1.414-1.414l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0Z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-base sm:text-lg font-semibold leading-snug truncate">{{ $question->title }}</h2>
                </div>
            </div>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400" x-show="!open">
                {{ Str::limit($question->question, 150) }}...
            </p>
        </button>

        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1" class="mt-3 text-justify prose prose-slate dark:prose-invert max-w-none">
            {!! nl2br(e($question->question)) !!}
            <p class="mt-3 text-xs text-slate-500 dark:text-slate-400">{{ $question->created_at->diffForHumans() }}</p>
        </div>
    </div>
</div>
