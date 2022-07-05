@props([
    'type' => 'submit',
    'title' => 'Button',
    'icon' => null,
])

<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'group flex items-center w-full text-left text-gray-700 hover:bg-amber-600 hover:text-white block px-4 py-2 text-sm',
    ]) }}>
    @if ($icon)
        <i class="{{ $icon }} fa-lg mr-3"></i>
    @endif
    {{ __("{$title}") }}
</button>
