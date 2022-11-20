// login info
const userIcon = document.querySelector(".user_icon");
const loginInfo = document.querySelector(".login_info");

userIcon.addEventListener("click", function () {
    loginInfo.classList.toggle("active");
})

// footer
const getyear = document.querySelector("#getyear");
getyear.innerHTML = new Date().getUTCFullYear();