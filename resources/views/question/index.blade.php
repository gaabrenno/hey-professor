<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Questions') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form post :action="route('question.store')">
            <x-textArea label="Your question" name="question" />
            <x-btn.principal type="submit"> Save </x-btn.principal>
            <x-btn.reset type="reset"> Reset </x-btn.reset>
        </x-form>      
        <hr class="border-gray-700 border-dashed my-4">
        @if($questions->isEmpty() && $archivedQuestions->isEmpty())
        <div class="flex flex-col items-center justify-center h-full mt-10">
            <x-icon.not-found class="w-1/2 md:w-1/3 lg:w-1/4"/>
            <p class="text-center dark:text-gray-500 uppercase font-bold mb-1 mt-5">We don't have anything here yet!</p>
        </div>
        @endif
        
        @if($questions->where('draft', true)->isNotEmpty())
        <div class="dark:text-gray-500 uppercase font-bold mb-1">My Draft</div>
        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>Question</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach ($questions->where('draft', true) as $question)
                    <x-table.tr>
                        <x-table.td style="max-width: 500px; width: 100%;">
                            {{ $question->question }}
                        </x-table.td>
                        <x-table.td>
                            <x-form delete onsubmit="return confirm('Are you sure?')" :action="route('question.destroy', $question)" >
                                <button type="submit" class="hover:underline hover:text-red-400 text-blue-500"> 
                                    Delete
                                </button>
                            </x-form>
                            <x-form put :action="route('question.publish', $question)" >
                                <button type="submit" class="hover:underline hover:text-green-400 text-blue-500"> 
                                    Publish
                                </button>
                            </x-form>
                            <a href="{{ route('question.edit', $question) }}" class="hover:underline hover:text-blue-400 text-blue-500"> 
                                Edit
                            </a>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </tbody>
        </x-table>
        <hr class="border-gray-700 border-dashed my-4">
        @endif
        
        @if ($questions->where('draft', false)->isNotEmpty())
        <div class="dark:text-gray-500 uppercase font-bold mb-1">My Questions</div>
        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>Question</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach ($questions->where('draft', false) as $question)
                    <x-table.tr>
                        <x-table.td style="max-width: 500px; width: 100%;">
                            {{ $question->question }}
                        </x-table.td>
                        <x-table.td>
                            <x-form delete onsubmit="return confirm('Are you sure?')" :action="route('question.destroy', $question)" >
                                <button type="submit" class="hover:underline hover:text-red-400 text-blue-500"> 
                                    Delete
                                </button>
                            </x-form>
                            <x-form patch :action="route('question.archive', $question)" >
                                <button type="submit" class="hover:underline hover:text-yellow-400 text-blue-500"> 
                                    Archive
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </tbody>
        </x-table>
        <hr class="border-gray-700 border-dashed my-4">
        @endif

        @if ($archivedQuestions->isNotEmpty())
        <div class="dark:text-gray-500 uppercase font-bold mb-1">Archive Questions</div>
        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>Question</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach ($archivedQuestions as $question)
                    <x-table.tr>
                        <x-table.td style="max-width: 500px; width: 100%;">
                            {{ $question->question }}
                        </x-table.td>
                        <x-table.td>
                            <x-form patch :action="route('question.restore', $question)" >
                                <button type="submit" class="hover:underline hover:text-green-400 text-blue-500"> 
                                    Restore
                                </button>
                            </x-form>
                            <x-form delete onsubmit="return confirm('Are you sure?')" :action="route('question.destroy', $question)" >
                                <button type="submit" class="hover:underline hover:text-red-400 text-blue-500"> 
                                    Delete
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </tbody>
        </x-table>
        @endif
    </x-container>
</x-app-layout>
