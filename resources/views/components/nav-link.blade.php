@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out';

$style = ($active ?? false)
            ? 'color: var(--text-main); border-color: var(--primary-accent);'
            : 'color: var(--text-muted);';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} style="{{ $style }}">
    {{ $slot }}
</a>
