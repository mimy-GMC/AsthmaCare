<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'btn-health bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-red-400'
]) }}>
    <i class="fas fa-exclamation-triangle mr-2"></i>
    {{ $slot }}
</button>
