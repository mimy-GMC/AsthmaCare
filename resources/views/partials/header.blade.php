<header class="bg-blue-600 text-white p-4">
    <nav class="flex justify-between items-center">
        <h1 class="text-xl font-bold">AsthmaCare</h1>
        <ul class="flex gap-4">
            <li><a href="{{ url('/dashboard') }}" class="hover:underline">Dashboard</a></li>
            <li><a href="{{ url('/journal') }}" class="hover:underline">Journal</a></li>
            <li><a href="{{ route('historique') }}" class="hover:underline">Historique</a></li>
        </ul>
    </nav>
</header>