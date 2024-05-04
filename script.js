let isHiddenMenu = false;
const toggleMenu = document.getElementById("toggleMenu");
const navbarMenu = document.getElementById("navbarMenu");

toggleMenu.addEventListener("click", () => {
  isHiddenMenu = !isHiddenMenu;
  if (isHiddenMenu) {
    navbarMenu.style.display = "none";
  } else {
    navbarMenu.style.display = "flex";
  }
});

function handleWindowResize() {
  const windowWidth = window.innerWidth;
  if (windowWidth > 720) {
    navbarMenu.style.display = "flex";
    navbarMenu.classList.add("flex-row");
  } else {
    navbarMenu.style.display = "none";
  }
}

window.addEventListener("resize", handleWindowResize);

handleWindowResize();
