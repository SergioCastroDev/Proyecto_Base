document.addEventListener('DOMContentLoaded', function () {
    fixContactFormOddInputs();
    animateSectionContact1();
});

function fixContactFormOddInputs() {
    var form = document.querySelector('.section_contact_1 .wpcf7-form');
    if (!form) return;

    var halfInputs = Array.prototype.slice.call(
        form.querySelectorAll('.container_input:not(.container_input_full)')
    );
    if (halfInputs.length % 2 !== 0) {
        halfInputs[halfInputs.length - 1].style.gridColumn = '1 / -1';
    }
}

function animateSectionContact1() {
    var section = document.querySelector('.section_contact_1');
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    var titulo = section.querySelector('.contact_1_titulo');
    var desc   = section.querySelector('.contact_1_desc');
    var items  = section.querySelectorAll('.contact_1_item');
    var card   = section.querySelector('.contact_1_form_card');

    var textEls = [];
    if (titulo) textEls.push(titulo);
    if (desc)   textEls.push(desc);

    if (textEls.length) gsap.set(textEls, { opacity: 0, y: 28 });
    if (items.length)   gsap.set(items,   { opacity: 0, x: -24 });
    if (card)           gsap.set(card,    { opacity: 0, y: 32 });

    ScrollTrigger.create({
        trigger: section,
        start:   'top 75%',
        once:    true,
        onEnter: function () {
            var tl = gsap.timeline({ defaults: { ease: 'power3.out' } });
            if (textEls.length) tl.to(textEls, { opacity: 1, y: 0, duration: 0.6, stagger: 0.15 });
            if (items.length)   tl.to(items,   { opacity: 1, x: 0, duration: 0.5, stagger: 0.1 }, '-=0.35');
            if (card)           tl.to(card,    { opacity: 1, y: 0, duration: 0.6 }, '-=0.5');
        },
    });
}
