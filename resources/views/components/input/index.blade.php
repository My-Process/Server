@props([
    'id' => null,
    'name' => 'Name',
    'type' => 'text',
    'label' => null,
    'labeless' => false,
    'value' => null,
    'placeholder' => null,
    'showEyes' => false,
])

@php
    $label = $label ?? Str::spaceTitle($name);
    $id = $id ?? $name;
    $value = old($name, $value);
    $placeholder = is_bool($placeholder) ? $label : $placeholder;
@endphp

<x-input.wrapper x-data="{ showEyes: '@js($showEyes)' }">
    @unless($labeless)
        <x-input.label :for="$name">{{ $label }}</x-input.label>
    @endunless

    <div {{ $attributes->whereStartsWith('class')->class([
        'flex items-center w-full',
        'relative' => $showEyes])
    }}>

        <input id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
            @if ($showEyes) :type="showEyes ? 'password' : 'text'" @else type="{{ $type }}" @endif
            {{ $attributes->except('class')->class([
                    'block w-full sm:text-sm rounded-md shadow-sm',
                    'mt-1' => !$labeless,
                    'border-red-300 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500' => $errors->has($name),
                    'focus:ring-amber-600 focus:border-amber-600 border-gray-300' => !$errors->has($name),
                ]) }}
            placeholder="{{ $placeholder }}" />

        @if ($showEyes)
            <x-input.eye-password />
        @endif
    </div>

    <x-input.error-message :name="$name" />
</x-input.wrapper>
