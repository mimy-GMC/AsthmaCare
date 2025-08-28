@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 mt-1 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
