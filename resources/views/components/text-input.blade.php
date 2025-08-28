@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'health-form-input' . ($disabled ? 'bg-gray-100 cursor-not-allowed' : '')
]) !!}>
