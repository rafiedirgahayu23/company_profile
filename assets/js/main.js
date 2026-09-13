/* ==========================================================================
   PT Digital Solusi Nusantara — main.js
   ========================================================================== */

(function () {
    'use strict';

    /* ------------------------------------------------------------------
       OVERLAY HELPERS — Loading Spinner
       Default (tanpa class 'is-hidden') = overlay TERLIHAT (menutup layar).
       Class 'is-hidden' = overlay TERSEMBUNYI (halaman terlihat).
    ------------------------------------------------------------------ */

    const overlay = document.getElementById('page-overlay');

    function applyOverlayTheme() {
        if (!overlay) return;
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        overlay.classList.toggle('theme-light', !isDark);
    }

    /**
     * Sembunyikan overlay (tampilkan halaman).
     * @param {boolean} cameFromNavigation  true = dari klik menu (animasi fade jalan),
     *                                      false = buka pertama kali/refresh (instan, tanpa animasi)
     */
    function revealPage(cameFromNavigation) {
        if (!overlay) return;
        applyOverlayTheme();

        if (!cameFromNavigation) {
            overlay.classList.add('no-transition');
            overlay.classList.add('is-hidden');
            void overlay.offsetHeight; // paksa reflow
            overlay.classList.remove('no-transition');
            return;
        }

        requestAnimationFrame(() => {
            overlay.classList.add('is-hidden');
        });
    }

    /**
     * Tampilkan overlay sebelum pindah halaman.
     */
    function showOverlay(callback) {
        if (!overlay) {
            if (callback) callback();
            return;
        }
        applyOverlayTheme();
        overlay.classList.remove('is-hidden'); // trigger overlay muncul

        setTimeout(() => {
            if (callback) callback();
        }, 400);
    }


    /* ------------------------------------------------------------------
       A. PAGE LOAD
    ------------------------------------------------------------------ */
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);

    const cameFromNavigation = sessionStorage.getItem('dsn_navigating') === '1';
    sessionStorage.removeItem('dsn_navigating');

    if (document.readyState === 'complete') {
        revealPage(cameFromNavigation);
    } else {
        window.addEventListener('load', () => revealPage(cameFromNavigation), { once: true });
        setTimeout(() => revealPage(cameFromNavigation), 2500);
    }

    /* ------------------------------------------------------------------
       B. BROWSER BACK / FORWARD (bfcache)
    ------------------------------------------------------------------ */
    window.addEventListener('pageshow', (e) => {
        if (e.persisted && overlay) {
            overlay.classList.add('no-transition');
            overlay.classList.add('is-hidden');
            void overlay.offsetHeight;
            overlay.classList.remove('no-transition');
        }
    });


    /* ------------------------------------------------------------------
       C. INTERNAL LINK INTERCEPTION — show overlay before navigating
    ------------------------------------------------------------------ */
    document.addEventListener('click', (e) => {
        const anchor = e.target.closest('a');
        if (!anchor) return;

        const href = anchor.getAttribute('href');
        if (!href) return;

        // Skip non-navigation links
        const isExternal = anchor.hostname && anchor.hostname !== window.location.hostname;
        const isAnchor = href.startsWith('#');
        const isSpecial = /^(mailto:|tel:|javascript:)/i.test(href);
        const isSamePage = anchor.href === window.location.href;
        const isNewTab = anchor.target === '_blank';

        if (isExternal || isAnchor || isSpecial || isSamePage || isNewTab) return;

        e.preventDefault();
        const destination = anchor.href;

        sessionStorage.setItem('dsn_navigating', '1');
        showOverlay(() => {
            window.location.href = destination;
        });
    }, { capture: false });


    /* ------------------------------------------------------------------
       D. DARK / LIGHT MODE TOGGLE
    ------------------------------------------------------------------ */
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    function updateThemeIcon(theme) {
        if (!themeIcon) return;
        themeIcon.classList.toggle('fa-sun', theme === 'dark');
        themeIcon.classList.toggle('fa-moon', theme !== 'dark');
    }

    updateThemeIcon(savedTheme);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const current = document.documentElement.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            updateThemeIcon(next);
        });
    }


    /* ------------------------------------------------------------------
       E. STICKY NAVBAR
    ------------------------------------------------------------------ */
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        }, { passive: true });
    }


    /* ------------------------------------------------------------------
       F. INIT AOS, SWIPER, COUNTUP  (after DOM is ready)
    ------------------------------------------------------------------ */
    document.addEventListener('DOMContentLoaded', () => {

        // AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({ duration: 800, easing: 'ease-in-out', once: true, offset: 50 });
        }

        // Swiper
        if (typeof Swiper !== 'undefined' && document.querySelector('.mySwiper')) {
            new Swiper('.mySwiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                pagination: { el: '.swiper-pagination', clickable: true },
                autoplay: { delay: 5000, disableOnInteraction: false },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                }
            });
        }

        // CountUp
        const statEls = document.querySelectorAll('.count-up');
        if (typeof countUp !== 'undefined' && statEls.length) {
            const opts = { duration: 2.5, useEasing: true, useGrouping: true };
            const io = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    const el = entry.target;
                    const anim = new countUp.CountUp(el, parseInt(el.dataset.count, 10), opts);
                    if (!anim.error) anim.start();
                    io.unobserve(el);
                });
            }, { threshold: 0.5 });
            statEls.forEach(el => io.observe(el));
        }

    });

}());