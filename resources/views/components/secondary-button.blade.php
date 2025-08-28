<button {{ $attributes->merge([
    'type' => 'button',
    'class' => '
        btn-health-secondary
        inline-flex items-center justify-center
        px-4 py-2
        rounded-lg font-semibold text-sm
        text-primary border border-primary bg-white
        shadow-sm
        hover:bg-primary hover:text-white
        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary
        disabled:opacity-50 disabled:cursor-not-allowed
        transition ease-in-out duration-150
    '
]) }}>
    {{ $slot }}
</button>
