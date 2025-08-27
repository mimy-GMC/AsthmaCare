<header class="health-header bg-primary text-white shadow-md">
    <nav class="health-nav container mx-auto flex justify-between items-center py-4 px-4 md:px-0">
        <a href="{{ route('dashboard') }}" class="health-brand flex items-center gap-2 text-xl font-bold">
            <i class="fas fa-lungs"></i> AsthmaCare
        </a>

        <ul class="health-nav-menu flex gap-4">
            <li>
                <a href="{{ route('dashboard') }}" class="health-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('journal') }}" class="health-nav-link {{ request()->routeIs('journal') ? 'active' : '' }}">
                    <i class="fas fa-book-medical"></i> Journal
                </a>
            </li>
            <li>
                <a href="{{ route('historique') }}" class="health-nav-link {{ request()->routeIs('historique') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Historique
                </a>
            </li>
            <li>
                <a href="{{ route('carte') }}" class="health-nav-link {{ request()->routeIs('carte') ? 'active' : '' }}">
                    <i class="fas fa-map-marked-alt"></i> Carte
                </a>
            </li>
            <li>
                <a href="{{ route('air-qualites') }}" class="health-nav-link {{ request()->routeIs('air-qualites') ? 'active' : '' }}">
                    <i class="fas fa-wind"></i> Qualité Air
                </a>
            </li>
            <li>
                <a href="{{ route('conseils') }}" class="health-nav-link {{ request()->routeIs('conseils') ? 'active' : '' }}">
                    <i class="fas fa-lightbulb"></i> Conseils
                </a>
            </li>
        </ul>

        <!-- Menu utilisateur -->
        <div class="flex items-center gap-4">
            <a href="{{ route('profile.edit') }}" class="text-white hover:text-gray-200">
                <i class="fas fa-user-circle text-xl"></i>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white hover:text-gray-200">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                </button>
            </form>
        </div>
    </nav>
</header>
