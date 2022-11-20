//------------------------ sidebar-----------------------------------
const menuItems = document.querySelectorAll(".menu-item");
const noti_popup = document.querySelector(".notifications-popup");

function removeAllActive(array) {
    for (let i = 0; i < array.length; i++) {
        array[i].classList.remove("active");
    }
}

menuItems.forEach(item => {
    item.addEventListener("click", () => {
        removeAllActive(menuItems);
        item.classList.add("active");

        if (item.id != "notifications") {
            noti_popup.style.display = "none";
            document.querySelector("#notifications .notification-count").style.display = "block";
        } else {
            noti_popup.style.display = "block";
            document.querySelector("#notifications .notification-count").style.display = "none";
        }

    })
})


// -----------------messages----------------------------
const messagesnoti = document.querySelector("#messages-notifications");
const messages = document.querySelector(".right .messages");

const message = messages.querySelectorAll(".message");
const searchBox = messages.querySelector(".search-bar input[type='search']");

// highlight messagesbox when click the menu-item-messages
messagesnoti.addEventListener("click", () => {

    messagesnoti.querySelector(".notification-count").style.display = "none";

    messages.style.boxShadow = "0 0 1rem var(--color-primary)";

    setTimeout(() => {
        messages.style.boxShadow = "none";
    }, 2000)
    
})

// messages filter
function filterMessages(text) {

    let searchText = text.toLowerCase();

    message.forEach(user => {

        let userName = user.querySelector("h5").innerText.toLowerCase();

        if (userName.includes(searchText)) {
            user.style.display = "flex";
        } else {
            user.style.display = "none";
        }
    })

}

searchBox.addEventListener("input", () => {
    filterMessages(searchBox.value);
})


// --------------------------------------------Themes-------------------------------------------
const themes = document.querySelector("#themes");
const themeModal = document.querySelector(".customize-theme");

// open modal
themes.addEventListener("click", () => {
    themeModal.style.display = "grid";
})

// close modal
window.addEventListener("click", function (e) {
    if (e.target == themeModal) {
        themeModal.style.display = "none";
        removeAllActive(menuItems);
    }
})


/* -------------FONT SIZE----------------------- */
const fontSizes = document.querySelectorAll(".choose-size span");
var root = document.querySelector(":root");

fontSizes.forEach(size => {
    size.addEventListener("click", () => {

        removeAllActive(fontSizes);
        size.classList.add("active");

        let font_size = '';

        switch (size.className) {
            case "font-size-1 active":
                font_size = '10px';
                root.style.setProperty("--sticky-top-left", "5.4rem");
                root.style.setProperty("--sticky-top-right", "5.4rem");
                break;
            case "font-size-2 active":
                font_size = '13px';
                root.style.setProperty("--sticky-top-left", "5.4rem");
                root.style.setProperty("--sticky-top-right", "-7rem");
                break;
            case "font-size-3 active":
                font_size = '16px';
                root.style.setProperty("--sticky-top-left", "2rem");
                root.style.setProperty("--sticky-top-right", "-17rem");
                break;
            case "font-size-4 active":
                font_size = '19px';
                root.style.setProperty("--sticky-top-left", "-5rem");
                root.style.setProperty("--sticky-top-right", "-25rem");
                break;
            case "font-size-5 active":
                font_size = '22px';
                root.style.setProperty("--sticky-top-left", "-10rem");
                root.style.setProperty("--sticky-top-right", "-33rem");
                break;
            default:
                break;
        }

        document.querySelector("html").style.fontSize = font_size;
    })
})


/* --------------------Primary Color----------------------- */
const colors = document.querySelectorAll(".choose-color span");

colors.forEach(color => {
    color.addEventListener("click", () => {

        removeAllActive(colors);
        color.classList.add("active");

        switch (color.className) {
            case "color-1 active":
                root.style.setProperty("--color-primary","hsl(252, 75%, 60%)");
                break;
            case "color-2 active":
                root.style.setProperty("--color-primary","hsl(52,75%,60%)");
                break;
            case "color-3 active":
                root.style.setProperty("--color-primary","hsl(0, 95%, 65%)");
                break;
            case "color-4 active":
                root.style.setProperty("--color-primary","hsl(120, 95%, 65%)");
                break;
            case "color-5 active":
                root.style.setProperty("--color-primary","hsl(202,75%,60%)");
                break; 
            default:
                break;
        }

    })
})


/* -----------------Background Color---------------------------- */
const bgs = document.querySelectorAll(".choose-bg div");

bgs.forEach(bg => {
    bg.addEventListener("click", () => {
        removeAllActive(bgs);
        bg.classList.add("active");

        switch (bg.className) {
            case "bg-1 active":
                root.style.setProperty("--light-color-lightness", "95%");
                root.style.setProperty("--white-color-lightness", "100%");
                root.style.setProperty("--dark-color-lightness", "17%");
                break;
            case "bg-2 active":
                root.style.setProperty("--light-color-lightness", "15%");
                root.style.setProperty("--white-color-lightness", "20%");
                root.style.setProperty("--dark-color-lightness", "95%");
                break;
            case "bg-3 active":
                root.style.setProperty("--light-color-lightness", "0%");
                root.style.setProperty("--white-color-lightness", "10%");
                root.style.setProperty("--dark-color-lightness", "195%");
                break;
            default:
                break;
        }
    })
})