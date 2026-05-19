document.addEventListener('DOMContentLoaded', function () {
    animateSectionCta1();
});

function animateSectionCta1() {
    var section = document.querySelector('.section_cta_1');
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    var card      = section.querySelector('.cta_1_card');
    var titulo    = section.querySelector('.cta_1_titulo');
    var subtitulo = section.querySelector('.cta_1_subtitulo');
    var desc      = section.querySelector('.cta_1_desc');
    var btn       = section.querySelector('.cta_1_btn');

    gsap.set(card,      { opacity: 0, y: 40, scale: 0.98 });
    gsap.set([titulo, subtitulo, desc, btn], { opacity: 0, y: 22 });

    ScrollTrigger.create({
        trigger: section,
        start:   'top 80%',
        once:    true,
        onEnter: function () {
            gsap.timeline({ defaults: { ease: 'power3.out' } })
                .to(card,      { opacity: 1, y: 0, scale: 1, duration: 0.65 })
                .to(titulo,    { opacity: 1, y: 0, duration: 0.5 }, '-=0.35')
                .to(subtitulo, { opacity: 1, y: 0, duration: 0.5 }, '-=0.35')
                .to(desc,      { opacity: 1, y: 0, duration: 0.5 }, '-=0.3')
                .to(btn,       { opacity: 1, y: 0, duration: 0.45 }, '-=0.25');
        },
    });
}
