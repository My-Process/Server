@props([
    // Sizes - options: xs, sm, md, lg, xl, 2xl, 3xl
    'size' => 'md',
    // Colors - options: tailwind default color palette
    'color' => 'amber',
    // Font
    'bold' => null,
    // Colors
    'secondary' => null,
    'outline' => null,
    'gradient' => null,
    // Type
    'href' => null,
    'type' => 'button',
])

@php
    $primary = !$secondary && !$outline && !$gradient;

    $classes = [
        'inline-flex items-center shadow-sm rounded-md',
        'focus:outline-none focus:ring-2 focus:ring-offset-2' => !$gradient,
        'border border-transparent' => !$outline && !$gradient,
        'border-2' => $outline,
        'font-medium' => !$bold,
        'font-bold' => $bold,

        // Sizes
        'px-2.5 py-1.5 text-xs' => $size == 'xs',
        'px-3 py-2 text-sm leading-4' => $size == 'sm',
        'px-4 py-2 text-sm' => $size == 'md',
        'px-4 py-2 text-base' => $size == 'lg',
        'px-6 py-3 text-base' => $size == 'xl',
        'px-7 py-4 text-lg' => $size == '2xl',
        'px-8 py-5 text-2xl' => $size == '3xl',

        // Primary Color
        'text-white bg-slate-600 hover:bg-slate-900 focus:ring-slate-900' => $primary && $color == 'slate',
        'text-white bg-gray-600 hover:bg-gray-900 focus:ring-gray-900' => $primary && $color == 'gray',
        'text-white bg-zinc-600 hover:bg-zinc-900 focus:ring-zinc-900' => $primary && $color == 'zinc',
        'text-white bg-neutral-600 hover:bg-neutral-900 focus:ring-neutral-900' => $primary && $color == 'neutral',
        'text-white bg-stone-600 hover:bg-stone-900 focus:ring-stone-900' => $primary && $color == 'stone',
        'text-white bg-red-600 hover:bg-red-900 focus:ring-red-900' => $primary && $color == 'red',
        'text-white bg-orange-600 hover:bg-orange-900 focus:ring-orange-900' => $primary && $color == 'orange',
        'text-white bg-amber-600 hover:bg-amber-900 focus:ring-amber-900' => $primary && $color == 'amber',
        'text-white bg-yellow-600 hover:bg-yellow-900 focus:ring-yellow-900' => $primary && $color == 'yellow',
        'text-white bg-lime-600 hover:bg-lime-900 focus:ring-lime-900' => $primary && $color == 'lime',
        'text-white bg-green-600 hover:bg-green-900 focus:ring-green-900' => $primary && $color == 'green',
        'text-white bg-emerald-600 hover:bg-emerald-900 focus:ring-emerald-900' => $primary && $color == 'emerald',
        'text-white bg-teal-600 hover:bg-teal-900 focus:ring-teal-900' => $primary && $color == 'teal',
        'text-white bg-cyan-600 hover:bg-cyan-900 focus:ring-cyan-900' => $primary && $color == 'cyan',
        'text-white bg-sky-600 hover:bg-sky-900 focus:ring-sky-900' => $primary && $color == 'sky',
        'text-white bg-blue-600 hover:bg-blue-900 focus:ring-blue-900' => $primary && $color == 'blue',
        'text-white bg-indigo-600 hover:bg-indigo-900 focus:ring-indigo-900' => $primary && $color == 'indigo',
        'text-white bg-violet-600 hover:bg-violet-900 focus:ring-violet-900' => $primary && $color == 'violet',
        'text-white bg-purple-600 hover:bg-purple-900 focus:ring-purple-900' => $primary && $color == 'purple',
        'text-white bg-fuchsia-600 hover:bg-fuchsia-900 focus:ring-fuchsia-900' => $primary && $color == 'fuchsia',
        'text-white bg-pink-600 hover:bg-pink-900 focus:ring-pink-900' => $primary && $color == 'pink',
        'text-white bg-rose-600 hover:bg-rose-900 focus:ring-rose-900' => $primary && $color == 'rose',

        // Secondary Color
        'text-slate-800 bg-slate-100 hover:bg-slate-300 focus:ring-slate-900' => $secondary && $color == 'slate',
        'text-gray-800 bg-gray-100 hover:bg-gray-300 focus:ring-gray-900' => $secondary && $color == 'gray',
        'text-zinc-800 bg-zinc-100 hover:bg-zinc-300 focus:ring-zinc-900' => $secondary && $color == 'zinc',
        'text-neutral-800 bg-neutral-100 hover:bg-neutral-300 focus:ring-neutral-900' => $secondary && $color == 'neutral',
        'text-stone-800 bg-stone-100 hover:bg-stone-300 focus:ring-stone-900' => $secondary && $color == 'stone',
        'text-red-800 bg-red-100 hover:bg-red-300 focus:ring-red-900' => $secondary && $color == 'red',
        'text-orange-800 bg-orange-100 hover:bg-orange-300 focus:ring-orange-900' => $secondary && $color == 'orange',
        'text-amber-800 bg-amber-100 hover:bg-amber-300 focus:ring-amber-900' => $secondary && $color == 'amber',
        'text-yellow-800 bg-yellow-100 hover:bg-yellow-300 focus:ring-yellow-900' => $secondary && $color == 'yellow',
        'text-lime-800 bg-lime-100 hover:bg-lime-300 focus:ring-lime-900' => $secondary && $color == 'lime',
        'text-green-800 bg-green-100 hover:bg-green-300 focus:ring-green-900' => $secondary && $color == 'green',
        'text-emerald-800 bg-emerald-100 hover:bg-emerald-300 focus:ring-emerald-900' => $secondary && $color == 'emerald',
        'text-teal-800 bg-teal-100 hover:bg-teal-300 focus:ring-teal-900' => $secondary && $color == 'teal',
        'text-cyan-800 bg-cyan-100 hover:bg-cyan-300 focus:ring-cyan-900' => $secondary && $color == 'cyan',
        'text-sky-800 bg-sky-100 hover:bg-sky-300 focus:ring-sky-900' => $secondary && $color == 'sky',
        'text-blue-800 bg-blue-100 hover:bg-blue-300 focus:ring-blue-900' => $secondary && $color == 'blue',
        'text-indigo-800 bg-indigo-100 hover:bg-indigo-300 focus:ring-indigo-900' => $secondary && $color == 'indigo',
        'text-violet-800 bg-violet-100 hover:bg-violet-300 focus:ring-violet-900' => $secondary && $color == 'violet',
        'text-purple-800 bg-purple-100 hover:bg-purple-300 focus:ring-purple-900' => $secondary && $color == 'purple',
        'text-fuchsia-800 bg-fuchsia-100 hover:bg-fuchsia-300 focus:ring-fuchsia-900' => $secondary && $color == 'fuchsia',
        'text-pink-800 bg-pink-100 hover:bg-pink-300 focus:ring-pink-900' => $secondary && $color == 'pink',
        'text-rose-800 bg-rose-100 hover:bg-rose-300 focus:ring-rose-900' => $secondary && $color == 'rose',

        // Outline Color
        'text-slate-900 bg-slate-100 border-slate-900 hover:text-white hover:bg-slate-900 focus:ring-slate-900' => $outline && $color == 'slate',
        'text-gray-900 bg-gray-100 border-gray-900 hover:text-white hover:bg-gray-900 focus:ring-gray-900' => $outline && $color == 'gray',
        'text-zinc-900 bg-zinc-100 border-zinc-900 hover:text-white hover:bg-zinc-900 focus:ring-zinc-900' => $outline && $color == 'zinc',
        'text-neutral-900 bg-neutral-100 border-neutral-900 hover:text-white hover:bg-neutral-900 focus:ring-neutral-900' => $outline && $color == 'neutral',
        'text-stone-900 bg-stone-100 border-stone-900 hover:text-white hover:bg-stone-900 focus:ring-stone-900' => $outline && $color == 'stone',
        'text-red-900 bg-red-100 border-red-900 hover:text-white hover:bg-red-900 focus:ring-red-900' => $outline && $color == 'red',
        'text-orange-900 bg-orange-100 border-orange-900 hover:text-white hover:bg-orange-900 focus:ring-orange-900' => $outline && $color == 'orange',
        'text-amber-900 bg-amber-100 border-amber-900 hover:text-white hover:bg-amber-900 focus:ring-amber-900' => $outline && $color == 'amber',
        'text-yellow-900 bg-yellow-100 border-yellow-900 hover:text-white hover:bg-yellow-900 focus:ring-yellow-900' => $outline && $color == 'yellow',
        'text-lime-900 bg-lime-100 border-lime-900 hover:text-white hover:bg-lime-900 focus:ring-lime-900' => $outline && $color == 'lime',
        'text-green-900 bg-green-100 border-green-900 hover:text-white hover:bg-green-900 focus:ring-green-900' => $outline && $color == 'green',
        'text-emerald-900 bg-emerald-100 border-emerald-900 hover:text-white hover:bg-emerald-900 focus:ring-emerald-900' => $outline && $color == 'emerald',
        'text-teal-900 bg-teal-100 border-teal-900 hover:text-white hover:bg-teal-900 focus:ring-teal-900' => $outline && $color == 'teal',
        'text-cyan-900 bg-cyan-100 border-cyan-900 hover:text-white hover:bg-cyan-900 focus:ring-cyan-900' => $outline && $color == 'cyan',
        'text-sky-900 bg-sky-100 border-sky-900 hover:text-white hover:bg-sky-900 focus:ring-sky-900' => $outline && $color == 'sky',
        'text-blue-900 bg-blue-100 border-blue-900 hover:text-white hover:bg-blue-900 focus:ring-blue-900' => $outline && $color == 'blue',
        'text-indigo-900 bg-indigo-100 border-indigo-900 hover:text-white hover:bg-indigo-900 focus:ring-indigo-900' => $outline && $color == 'indigo',
        'text-violet-900 bg-violet-100 border-violet-900 hover:text-white hover:bg-violet-900 focus:ring-violet-900' => $outline && $color == 'violet',
        'text-purple-900 bg-purple-100 border-purple-900 hover:text-white hover:bg-purple-900 focus:ring-purple-900' => $outline && $color == 'purple',
        'text-fuchsia-900 bg-fuchsia-100 border-fuchsia-900 hover:text-white hover:bg-fuchsia-900 focus:ring-fuchsia-900' => $outline && $color == 'fuchsia',
        'text-pink-900 bg-pink-100 border-pink-900 hover:text-white hover:bg-pink-900 focus:ring-pink-900' => $outline && $color == 'pink',
        'text-rose-900 bg-rose-100 border-rose-900 hover:text-white hover:bg-rose-900 focus:ring-rose-900' => $outline && $color == 'rose',

        // Gradient Color
        'text-white bg-gradient-to-r from-slate-400 to-slate-900 hover:from-slate-900 hover:to-slate-400' => $gradient && $color == 'slate',
        'text-white bg-gradient-to-r from-gray-400 to-gray-900 hover:from-gray-900 hover:to-gray-400' => $gradient && $color == 'gray',
        'text-white bg-gradient-to-r from-zinc-400 to-zinc-900 hover:from-zinc-900 hover:to-zinc-400' => $gradient && $color == 'zinc',
        'text-white bg-gradient-to-r from-neutral-400 to-neutral-900 hover:from-neutral-900 hover:to-neutral-400' => $gradient && $color == 'neutral',
        'text-white bg-gradient-to-r from-stone-400 to-stone-900 hover:from-stone-900 hover:to-stone-400' => $gradient && $color == 'stone',
        'text-white bg-gradient-to-r from-red-400 to-red-900 hover:from-red-900 hover:to-red-400' => $gradient && $color == 'red',
        'text-white bg-gradient-to-r from-orange-400 to-orange-900 hover:from-orange-900 hover:to-orange-400' => $gradient && $color == 'orange',
        'text-white bg-gradient-to-r from-amber-400 to-amber-900 hover:from-amber-900 hover:to-amber-400' => $gradient && $color == 'amber',
        'text-white bg-gradient-to-r from-yellow-400 to-yellow-900 hover:from-yellow-900 hover:to-yellow-400' => $gradient && $color == 'yellow',
        'text-white bg-gradient-to-r from-lime-400 to-lime-900 hover:from-lime-900 hover:to-lime-400' => $gradient && $color == 'lime',
        'text-white bg-gradient-to-r from-green-400 to-green-900 hover:from-green-900 hover:to-green-400' => $gradient && $color == 'green',
        'text-white bg-gradient-to-r from-emerald-400 to-emerald-900 hover:from-emerald-900 hover:to-emerald-400' => $gradient && $color == 'emerald',
        'text-white bg-gradient-to-r from-teal-400 to-teal-900 hover:from-teal-900 hover:to-teal-400' => $gradient && $color == 'teal',
        'text-white bg-gradient-to-r from-cyan-400 to-cyan-900 hover:from-cyan-900 hover:to-cyan-400' => $gradient && $color == 'cyan',
        'text-white bg-gradient-to-r from-sky-400 to-sky-900 hover:from-sky-900 hover:to-sky-400' => $gradient && $color == 'sky',
        'text-white bg-gradient-to-r from-blue-400 to-blue-900 hover:from-blue-900 hover:to-blue-400' => $gradient && $color == 'blue',
        'text-white bg-gradient-to-r from-indigo-400 to-indigo-900 hover:from-indigo-900 hover:to-indigo-400' => $gradient && $color == 'indigo',
        'text-white bg-gradient-to-r from-violet-400 to-violet-900 hover:from-violet-900 hover:to-violet-400' => $gradient && $color == 'violet',
        'text-white bg-gradient-to-r from-purple-400 to-purple-900 hover:from-purple-900 hover:to-purple-400' => $gradient && $color == 'purple',
        'text-white bg-gradient-to-r from-fuchsia-400 to-fuchsia-900 hover:from-fuchsia-900 hover:to-fuchsia-400' => $gradient && $color == 'fuchsia',
        'text-white bg-gradient-to-r from-pink-400 to-pink-900 hover:from-pink-900 hover:to-pink-400' => $gradient && $color == 'pink',
        'text-white bg-gradient-to-r from-rose-400 to-rose-900 hover:from-rose-900 hover:to-rose-400' => $gradient && $color == 'rose',
    ];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif
