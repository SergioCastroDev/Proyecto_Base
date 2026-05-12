function animateSectionAboutMe() {
    const section = document.querySelector(".section_sergio_about_me");
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    const info = section.querySelector(".sergio_info");
    const caption = info.querySelector(".sergio_caption");
    const h2 = info.querySelector("h2");
    const p = info.querySelector("p");
    const cta = info.querySelector(".cta_contact");
    const picture = section.querySelector("picture");

    // Estado inicial
    gsap.set([caption, h2, p, cta], {
        opacity: 0,
        x: -30
    });

    gsap.set(picture, {
        opacity: 0,
        x: 30
    });

    // Timeline de entrada con ScrollTrigger
    const tlEnter = gsap.timeline({
        scrollTrigger: {
            trigger: section,
            start: "top 75%",
            toggleActions: "play none none none"
        },
        defaults: {
            ease: "power3.out"
        }
    });

    tlEnter.to(caption, {
        opacity: 1,
        x: 0,
        duration: 0.6
    })
    .to(h2, {
        opacity: 1,
        x: 0,
        duration: 0.6
    }, "-=0.4")
    .to(p, {
        opacity: 1,
        x: 0,
        duration: 0.6
    }, "-=0.4")
    .to(cta, {
        opacity: 1,
        x: 0,
        duration: 0.5
    }, "-=0.3")
    .to(picture, {
        opacity: 1,
        x: 0,
        duration: 0.8
    }, "-=0.6");

    // Timeline de salida con scroll (reverse)
    const tlExit = gsap.timeline({
        scrollTrigger: {
            trigger: section,
            start: "top top",
            end: "bottom top",
            scrub: 1
        }
    });

    tlExit.to([caption, h2, p, cta], {
        opacity: 0,
        y: -30,
        stagger: 0.05
    }, 0)
    .to(picture, {
        opacity: 0,
        y: -20
    }, 0);
}

animateSectionAboutMe();
