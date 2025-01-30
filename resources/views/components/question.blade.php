@props(['question'])
<div class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-4 my-4 dark:text-gray-400">
    {{ $question->question }}
    <p class="text-sm text-gray-500">{{ $question->created_at->diffForHumans() }}</p>
</div>
