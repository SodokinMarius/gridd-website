/**
 * GRIDD — interactions front (carrousel hero, animations au scroll)
 */

/* ── Carrousel hero ─────────────────────────────────────────── */
function initHeroCarousel() {
    const carousel = document.querySelector('[data-carousel]');
    if (!carousel) return;

    const slides = [...carousel.querySelectorAll('.hero-slide')];
    const dots = [...carousel.querySelectorAll('[data-carousel-dot]')];
    const prevBtn = carousel.querySelector('[data-carousel-prev]');
    const nextBtn = carousel.querySelector('[data-carousel-next]');

    if (slides.length <= 1) return;

    let current = 0;
    let timer = null;
    const INTERVAL = 6000;

    function goTo(index) {
        slides[current].classList.remove('is-active');
        dots[current]?.classList.remove('is-active');
        dots[current]?.removeAttribute('aria-selected');

        current = (index + slides.length) % slides.length;

        slides[current].classList.add('is-active');
        dots[current]?.classList.add('is-active');
        dots[current]?.setAttribute('aria-selected', 'true');

        // Ré-animer le texte
        const text = slides[current].querySelector('.hero-slide-text');
        if (text) {
            text.classList.remove('hero-text-animate');
            void text.offsetWidth; // reflow
            text.classList.add('hero-text-animate');
        }
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAutoplay() {
        stopAutoplay();
        timer = setInterval(next, INTERVAL);
    }

    function stopAutoplay() {
        if (timer) clearInterval(timer);
    }

    nextBtn?.addEventListener('click', () => { next(); startAutoplay(); });
    prevBtn?.addEventListener('click', () => { prev(); startAutoplay(); });

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => { goTo(i); startAutoplay(); });
    });

    carousel.addEventListener('mouseenter', stopAutoplay);
    carousel.addEventListener('mouseleave', startAutoplay);

    // Swipe tactile
    let touchStartX = 0;
    carousel.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, { passive: true });
    carousel.addEventListener('touchend', (e) => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) {
            diff > 0 ? next() : prev();
            startAutoplay();
        }
    }, { passive: true });

    // Animation initiale du premier slide
    slides[0].querySelector('.hero-slide-text')?.classList.add('hero-text-animate');
    startAutoplay();
}

/* ── Révélation au scroll ───────────────────────────────────── */
function initScrollReveal() {
    const elements = document.querySelectorAll('.reveal');
    if (!elements.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    elements.forEach((el) => observer.observe(el));
}

/* ── Header au scroll ───────────────────────────────────────── */
function initHeaderScroll() {
    const header = document.querySelector('[data-site-header]');
    if (!header) return;

    const onScroll = () => {
        header.classList.toggle('is-scrolled', window.scrollY > 20);
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

document.addEventListener('DOMContentLoaded', () => {
    initHeroCarousel();
    initScrollReveal();
    initHeaderScroll();
});
