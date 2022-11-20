// admin_page
const userIcon = document.querySelector(".user_icon")
const infoBox = document.querySelector(".info_box")

userIcon.addEventListener("click", function () {
    infoBox.classList.toggle("active")
})

//admin_products
const updateModal = document.querySelector(".update_modal_bg");
const closeBtn = document.querySelector(".btn_close_modal");
const cancelBtn = document.querySelector(".cancel_btn");

if (closeBtn) {
    closeBtn.addEventListener("click", function () {
        updateModal.style.display = "none";
        window.location.href = 'http://localhost:8000/admin_products.php';
    }
    )
}
if (cancelBtn) {
    cancelBtn.addEventListener("click", function () {
        updateModal.style.display = "none";
        window.location.href = 'http://localhost:8000/admin_products.php';
    }
    )
}

// admin messages
const messageEls = document.querySelectorAll('.message');
const messageInput = document.querySelectorAll('.message_hidden');

messageEls.forEach((messageEl,index) => {
    messageEl.innerHTML = messageInput[index].value.substring(0, 75);
})

const messageModal = document.querySelector(".message_modal_bg");
const messageCloseBtn = document.querySelector(".btn_close_message");
if (messageCloseBtn) {
    messageCloseBtn.addEventListener("click", function () {
        messageModal.style.display = "none";
        window.location.href = 'http://localhost:8000/admin_messages.php';
    }
    )
}