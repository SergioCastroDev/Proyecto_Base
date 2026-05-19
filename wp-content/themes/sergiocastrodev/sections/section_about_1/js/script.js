document.addEventListener('DOMContentLoaded', function () {
    animateSectionAbout1();
});

function animateSectionAbout1() {
    var section = document.querySelector('.section_about_1');
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    var label  = section.querySelector('.about_1_label');
    var titulo = section.querySelector('.about_1_titulo');
    var desc   = section.querySelector('.about_1_desc');
    var figure = section.querySelector('.about_1_figure');

    var textEls = [titulo, desc];
    if (label) textEls.unshift(label);

    gsap.set(textEls, { opacity: 0, y: 32 });
    if (figure) gsap.set(figure, { opacity: 0, x: 40 });

    ScrollTrigger.create({
        trigger: section,
        start:   'top 75%',
        once:    true,
        onEnter: function () {
            var tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

            tl.to(textEls, { opacity: 1, y: 0, duration: 0.6, stagger: 0.15 });

            if (figure) {
                tl.to(figure, { opacity: 1, x: 0, duration: 0.7 }, '-=0.45');
            }
        },
    });
}
