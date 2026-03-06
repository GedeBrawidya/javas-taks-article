@php
    $path = resource_path('img/logo.svg');
    $svg = file_exists($path) ? file_get_contents($path) : '';
@endphp

{{-- The 'block' and 'h-full w-auto' ensures the SVG fills the container we define --}}
<div {{ $attributes->merge(['class' => 'block']) }}>
    <style>
        /* This forces the internal SVG to stay within your defined box */
        svg { width: 100%; height: 100%; }
    </style>
    {!! $svg !!}
</div>