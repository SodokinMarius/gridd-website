<footer class="bg-ink text-paper/70 pt-16 pb-8 mt-24">
    <div class="container-content flex flex-wrap gap-10 mb-12">
        <div class="w-full md:w-[calc(25%-30px)]">
            <img src="{{ asset('images/logo.png') }}" alt="GRIDD" class="h-9 w-auto mb-4 brightness-0 invert opacity-90">
            <p class="text-sm leading-relaxed">Groupe de Recherche et d'Innovation pour le Développement Durable.</p>
        </div>
        <div class="w-full md:w-[calc(25%-30px)]">
            <p class="font-display text-paper mb-3 text-sm">Navigation</p>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('about') }}" class="hover:text-paper transition-colors">À propos</a></li>
                <li><a href="{{ route('services') }}" class="hover:text-paper transition-colors">Services</a></li>
                <li><a href="{{ route('projects.index') }}" class="hover:text-paper transition-colors">Réalisations</a></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-paper transition-colors">Actualités</a></li>
                <li><a href="{{ route('jobs.index') }}" class="hover:text-paper transition-colors">Postes vacants</a></li>
            </ul>
        </div>
        <div class="w-full md:w-[calc(25%-30px)]">
            <p class="font-display text-paper mb-3 text-sm">Contact</p>
            <ul class="space-y-2 text-sm">
                <li>Cotonou, Bénin</li>
                <li>contact@gridd-cs.com</li>
                <li>+229 00 00 00 00</li>
            </ul>
        </div>
        <div class="w-full md:w-[calc(25%-30px)]">
            <p class="font-display text-paper mb-3 text-sm">Espace administration</p>
            <a href="{{ route('admin.login') }}" class="text-sm hover:text-paper transition-colors">Se connecter →</a>
        </div>
    </div>
    <div class="container-content border-t border-paper/10 pt-6 text-xs text-paper/50">
        © {{ date('Y') }} GRIDD Consulting et Services. Tous droits réservés.
    </div>
</footer>
