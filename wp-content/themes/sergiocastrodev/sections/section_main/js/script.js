function animateSectionMain() {
    const section = document.querySelector(".section_sergio_main");
    if (!section) return;

    const container = section.querySelector(".container_title");
    const h1 = container.querySelector("h1");
    const p = container.querySelector("p");
    const h2 = container.querySelector("h2");
    const cta = container.querySelector(".cta_contact");
    const picture = section.querySelector("picture");
    const icon = section.querySelector(".sergio_icon");

    // Estado inicial
    gsap.set([h1, p, h2, cta], {
        opacity: 0,
        y: 30
    });

    gsap.set(picture, {
        opacity: 0,
        scale: 0.95
    });

    gsap.set(icon, {
        opacity: 0
    });

    // Animación inicial al cargar (sin reverse en scroll)
    gsap.to([h1, p, h2, cta], {
        opacity: 1,
        y: 0,
        duration: 0.8,
        stagger: 0.15,
        ease: "power3.out"
    });

    gsap.to(picture, {
        opacity: 1,
        scale: 1,
        duration: 0.8,
        delay: 0.3,
        ease: "power2.out"
    });

    gsap.to(icon, {
        opacity: 1,
        duration: 0.6,
        delay: 0.5
    });
}

animateSectionMain();
