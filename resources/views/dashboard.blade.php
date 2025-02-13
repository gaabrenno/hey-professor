<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>
        <div class="dark:text-gray-400"></div>
            @foreach ($questions as $question)
                <x-question :question="$question"  />
            @endforeach

            {{$questions->links()}}
        </div>
    </x-container>
</x-app-layout>
