// change navbar style on scroll 

window.addEventListener('scroll', () => {
    document.querySelector('nav').classList.toggle('window-scroll', window.scrollY > 0)
})

// FAQ open

const faqs = document.querySelectorAll(".faq");


faqs.forEach(faq => {
    faq.addEventListener("click", () => {
        faq.classList.toggle("open");

        //change icon
        const icon = faq.querySelector(".faq__icon i");
        if(icon.className === "fa-solid fa-plus") {
            icon.className = "fa-solid fa-minus";
        }else {
            icon.className = "fa-solid fa-plus"
        }
        
    })
})

// show and hide nav-menu

const nav__menu = document.querySelector(".nav__menu");
const openBtn = document.querySelector("#open-menu-btn");
const closeBtn = document.querySelector("#close-menu-btn");

openBtn.addEventListener('click', () => {
    nav__menu.style.display = "flex";
    openBtn.style.display = "none";
    closeBtn.style.display = "block";
 });
 closeBtn.addEventListener('click', () => {
    nav__menu.style.display = "none";
    openBtn.style.display = "block";
    closeBtn.style.display = "none"
 })


 /* progress */
const progress = document.querySelector('#progress')
const progressValue = document.querySelector('#progress-value')
 
window.addEventListener("scroll", function () {
    var getscrolltop = document.documentElement.scrollTop;
    var getscrollheight = document.documentElement.scrollHeight;
    var getclientheight = document.documentElement.clientHeight;
    
    var calcheight = getscrollheight - getclientheight;
    var finalheight = Math.round((getscrolltop * 100) / calcheight);

    progress.style.background = `conic-gradient(#00bf8e ${finalheight}%,#ffffffb3 ${finalheight}%)`;
    progressValue.textContent = `${finalheight}%`;
})
