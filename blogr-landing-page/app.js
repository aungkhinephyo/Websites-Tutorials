const nav = document.querySelector("nav");
const menuIcon = document.querySelector(".menu-icon");
const closeIcon = document.querySelector(".close-icon");

if(menuIcon) {
    menuIcon.addEventListener("click", () => {
        nav.classList.add("active");
    })
}
if(closeIcon) {
    closeIcon.addEventListener("click", () => {
        nav.classList.remove("active");
    })
}