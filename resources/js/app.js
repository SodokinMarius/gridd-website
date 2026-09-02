/**
 * GRIDD — interactions front
 * Carrousel hero, menu mobile, animations au scroll, header sticky.
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

document.addEventListener('DOMContentLoaded', () => {
    initHeroCarousel();
    initScrollReveal();
    initHeaderScroll();
    initMobileMenu();
});