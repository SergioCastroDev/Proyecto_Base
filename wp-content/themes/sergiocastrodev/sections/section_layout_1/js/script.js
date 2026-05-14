document.addEventListener('DOMContentLoaded', function () {
    animateSectionLayout1();
});

function animateSectionLayout1() {
    var section = document.querySelector('.section_layout_1');
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    var titulo = section.querySelector('.layout_1_titulo');
    var cards  = section.querySelectorAll('.layout_1_card');

    gsap.set(titulo, { opacity: 0, y: 20 });
    gsap.set(cards,  { opacity: 0 });

    ScrollTrigger.create({
        trigger: section,
        start:   'top 72%',
        once:    true,
        onEnter: function () {
            gsap.timeline({ defaults: { ease: 'power3.out' } })
                .to(titulo, { opacity: 1, y: 0, duration: 0.7 })
                .to(cards,  { opacity: 1, duration: 0.6, stagger: 0.1 }, '-=0.35');
        },
    });
}
