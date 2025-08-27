@props(['level' => 'info', 'dismissible' => false])

@php
    $classes = [
        'info' => 'alert-info',
        'success' => 'alert-success',
        'warning' => 'alert-warning',
        'danger' => 'alert-danger',
        'low' => 'health-alert-low',
        'medium' => 'health-alert-medium',
        'high' => 'health-alert-high'
    ][$level] ?? 'alert-info';
@endphp

<div class="alert {{ $classes }} d-flex align-items-center" role="alert">
    @if($level === 'success' || $level === 'low')
        <i class="fas fa-check-circle health-icon"></i>
    @elseif($level === 'warning' || $level === 'medium')
        <i class="fas fa-exclamation-triangle health-icon"></i>
    @elseif($level === 'danger' || $level === 'high')
        <i class="fas fa-exclamation-circle health-icon"></i>
    @else
        <i class="fas fa-info-circle health-icon"></i>
    @endif
    
    <div class="flex-grow-1">
        {{ $slot }}
    </div>
    
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>