<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-health btn-health-primary']) }}>
    {{ $slot }}
</button>
