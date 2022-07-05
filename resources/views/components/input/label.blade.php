@props(['for'])

<label for="{{ $for }}"
    {{ $attributes->class([
        'block font-semibold text-sm',
        'text-gray-700' => !$errors->has($for),
        'text-red-500' => $errors->has($for),
    ]) }}>
    {{ $slot }}
</label>
