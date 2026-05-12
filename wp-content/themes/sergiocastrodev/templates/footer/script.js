document.addEventListener("DOMContentLoaded", () => {
    mouseFooter();
    handleFooterVisibility();
});

function mouseFooter() {
    const div = document.querySelector("footer");
    const span = div.querySelector("span");
    const link = div.querySelector(".footer_slider_contact");
    const isDesktop = () => window.matchMedia("(min-width: 1024px)").matches;

    div.addEventListener("mouseenter", () => {
        if (span && isDesktop()) {

            span.style.display = "flex";
            span.style.opacity = "1";
        }
    });

    div.addEventListener("mousemove", (e) => {
        if (!isDesktop()) return;
        
        const rect = div.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        div.style.setProperty("--mouse-x", `${x}px`);
        div.style.setProperty("--mouse-y", `${y}px`);
    });

    div.addEventListener("mouseleave", () => {
        if (span && isDesktop()) {
            span.style.display = "none";
            span.style.opacity = "0";
        }
    });

    link.addEventListener("click", (e) => {
        e.preventDefault();

        if (window.innerWidth < 768) {
            window.scrollBy({
                top: -600,
                behavior: "smooth"
            });
        }
        if (window.innerWidth >= 768) {
            window.scrollBy({
                top: -300,
                behavior: "smooth"
            });
        } if (window.innerWidth >= 1024 && window.innerHeight <= 800) {
            window.scrollBy({
                top: -600,
                behavior: "smooth"
            });
        }
    });
}

function handleFooterVisibility() {
    const footer = document.querySelector("footer");
    if (!footer) return;

    // Mostrar el footer cuando el usuario esté cerca del final de la página
    const checkFooterVisibility = () => {
        const scrollPosition = window.scrollY + window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;

        // Threshold diferente para mobile y desktop
        let threshold;
        if (window.innerWidth < 768) {
            threshold = 500; // Mobile: aparece cuando faltan 500px
        } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
            threshold = 700; // Tablet: aparece cuando faltan 700px
        } else {
            threshold = 1000; // Desktop: aparece cuando faltan 1000px
        }

        if (documentHeight - scrollPosition <= threshold) {
            footer.classList.add("footer-visible");
        } else {
            footer.classList.remove("footer-visible");
        }
    };

    // Ejecutar al cargar la página
    checkFooterVisibility();

    // Ejecutar al hacer scroll (con throttle para mejor rendimiento)
    let ticking = false;
    window.addEventListener("scroll", () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                checkFooterVisibility();
                ticking = false;
            });
            ticking = true;
        }
    });
}