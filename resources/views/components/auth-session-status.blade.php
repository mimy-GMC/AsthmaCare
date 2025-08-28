@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-sm font-semibold text-green-600 flex items-center gap-2 mt-2']) }}>
        <i class="fas fa-check-circle text-green-500"></i>
        {{ $status }}
    </div>
@endif
