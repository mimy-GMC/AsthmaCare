<header class="shadow-md bg-sky-100 fixed top-0 left-0 w-full z-50">
    <nav class="health-nav container mx-auto flex items-center justify-between py-4 px-6">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center space-x-2 transition transform hover:scale-105">
            <i class="fas fa-lungs text-3xl text-[#644ba9]"></i>
            <span class="text-2xl text-[#4b5ca9ff] font-serif font-semibold">AsthmaCare</span>
        </a>

        <!-- Menu -->
        <ul class="health-nav-menu hidden md:flex space-x-6 font-normal font-serif text-base text-dark hover:text-[#4b5ca9ff]">
            <li><a href="#journal">Journal</a></li>
            <li><a href="#dashboard">Tableau de bord</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <!-- Connexion / Profil -->
        <div class="hidden md:flex space-x-4">
            @auth
                <a href="{{ route('profile.edit') }}" class="btn-health btn-health-secondary transition transform hover:scale-105 hover:text-primary">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-health btn-health-primary transition transform hover:scale-105 hover:text-primary">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-health font-serif btn-health-secondary transition transform hover:scale-105">Connexion</a>
                <a href="{{ route('register') }}" class="btn-health font-serif btn-health-primary transition transform hover:scale-105">Inscription</a>
            @endauth
        </div>

        <!-- Bouton Mobile -->
        <button id="menu-toggle" class="md:hidden text-[#4b5ca9ff] text-3xl focus:outline-none transition transform hover:scale-105">
            ☰
        </button>
    </nav>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg">
        <ul class="flex flex-col space-y-2 p-4 font-normal font-serif text-gray-600">
            <li><a href="#journal" class="hover:text-[#4b5ca9ff]">Journal</a></li>
            <li><a href="#dashboard" class="hover:text-[#4b5ca9ff]">Tableau de bord</a></li>
            <li><a href="#contact" class="hover:text-[#4b5ca9ff]">Contact</a></li>

            @auth
                <li><a href="{{ route('profile.edit') }}" class="transition transform hover:scale-105">Profil</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="transition transform hover:scale-105">Déconnexion</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="text-dark hover:text-[#4b5ca9ff] text-lg font-semibold">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="text-dark hover:text-[#4b5ca9ff] text-lg font-semibold">Inscription</a></li>
            @endauth
        </ul>
    </div>
</header>

<script>
    // Menu mobile toggle
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.getElementById("mobile-menu").classList.toggle("hidden");
    });
</script>
