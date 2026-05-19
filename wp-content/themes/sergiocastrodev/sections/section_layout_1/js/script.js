document.addEventListener('DOMContentLoaded', function () {
    animateSectionLayout1();
    if (document.getElementsByClassName('false_link').length !== 0) {
        add_events_false_link();
    }
});

// ── False link: clic en el contenedor dispara el enlace del título ───────────
function add_events_false_link() {

    var array_false_link = document.getElementsByClassName('false_link');

    for (var i = 0; i < array_false_link.length; i++) {

        array_false_link[i].onclick = function (e) {

            // Si el clic es directo sobre un <a>, dejarlo pasar normal
            if (e.target.closest('a')) return;

            var parent      = this.parentElement;
            var data_link   = this.getAttribute('data-link');
            var data_parent = this.getAttribute('data-parent');
            var data_close  = this.getAttribute('data-close');

            if (data_close && data_close !== '') {

                var element_close = this.closest(data_close);

                if (element_close && element_close.querySelector(data_link + ' a')) {
                    element_close.querySelector(data_link + ' a').click();
                }

            } else {

                if (data_parent === '0') {

                    if (data_link === 'h3' && this.querySelectorAll('h3 a').length !== 0) {
                        this.querySelectorAll('h3 a')[0].click();
                    }

                    if (data_link === 'p' && parent.querySelectorAll('p a').length !== 0) {
                        parent.querySelectorAll('p a')[0].click();
                    }

                } else {

                    if (data_link === 'h2' && parent.querySelectorAll('h2 a').length !== 0) {
                        parent.querySelectorAll('h2 a')[0].click();
                    }

                    if (data_link === 'h2_parent' && parent.parentElement.querySelectorAll('h2 a').length !== 0) {
                        parent.parentElement.querySelectorAll('h2 a')[0].click();
                    }

                    if (data_link === 'h3' && parent.querySelectorAll('h3 a').length !== 0) {
                        parent.querySelectorAll('h3 a')[0].click();
                    }

                    if (data_link === 'h3_parent' && parent.parentElement.querySelectorAll('h3 a').length !== 0) {
                        parent.parentElement.querySelectorAll('h3 a')[0].click();
                    }

                    if (data_link === 'p' && parent.parentElement.querySelectorAll('p a').length !== 0) {
                        parent.parentElement.querySelectorAll('p a')[0].click();
                    }

                }
            }
        };
    }
}

// ── Animaciones de entrada y hover ────────────────────────────────────────────

function animateSectionLayout1() {
    var section = document.querySelector('.section_layout_1');
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    var titulo = section.querySelector('.layout_1_titulo');
    var cards  = section.querySelectorAll('.layout_1_card');

    // Estado inicial
    gsap.set(titulo, { opacity: 0, y: 24 });
    gsap.set(cards,  { opacity: 0, y: 60, scale: 0.93 });

    ScrollTrigger.create({
        trigger: section,
        start:   'top 72%',
        once:    true,
        onEnter: function () {
            gsap.timeline({ defaults: { ease: 'power3.out' } })
                .to(titulo, {
                    opacity:  1,
                    y:        0,
                    duration: 0.7,
                })
                .to(cards, {
                    opacity:  1,
                    y:        0,
                    scale:    1,
                    duration: 0.75,
                    stagger:  { amount: 0.42 },
                    ease:     'back.out(1.5)',
                }, '-=0.35');
        },
    });

    // Micro-elevación en hover
    cards.forEach(function (card) {
        card.addEventListener('mouseenter', function () {
            gsap.to(card, {
                y:         -4,
                duration:  0.35,
                ease:      'power2.out',
                overwrite: 'auto',
            });
        });

        card.addEventListener('mouseleave', function () {
            gsap.to(card, {
                y:         0,
                duration:  0.5,
                ease:      'power3.out',
                overwrite: 'auto',
            });
        });
    });
}
