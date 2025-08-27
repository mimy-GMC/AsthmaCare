@props(['level' => 'info', 'dismissible' => false])

@php
    $classes = [
        'info' => 'health-alert-info',
        'success' => 'health-alert-success',
        'warning' => 'health-alert-warning',
        'danger' => 'health-alert-danger',
        'low' => 'badge-low',
        'medium' => 'badge-medium',
        'high' => 'badge-high'
    ][$level] ?? 'health-alert-info';
@endphp

<div class="health-alert {{ $classes }} relative flex items-center gap-3 p-4">
    @if($level === 'success' || $level === 'low')
        <i class="fas fa-check-circle health-icon"></i>
    @elseif($level === 'warning' || $level === 'medium')
        <i class="fas fa-exclamation-triangle health-icon"></i>
    @elseif($level === 'danger' || $level === 'high')
        <i class="fas fa-exclamation-circle health-icon"></i>
    @else
        <i class="fas fa-info-circle health-icon"></i>
    @endif

    <div class="flex-1">
        {{ $slot }}
    </div>

    @if($dismissible)
        <button type="button" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    @endif
</div>
