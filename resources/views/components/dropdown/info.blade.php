@props([
    'title' => 'Info',
])

<p {{ $attributes->class('text-sm font-medium text-gray-900 truncate') }} role="none">
    {{ __("{$title}") }}
</p>
