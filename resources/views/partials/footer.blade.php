<footer class="bg-sky-100 opacity-80">
    <div class="container mx-auto grid md:grid-cols-3 gap-8 py-10 px-6">
        <!-- À propos -->
        <div>
            <a href="{{ url('/') }}" class="flex items-center space-x-2 mb-2">
                <i class="fas fa-lungs text-3xl text-[#644ba9]"></i>
                <span class="text-2xl text-[#4b5ca9ff] font-serif font-semibold">AsthmaCare</span>
            </a>
            <p class="text-sm font-serif">
                Votre compagnon pour une meilleure santé respiratoire.
            </p>
        </div>

        <!-- Liens utiles -->
        <div>

            <h3 class="text-base font-serif font-semibold mb-4">Liens utiles :</h3>
            <ul class="space-y-2">
                <li><a href="#" class="font-serif hover:text-primary">Accueil</a></li>
                <li><a href="{{ route('features') }}" class="font-serif hover:text-primary {{ request()->routeIs('features') ? 'active' : '' }}"> Fonctionnalités</a></li>
                <li><a href="{{ route('about') }}" class="font-serif hover:text-primary {{ request()->routeIs('about') ? 'active' : '' }}"> À propos</a></li>
                <li><a href="{{ route('contact') }}" class="font-serif hover:text-primary {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
        </div>

        <!-- Réseaux sociaux -->
        <div>
            <h3 class="text-base font-serif font-semibold">Contacts :</h3>
            <p class="font-serif text-[#4b5ca9ff] mb-4">support@asthmacare.com</p>

            <div class="mb-4 md:mb-0">
                <h3 class="text-base font-serif font-semibold mb-4">Suivez-nous sur :</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-[#4b5ca9ff] hover:text-[#7547a3ff] transition-colors text-2xl">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://github.com/mimy-GMC/AsthmaCare" class="text-[#4b5ca9ff] hover:text-[#7547a3ff] transition-colors text-2xl">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="text-[#4b5ca9ff] hover:text-[#7547a3ff] transition-colors text-2xl">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bas de page -->
    <div class="text-center border-t border-indigo-500/50 shadow-xl py-4">
        <p class="text-sm font-serif">© {{ date('Y') }} AsthmaCare - Développé par Miryam GAKOSSO</p>
        <p class="text-xs font-serif opacity-50">Tous droits réservés</p>

        <div class="mt-2">
            <ul class="flex justify-center space-x-6">
                <li><a href="#" class="text-sm font-serif text-gray-500 hover:text-[#7547a3ff]">Confidentialité</a></li>
                <li><a href="#" class="text-sm font-serif text-gray-500 hover:text-[#7547a3ff]">Conditions d'utilisation</a></li>
            </ul>
        </div>
    </div>
</footer>
