function animateSectionHero1() {
    const section = document.querySelector(".section_hero_1");
    if (!section) return;

    const bg          = section.querySelector(".hero_1_bg img");
    const titleMain   = section.querySelector(".hero_1_title_main");
    const titleItalic = section.querySelector(".hero_1_title_italic");
    const cta         = section.querySelector(".hero_1_cta");
    const videoWrap   = section.querySelector(".hero_1_video_wrap");
    const description = section.querySelector(".hero_1_description");

    gsap.set(bg,          { scale: 1.06, opacity: 0 });
    gsap.set(titleMain,   { opacity: 0, y: 35 });
    gsap.set(titleItalic, { opacity: 0, y: 35 });
    gsap.set(cta,         { opacity: 0, y: 20 });
    gsap.set(videoWrap,   { opacity: 0, x: 30 });
    gsap.set(description, { opacity: 0, x: 20 });

    gsap.timeline({ defaults: { ease: "power3.out" } })
        .to(bg,          { scale: 1, opacity: 1, duration: 1.4, ease: "power2.out" })
        .to(titleMain,   { opacity: 1, y: 0, duration: 0.8 }, "-=0.7")
        .to(titleItalic, { opacity: 1, y: 0, duration: 0.8 }, "-=0.55")
        .to(cta,         { opacity: 1, y: 0, duration: 0.6 }, "-=0.45")
        .to(videoWrap,   { opacity: 1, x: 0, duration: 0.8 }, "-=0.5")
        .to(description, { opacity: 1, x: 0, duration: 0.7 }, "-=0.5");
}

function initHero1Video() {
    const videoWrap = document.querySelector(".hero_1_video_wrap");
    if (!videoWrap) return;

    const type     = videoWrap.getAttribute("data-type-video");
    const id       = videoWrap.getAttribute("data-id-video");
    const controls = videoWrap.getAttribute("data-controls");

    if (!id) return;

    if (type === "youtube") {
        let url = "https://www.youtube.com/embed/" + id + "?autoplay=1&mute=1";
        if (controls === "0") {
            url += "&controls=0&modestbranding=1&rel=0&iv_load_policy=3&fs=0&disablekb=1&loop=1&playlist=" + id;
        }
        const iframe = document.createElement("IFRAME");
        iframe.setAttribute("src", url);
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allow", "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture");
        iframe.setAttribute("allowfullscreen", "allowfullscreen");
        videoWrap.innerHTML = "";
        videoWrap.appendChild(iframe);

    } else if (type === "vimeo") {
        let url = "https://player.vimeo.com/video/" + id + "?autoplay=1&muted=1";
        if (controls === "0") {
            url += "&loop=1&title=0&byline=0&portrait=0&controls=0&transparent=0";
        }
        const iframe = document.createElement("IFRAME");
        iframe.setAttribute("src", url);
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allow", "autoplay; fullscreen; picture-in-picture");
        iframe.setAttribute("allowfullscreen", "allowfullscreen");
        videoWrap.innerHTML = "";
        videoWrap.appendChild(iframe);

    } else {
        // Direct video file — keep play button as toggle control
        const playBtn = videoWrap.querySelector(".hero_1_play_btn");
        const svgPath = playBtn.querySelector("svg path");

        const video = document.createElement("VIDEO");
        video.setAttribute("src", id);
        video.setAttribute("autoplay", "");
        video.setAttribute("muted", "");
        video.setAttribute("playsinline", "");
        videoWrap.insertBefore(video, playBtn);

        playBtn.style.pointerEvents = "auto";
        playBtn.style.zIndex = "2";

        const iconPlay  = "M8 5v14l11-7z";
        const iconPause = "M6 19h4V5H6v14zm8-14v14h4V5h-4z";

        function updateIcon() {
            svgPath.setAttribute("d", video.paused ? iconPlay : iconPause);
        }

        playBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            video.paused ? video.play() : video.pause();
            updateIcon();
        });

        video.addEventListener("play",  updateIcon);
        video.addEventListener("pause", updateIcon);
    }
}

function initHero1Bees() {
    const section = document.querySelector(".section_hero_1");
    if (!section) return;

    const beeSVG = `<svg viewBox="0 0 26 14" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <ellipse cx="14" cy="7" rx="9" ry="5" fill="#FFC038"/>
        <rect x="11" y="2.5" width="2.5" height="9" rx="1.25" fill="#271500" opacity="0.85"/>
        <rect x="15" y="3" width="2.5" height="8" rx="1.25" fill="#271500" opacity="0.85"/>
        <ellipse cx="7.5" cy="3" rx="6.5" ry="3" fill="white" opacity="0.55" transform="rotate(-15 7.5 3)"/>
        <ellipse cx="7.5" cy="11" rx="6" ry="2.6" fill="white" opacity="0.45" transform="rotate(15 7.5 11)"/>
        <circle cx="23" cy="7" r="3" fill="#271500"/>
        <ellipse cx="5" cy="7" rx="2" ry="1.5" fill="#271500" opacity="0.6"/>
    </svg>`;

    for (let i = 0; i < 9; i++) {
        const bee = document.createElement("div");
        bee.className = "hero_1_bee";
        bee.innerHTML = beeSVG;
        section.appendChild(bee);

        gsap.set(bee, {
            width:   gsap.utils.random(13, 21, 1),
            opacity: 0,
            left:    gsap.utils.random(5,  90, 1) + "%",
            top:     gsap.utils.random(8,  80, 1) + "%"
        });

        gsap.to(bee.querySelector("svg"), {
            scaleY:          0.65,
            duration:        gsap.utils.random(0.1, 0.18),
            repeat:          -1,
            yoyo:            true,
            ease:            "sine.inOut",
            transformOrigin: "50% 50%"
        });

        gsap.delayedCall(gsap.utils.random(0.2, 4), () => {
            gsap.to(bee, { opacity: gsap.utils.random(0.2, 0.5), duration: 2 });
            wander(bee);
        });
    }

    function wander(bee) {
        const nextLeft = gsap.utils.random(3,  92, 1) + "%";
        const nextTop  = gsap.utils.random(5,  80, 1) + "%";
        const curLeft  = parseFloat(gsap.getProperty(bee, "left"));
        const tilt     = gsap.utils.clamp(-28, 28, (parseFloat(nextLeft) - curLeft) * 0.35);

        gsap.to(bee, {
            left:       nextLeft,
            top:        nextTop,
            rotation:   tilt,
            duration:   gsap.utils.random(4, 10),
            ease:       "sine.inOut",
            onComplete: () => wander(bee)
        });
    }
}

animateSectionHero1();
initHero1Video();
/*initHero1Bees();*/
