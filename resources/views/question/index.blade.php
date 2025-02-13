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
                        <x-table.td>
                            {{ $question->question }}
                        </x-table.td>
                        <x-table.td>
                            <x-form delete :action="route('question.destroy', $question)" >
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
        </x-table>

        <hr class="border-gray-700 border-dashed my-4">
        
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
                        <x-table.td>
                            {{ $question->question }}
                        </x-table.td>
                        <x-table.td>
                            <x-form delete :action="route('question.destroy', $question)" >
                                <button type="submit" class="hover:underline hover:text-red-400 text-blue-500"> 
                                    Delete
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
        </x-table>

        <!-- <div class="dark:text-gray-400"></div>
            @foreach ($questions as $question)
                <x-question :question="$question"  />
            @endforeach
        </div> -->
    </x-container>
</x-app-layout>
