@props(['label', 'name', 'value' => null])
<div class="mb-4">
        <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{$label}}
        </label>
        <textarea name="{{$name}}" id="{{$name}}" rows="4" class="block p-2.5 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'" placeholder="Write your question here...">{{old($name, $value)}}</textarea>
    </div>

    @error($name)
    <div class="text-red-500 mb-4 text-sm">
    {{$message}}
    </div>
    @enderror