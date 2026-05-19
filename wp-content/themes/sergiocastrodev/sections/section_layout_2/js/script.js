document.addEventListener('DOMContentLoaded', function () {
    animateSectionLayout2();
});

function animateSectionLayout2() {
    var section = document.querySelector('.section_layout_2');
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    var caption       = section.querySelector('.layout_2_caption');
    var titulo        = section.querySelector('.layout_2_titulo');
    var steps         = section.querySelectorAll('.layout_2_step');
    var progressSvg   = section.querySelector('.layout_2_progress_svg');
    var progressFill  = section.querySelector('.layout_2_progress_fill');
    var progressMark  = section.querySelector('.layout_2_progress_marker');

    // ── Línea vertical de progreso (scrub al scroll) ─────
    if (progressSvg && progressFill && progressMark) {
        // El SVG usa preserveAspectRatio="none" y se estira al alto real del wrapper.
        // El stroke-dasharray se interpreta en píxeles renderizados, así que hay que
        // calcular el alto real y aplicarlo dinámicamente para que la línea se rellene
        // como un único trazo continuo (no en segmentos repetidos).
        function getLineHeight() {
            return progressSvg.getBoundingClientRect().height;
        }

        function setupProgressLine() {
            var h = getLineHeight();
            progressFill.setAttribute('stroke-dasharray', h);
            progressFill.setAttribute('stroke-dashoffset', h);
        }

        setupProgressLine();
        window.addEventListener('resize', setupProgressLine);

        // Aparece el marker al entrar en viewport
        gsap.to(progressMark, {
            opacity:  1,
            duration: 0.4,
            ease:     'power2.out',
            scrollTrigger: {
                trigger: section,
                start:   'top 78%',
                toggleActions: 'play none none reverse',
            },
        });

        // Una sola timeline scrub: rellena la línea y baja el marker en paralelo
        gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start:   'top 75%',
                end:     'bottom 65%',
                scrub:   0.5,
                invalidateOnRefresh: true,
                onRefresh: setupProgressLine,
            },
        })
        .fromTo(progressFill,
            { strokeDashoffset: function () { return getLineHeight(); } },
            { strokeDashoffset: 0, ease: 'none' }, 0)
        .to(progressMark, { top: '100%', ease: 'none' }, 0);
    }

    // ── Header ────────────────────────────────────────────
    gsap.set(caption, { opacity: 0, y: 18 });
    gsap.set(titulo,  { opacity: 0, y: 24 });

    ScrollTrigger.create({
        trigger: section,
        start:   'top 78%',
        once:    true,
        onEnter: function () {
            gsap.timeline({ defaults: { ease: 'power3.out' } })
                .to(caption, { opacity: 1, y: 0, duration: 0.6 })
                .to(titulo,  { opacity: 1, y: 0, duration: 0.7 }, '-=0.35');
        },
    });

    // ── Cada paso entra individualmente con ScrollTrigger ─
    steps.forEach(function (step, index) {
        var visual  = step.querySelector('.layout_2_step_visual');
        var number  = step.querySelector('.layout_2_step_number');
        var title   = step.querySelector('.layout_2_step_title');
        var desc    = step.querySelector('.layout_2_step_desc');

        // Pasos impares (index 0, 2): visual entra desde la izquierda
        // Pasos pares (index 1):       visual entra desde la derecha
        var visualXFrom = index % 2 === 0 ? -40 : 40;

        gsap.set(visual,        { opacity: 0, x: visualXFrom, scale: 0.96 });
        gsap.set([title, desc], { opacity: 0, y: 30 });
        gsap.set(number,        { opacity: 0, y: 50, scale: 0.7 });

        ScrollTrigger.create({
            trigger: step,
            start:   'top 80%',
            once:    true,
            onEnter: function () {
                gsap.timeline({ defaults: { ease: 'power3.out' } })
                    .to(visual, {
                        opacity:  1,
                        x:        0,
                        scale:    1,
                        duration: 0.9,
                    })
                    .to(title, {
                        opacity:  1,
                        y:        0,
                        duration: 0.55,
                    }, '-=0.55')
                    .to(desc, {
                        opacity:  1,
                        y:        0,
                        duration: 0.55,
                    }, '-=0.4')
                    .to(number, {
                        opacity:  1,
                        y:        0,
                        scale:    1,
                        duration: 0.7,
                        ease:     'back.out(1.6)',
                    }, '-=0.3');
            },
        });
    });
}
