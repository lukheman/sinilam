@props([
    'icon' => null,
    'text' => '',
    'number' => '',
    'variant' => 'primary',
])

<div class="stat-card">
    <div class="fs-5 fw-semibold">{{ $number ?? ''}}</div>
    <div class="text-muted">{{ $text ?? ''}}</div>
    <i class="bi bi-{{ $icon }} icon"></i>
</div>
