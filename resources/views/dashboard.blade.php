<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form post :action="route('question.store')">
            <x-textArea label="Your question" name="question" />
            <x-btn.principal type="submit"> Save </x-btn.principal>
            <x-btn.reset type="reset"> Reset </x-btn.reset>
        </x-form>      
        <hr class="border-gray-700 border-dashed my-4">
        <div class="dark:text-gray-500 uppercase font-bold mb-1">List Questions</div>
        <div class="dark:text-gray-400"></div>
            @foreach ($questions as $question)
                <x-question :question="$question"  />
            @endforeach
        </div>
    </x-container>
</x-app-layout>
