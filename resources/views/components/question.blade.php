@props(['question'])
<div class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-4 my-4 dark:text-gray-400 flex justify-between items-center">
    <span>
        <h2 class="text-lg font-semibold">{{ $question->title }}</h2>
        {{ $question->question }}
        <p class="text-sm text-gray-500">{{ $question->created_at->diffForHumans() }}</p>
    </span>
    <div class="flex space-x-2">
        <x-form action="{{route('question.like', $question)}}" id="form-like-{{$question->id}}">
            <button type="submit" form="form-like-{{$question->id}}">
                <x-icon.thumbs-up class="w-5 h-h text-blue-600 hover:text-green-400 cursor-pointer" id="thumb-up"/>
                <span>{{$question->votes_sum_like ?? 0}}</span>
            </button>
        </x-form>
        <x-form action="{{route('question.unlike', $question)}}" id="form-unlike-{{$question->id}}">
            <button type="submit" form="form-unlike-{{$question->id}}">
                <x-icon.thumbs-down class="w-5 h-h text-blue-600 hover:text-red-400 cursor-pointer" id="thumb-down"/>
                <span>{{$question->votes_sum_unlike ?? 0}}</span>
            </button>
        </x-form>
    </div>
</div>
