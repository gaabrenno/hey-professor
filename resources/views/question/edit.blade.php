<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit Question') }} :: {{ $question->id }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form put :action="route('question.update', $question)">
            <x-textArea label="Your question" name="question" :value="$question->question" />
            <x-btn.principal type="submit"> Save </x-btn.principal>
            <x-btn.reset type="reset"> Reset </x-btn.reset>
        </x-form>      
    </x-container>
</x-app-layout>
