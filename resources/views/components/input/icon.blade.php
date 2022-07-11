@props([
    'icon' => 'fas fa-envelope',
    'left' => null,
    'right' => null,
    'select' => null,
])

<div
    {{ $attributes->class([
        'absolute inset-y-0 flex items-center text-sm leading-5',
        'left-0 pl-3' => $left,
        'right-0 pr-3' => !$select && $right,
        'right-0 pr-8' => $select && $right,
    ]) }}>
    <i class="{{ $icon }} fa-lg text-gray-700"></i>
</div>
