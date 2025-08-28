@props(['value'])

<label {{ $attributes->merge(['class' => 'health-form-label']) }}>
    {{ $value ?? $slot }}
</label>
