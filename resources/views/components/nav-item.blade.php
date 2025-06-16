@props(['active' => false, 'icon' => 'activity'])

@php
    $classes = ($active ?? false) ? 'nav-link active' : 'nav-link';
@endphp

<li><a {{ $attributes->merge(['class' => $classes])}} ><i class="bi bi-{{ $icon }}"></i>{{ $slot }}</a></li>
