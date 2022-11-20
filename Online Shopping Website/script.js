/* menubar shrink on scroll*/
const header = document.querySelector("header");
window.addEventListener("scroll", () => {
    // console.log(window.scrollY);
    if(window.scrollY < 300) {
        header.style.height = "80px";
        // header.style.background = "#e3e6f3";
    }else {
        header.style.height = "65px";
        // header.style.background = "linear-gradient(to bottom, rgba(227, 230, 243,0.8), #e3e6f3";
        // rgb(227, 230, 243)
    }
})

/*navbar responsive  */
const navbar = document.querySelector("#navbar");
const menuIcon = document.querySelector(".menu-icon");
const closeIcon = document.querySelector(".close-icon");

if(menuIcon) {
    menuIcon.addEventListener("click", () => {
        navbar.classList.add("active");
    });
}

if(closeIcon) {
    closeIcon.addEventListener("click", () => {
        navbar.classList.remove("active");
    })
}
