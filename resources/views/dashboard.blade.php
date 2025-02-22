<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Vote for a question') }}
        </x-header>
    </x-slot>

    <x-container>
        
        <div class="dark:text-gray-400">
        <form method="GET" action="{{ route('dashboard') }}" class="flex items-center space-x-2">
            @csrf
            <x-text-input type="text" name="search" value="{{ request()->search }}" class="w-full mt-0"/>
            <x-btn.principal type="submit"> Search </x-btn.principal>
        </form>

        @if($questions->isEmpty())
        <div class="flex flex-col items-center justify-center h-full mt-10">
            <x-icon.search-null width="500"/>
            <p class="text-center text-2xl mt-5">Question not found!</p>
        </div>
        @endif
            @foreach ($questions as $question)
                <x-question :question="$question"  />
            @endforeach

            {{ $questions->withQueryString()->links() }}
        </div>
    </x-container>
</x-app-layout>
