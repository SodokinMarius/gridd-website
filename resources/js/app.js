/**
 * GRIDD — interactions front
 * Carrousel hero, menu mobile, animations au scroll, header sticky, confirmations admin.
 */

function initHeroCarousel() {
    const carousel = document.querySelector('[data-carousel]');
    if (!carousel) return;

    const slides = [...carousel.querySelectorAll('.hero-slide')];
    const dots = [...carousel.querySelectorAll('[data-carousel-dot]')];
    const prevBtn = carousel.querySelector('[data-carousel-prev]');
    const nextBtn = carousel.querySelector('[data-carousel-next]');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (slides.length <= 1) {
        slides[0]?.querySelector('.hero-slide-text')?.classList.add('hero-text-animate');
        return;
    }

    let current = 0;
    let timer = null;
    const INTERVAL = 6500;

    function setSlideAccessibility() {
        slides.forEach((slide, index) => {
            slide.setAttribute('aria-hidden', index === current ? 'false' : 'true');
        });
    }

    function animateCurrentText() {
        const text = slides[current].querySelector('.hero-slide-text');
        if (!text) return;

        text.classList.remove('hero-text-animate');
        void text.offsetWidth;
        text.classList.add('hero-text-animate');
    }

    function goTo(index) {
        slides[current].classList.remove('is-active');
        dots[current]?.classList.remove('is-active');
        dots[current]?.removeAttribute('aria-selected');

        current = (index + slides.length) % slides.length;

        slides[current].classList.add('is-active');
        dots[current]?.classList.add('is-active');
        dots[current]?.setAttribute('aria-selected', 'true');

        setSlideAccessibility();
        animateCurrentText();
    }

    function next() {
        goTo(current + 1);
    }

    function prev() {
        goTo(current - 1);
    }

    function stopAutoplay() {
        if (timer) clearInterval(timer);
        timer = null;
    }

    function startAutoplay() {
        if (prefersReducedMotion) return;
        stopAutoplay();
        timer = setInterval(next, INTERVAL);
    }

    nextBtn?.addEventListener('click', () => {
        next();
        startAutoplay();
    });

    prevBtn?.addEventListener('click', () => {
        prev();
        startAutoplay();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            goTo(index);
            startAutoplay();
        });
    });

    carousel.addEventListener('mouseenter', stopAutoplay);
    carousel.addEventListener('mouseleave', startAutoplay);

    let touchStartX = 0;

    carousel.addEventListener('touchstart', (event) => {
        touchStartX = event.touches[0].clientX;
    }, { passive: true });

    carousel.addEventListener('touchend', (event) => {
        const diff = touchStartX - event.changedTouches[0].clientX;

        if (Math.abs(diff) > 50) {
            diff > 0 ? next() : prev();
            startAutoplay();
        }
    }, { passive: true });

    document.addEventListener('visibilitychange', () => {
        document.hidden ? stopAutoplay() : startAutoplay();
    });

    setSlideAccessibility();
    animateCurrentText();
    startAutoplay();
}

function initScrollReveal() {
    const elements = document.querySelectorAll('.reveal');
    if (!elements.length) return;

    if (!('IntersectionObserver' in window)) {
        elements.forEach((element) => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.14, rootMargin: '0px 0px -50px 0px' }
    );

    elements.forEach((element) => observer.observe(element));
}

