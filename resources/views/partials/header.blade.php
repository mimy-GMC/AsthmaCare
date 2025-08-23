<header class="bg-blue-600 text-white p-4">
    <nav class=class="flex flex-col md:flex-row justify-between items-center">
        <h1 class="text-xl font-bold mb-2 md:mb-0">AsthmaCare</h1>
        <ul class="flex flex-wrap gap-2 md:gap-4 justify-center">
            <li><a href="{{ url('/dashboard') }}" class="hover:underline px-2 py-1 rounded">Dashboard</a></li>
            <li><a href="{{ url('/journal') }}" class="hover:underline px-2 py-1 rounded">Journal</a></li>
            <li><a href="{{ route('historique') }}" class="hover:underline px-2 py-1 rounded">Historique</a></li>
            <li><a href="{{ route('carte') }}" class="hover:underline px-2 py-1 rounded">Carte</a></li>
            <li><a href="{{ route('air-qualites') }}" class="hover:underline px-2 py-1 rounded">Air</a></li>
            <li><a href="{{ route('conseils') }}" class="hover:underline px-2 py-1 rounded">Conseils</a></li>
        </ul>
    </nav>
</header>