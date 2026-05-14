document.addEventListener('DOMContentLoaded', function () {
    initServices1Slider();
    animateServices1();
});

// ── Mobile slider ─────────────────────────────────────────────────────────────

function initServices1Slider() {
    var el = document.querySelector('.services_1_slider');
    if (!el) return;

    var splide   = null;
    var splitMap = new Map(); // titleEl → SplitText

    function getEls(slide) {
        return {
            icon:    slide.querySelector('.services_1_card_icon'),
            title:   slide.querySelector('.services_1_card_title'),
            divider: slide.querySelector('.services_1_card_divider'),
            desc:    slide.querySelector('.services_1_card_desc'),
            link:    slide.querySelector('.services_1_card_link'),
        };
    }

    function buildSplits() {
        el.querySelectorAll('.services_1_card_title').forEach(function (titleEl) {
            if (!splitMap.has(titleEl)) {
                splitMap.set(titleEl, new SplitText(titleEl, { type: 'chars' }));
            }
        });
    }

    function resetSlide(slide) {
        var e = getEls(slide);
        var split = e.title ? splitMap.get(e.title) : null;

        if (split) {
            gsap.set(split.chars, {
                rotateX:         -90,
                opacity:         0,
                transformOrigin: '50% 50% -20px',
            });
        }
        if (e.icon)    gsap.set(e.icon,    { scale: 0,  opacity: 0, rotation: -25 });
        if (e.divider) gsap.set(e.divider, { scaleX: 0, transformOrigin: 'left center' });
        if (e.desc)    gsap.set(e.desc,    { y: 18,     opacity: 0 });
        if (e.link)    gsap.set(e.link,    { x: -14,    opacity: 0 });
    }

    function animateSlideIn(slide) {
        var e = getEls(slide);
        var split = e.title ? splitMap.get(e.title) : null;

        var tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        // Icon: physics pop with spin
        if (e.icon) {
            tl.to(e.icon, {
                scale:    1,
                opacity:  1,
                rotation: 0,
                duration: 0.35,
                ease:     'back.out(2.8)',
            });
        }

        // Title chars: 3-D flip from behind
        if (split && split.chars.length) {
            tl.to(split.chars, {
                rotateX:              0,
                opacity:              1,
                transformPerspective: 600,
                transformOrigin:      '50% 50% -20px',
                duration:             0.3,
                stagger:              0.016,
                ease:                 'power2.out',
            }, e.icon ? '-=0.22' : 0);
        }

        // Divider grows left → right
        if (e.divider) {
            tl.to(e.divider, { scaleX: 1, duration: 0.25, ease: 'power2.out' }, '-=0.1');
        }

        // Description rises
        if (e.desc) {
            tl.to(e.desc, { y: 0, opacity: 1, duration: 0.28 }, '-=0.18');
        }

        // Link slides in
        if (e.link) {
            tl.to(e.link, { x: 0, opacity: 1, duration: 0.22 }, '-=0.14');
        }
    }

    function wireAnimations(sp) {
        sp.on('mounted', function () {
            buildSplits();

            // Hide all non-active content
            sp.Components.Elements.slides.forEach(function (slide) {
                if (!slide.classList.contains('is-active')) resetSlide(slide);
            });

            // Animate first active slide with a short delay
            var first = sp.Components.Elements.slides.find(function (s) {
                return s.classList.contains('is-active');
            });
            if (first) {
                resetSlide(first);
                gsap.delayedCall(0.15, function () { animateSlideIn(first); });
            }
        });

        sp.on('active',   function (slideObj) { animateSlideIn(slideObj.slide); });
        sp.on('inactive', function (slideObj) { resetSlide(slideObj.slide);     });

        // Arrow micro-bounce
        sp.on('arrows:mounted', function (prev, next) {
            [prev, next].forEach(function (btn) {
                btn.addEventListener('click', function () {
                    gsap.timeline()
                        .to(btn, { scale: 0.76, duration: 0.08 })
                        .to(btn, { scale: 1,    duration: 0.44, ease: 'back.out(4)' });
                });
            });
        });
    }

    function destroySlider() {
        if (splide) {
            splide.destroy();
            splide = null;
        }
        // Revert SplitText so desktop layout is untouched
        splitMap.forEach(function (split) { split.revert(); });
        splitMap.clear();
        el.querySelectorAll(
            '.services_1_card_icon, .services_1_card_title, ' +
            '.services_1_card_divider, .services_1_card_desc, .services_1_card_link'
        ).forEach(function (node) { gsap.set(node, { clearProps: 'all' }); });
    }

    function syncSlider() {
        if (window.innerWidth < 768) {
            if (!splide) {
                splide = new Splide('.services_1_slider', {
                    type:       'loop',
                    perPage:    1,
                    padding:    { left: '6%', right: '6%' },
                    gap:        '14px',
                    arrows:     true,
                    pagination: true,
                    speed:      280,
                    easing:     'cubic-bezier(0.25, 1, 0.5, 1)',
                });
                wireAnimations(splide);
                splide.mount();
            }
        } else {
            destroySlider();
        }
    }

    syncSlider();
    window.addEventListener('resize', syncSlider);
}

// ── Section entrance + desktop 3-D hover tilt ────────────────────────────────

function animateServices1() {
    var section = document.querySelector('.section_services_1');
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    var headline = section.querySelector('.services_1_headline');
    var quote    = section.querySelector('.services_1_quote');
    var cards    = section.querySelectorAll('.services_1_card');

    gsap.set([headline, quote], { opacity: 0, y: 30 });
    gsap.set(cards, { opacity: 0, y: 44 });

    ScrollTrigger.create({
        trigger: section,
        start:   'top 72%',
        once:    true,
        onEnter: function () {
            gsap.timeline({ defaults: { ease: 'power3.out' } })
                .to(headline, { opacity: 1, y: 0, duration: 0.8 })
                .to(quote,    { opacity: 1, y: 0, duration: 0.7 }, '-=0.5')
                .to(cards,    { opacity: 1, y: 0, duration: 0.6, stagger: 0.12 }, '-=0.4');
        },
    });

    // Desktop 3-D card tilt on mousemove
    if (window.innerWidth >= 1024) {
        cards.forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var rect = card.getBoundingClientRect();
                var x    = (e.clientX - rect.left)  / rect.width  - 0.5;
                var y    = (e.clientY - rect.top)   / rect.height - 0.5;
                gsap.to(card, {
                    rotateY:              x * 22,
                    rotateX:              -y * 16,
                    transformPerspective: 500,
                    duration:             0.35,
                    ease:                 'power2.out',
                    overwrite:            'auto',
                });
            });

            card.addEventListener('mouseleave', function () {
                gsap.to(card, {
                    rotateY:   0,
                    rotateX:   0,
                    duration:  0.65,
                    ease:      'power3.out',
                    overwrite: 'auto',
                });
            });
        });
    }
}
