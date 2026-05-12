document.addEventListener("DOMContentLoaded", function () {
  open_menu();
});

function open_menu() {
  const toggle = document.querySelector(".toggle_menu");
  const header = document.querySelector("header");
  const headerLinks = document.querySelectorAll("header li a");

  if (!toggle || !header) return;

  toggle.addEventListener("click", () => {
    if (!header.classList.contains("open_menu")) {
      // Abriendo el menú
      header.classList.add("open_menu");
      setTimeout(() => {
        header.classList.add("menu_fw");
      }, 500);
    } else {
      // Cerrando el menú
      header.classList.remove("menu_fw");
      setTimeout(() => {
        header.classList.remove("open_menu");
      }, 500);
    }
  });

  headerLinks.forEach(link => {
    link.addEventListener("click", () => {
      if (header.classList.contains("open_menu")) {
        // Cerrando el menú
        header.classList.remove("menu_fw");
        setTimeout(() => {
          header.classList.remove("open_menu");
        }, 500);
      }
    });
  });
}

