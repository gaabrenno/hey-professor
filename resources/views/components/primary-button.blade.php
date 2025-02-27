<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-500 transition']) }}>
    {{ $slot }}
</button>
