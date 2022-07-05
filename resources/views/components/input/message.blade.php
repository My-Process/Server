@props([
    'name' => null,
    'message' => null,
])

<p {{ $attributes->class([
        'px-1 mt-1 text-xs',
        'text-gray-500' => !$errors->has($name),
        'text-red-400' => $errors->has($name),
    ]) }}>
    {{ $message }}
</p>