function initHeaderScroll() {
    const header = document.querySelector('[data-site-header]');
    if (!header) return;

    const onScroll = () => {
        header.classList.toggle('is-scrolled', window.scrollY > 12);
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

function initMobileMenu() {
    const toggle = document.querySelector('[data-menu-toggle]');
    const menu = document.querySelector('[data-mobile-menu]');
    if (!toggle || !menu) return;

    function closeMenu() {
        toggle.classList.remove('is-open');
        menu.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
    }

    function openMenu() {
        toggle.classList.add('is-open');
        menu.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
    }

    toggle.addEventListener('click', () => {
        const isOpen = toggle.classList.contains('is-open');
        isOpen ? closeMenu() : openMenu();
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeMenu();
    });

    document.addEventListener('click', (event) => {
        const clickInside = menu.contains(event.target) || toggle.contains(event.target);
        if (!clickInside) closeMenu();
    });
}

function initDesktopSubmenus() {
    const submenus = [...document.querySelectorAll('[data-submenu]')];
    if (!submenus.length) return;

    function closeSubmenu(submenu) {
        submenu.classList.remove('is-open');
        submenu.querySelector('[data-submenu-toggle]')?.setAttribute('aria-expanded', 'false');
    }

    function openSubmenu(submenu) {
        submenus.forEach((other) => other !== submenu && closeSubmenu(other));
        submenu.classList.add('is-open');
        submenu.querySelector('[data-submenu-toggle]')?.setAttribute('aria-expanded', 'true');
    }

    submenus.forEach((submenu) => {
        const toggle = submenu.querySelector('[data-submenu-toggle]');
        if (!toggle) return;

        toggle.addEventListener('click', () => {
            submenu.classList.contains('is-open') ? closeSubmenu(submenu) : openSubmenu(submenu);
        });

        submenu.addEventListener('mouseenter', () => openSubmenu(submenu));
        submenu.addEventListener('mouseleave', () => closeSubmenu(submenu));
        submenu.addEventListener('focusin', () => openSubmenu(submenu));
        submenu.addEventListener('focusout', (event) => {
            if (!submenu.contains(event.relatedTarget)) closeSubmenu(submenu);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') submenus.forEach(closeSubmenu);
    });

    document.addEventListener('click', (event) => {
        submenus.forEach((submenu) => {
            if (!submenu.contains(event.target)) closeSubmenu(submenu);
        });
    });
}

/**
 * Confirmation des formulaires [data-confirm] dans une fenêtre modale
 * (remplace la boîte native window.confirm).
 */
function initConfirmDialogs() {
    const dialog = document.getElementById('confirm-dialog');
    if (!dialog || typeof dialog.showModal !== 'function') return;

    const message = dialog.querySelector('#confirm-dialog-message');
    const okButton = dialog.querySelector('[data-confirm-ok]');
    let pendingForm = null;

    document.addEventListener('submit', (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement) || !form.dataset.confirm) return;

        event.preventDefault();
        pendingForm = form;
        message.textContent = form.dataset.confirm;
        dialog.showModal();
        dialog.querySelector('[data-confirm-cancel]').focus();
    });

    okButton.addEventListener('click', () => {
        const form = pendingForm;
        pendingForm = null;
        okButton.disabled = true;
        dialog.close();
        // submit() ne redéclenche pas l'événement submit : pas de nouvelle confirmation.
        form?.submit();
    });

    dialog.querySelector('[data-confirm-cancel]').addEventListener('click', () => dialog.close());

    // Clic sur le fond assombri : fermeture.
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });

    dialog.addEventListener('close', () => {
        pendingForm = null;
    });

    // Retour arrière du navigateur (bfcache) : le bouton redevient utilisable.
    window.addEventListener('pageshow', () => {
        okButton.disabled = false;
    });
}

/**
 * Bouton « œil » pour afficher / masquer chaque champ mot de passe.
 */
function initPasswordToggles() {
    const eye = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>';
    const eyeOff = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.6 5.1A10.4 10.4 0 0 1 12 5c6.4 0 10 7 10 7a17.6 17.6 0 0 1-2.6 3.6M6.6 6.6C3.9 8.4 2 12 2 12s3.6 7 10 7a9.7 9.7 0 0 0 5.4-1.6"/><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/><path d="m3 3 18 18"/></svg>';

    document.querySelectorAll('input[type="password"]').forEach((input) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'password-field';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'password-toggle';

        const render = (visible) => {
            button.innerHTML = visible ? eyeOff : eye;
            button.setAttribute('aria-label', visible ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
            button.setAttribute('title', visible ? 'Masquer' : 'Afficher');
            button.setAttribute('aria-pressed', String(visible));
        };

        button.addEventListener('click', () => {
            const visible = input.type === 'password';
            input.type = visible ? 'text' : 'password';
            render(visible);
            input.focus();
        });

        // Remasque avant l'envoi, pour que le navigateur ne mémorise pas le mot de passe en clair.
        input.form?.addEventListener('submit', () => {
            input.type = 'password';
            render(false);
        });

        render(false);
        wrapper.appendChild(button);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initHeroCarousel();
    initScrollReveal();
    initHeaderScroll();
    initMobileMenu();
    initDesktopSubmenus();
    initConfirmDialogs();
    initPasswordToggles();
});