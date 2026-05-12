document.addEventListener("DOMContentLoaded", () => {
    const backToTopButton = document.querySelector(".section_sergio_backtop");

    if (backToTopButton) {
        backToTopButton.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }); 
    }
});