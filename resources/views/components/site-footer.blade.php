<footer class="bg-ink text-paper/70 pt-16 pb-8 mt-24">
    <div class="container-content flex flex-wrap gap-10 mb-12">
        <div class="w-full md:w-[calc(25%-30px)]">
            <img src="{{ asset('images/logo.png') }}" alt="GRIDD" class="h-9 w-auto mb-4 brightness-0 invert opacity-90">
            <p class="text-sm leading-relaxed">Groupe de Recherche et d'Innovation pour le Développement Durable.</p>
            <div class="flex gap-3 mt-5">
                {{-- TODO: remplacer les liens # par les URLs réelles des pages Facebook et LinkedIn --}}
                <a href="#" target="_blank" rel="noopener" class="social-link-dark" aria-label="GRIDD Consulting et Services sur Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M22 12.06C22 6.505 17.523 2 12 2S2 6.505 2 12.06c0 5.02 3.657 9.184 8.438 9.94v-7.03H7.898v-2.91h2.54V9.845c0-2.522 1.492-3.914 3.777-3.914 1.094 0 2.238.196 2.238.196v2.475h-1.26c-1.243 0-1.63.775-1.63 1.57v1.88h2.773l-.443 2.91h-2.33V22c4.78-.756 8.437-4.92 8.437-9.94z"/></svg>
                </a>
                <a href="#" target="_blank" rel="noopener" class="social-link-dark" aria-label="GRIDD Consulting et Services sur LinkedIn">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
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
                <li>Abomey-Calavi, Bénin</li>
                <li>contact@gridd-cs.com</li>
                <li>+229 01 96 42 53 83</li>
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
