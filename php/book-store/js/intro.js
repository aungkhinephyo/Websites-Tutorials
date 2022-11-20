// show password
const eyes = document.querySelectorAll(".showpassword");
const passInputs = document.querySelectorAll("input[type='password']");

eyes.forEach(eye => {
    eye.addEventListener("click", function(){
        // console.log(this);
        var passwordBox = this.previousElementSibling;
        // console.log(passwordBox);

        if (this.classList.contains("fa-eye")) {
            // console.log(this.classList);
            // console.log(this.classList[0]);

            this.className = 'fas fa-eye-slash showpassword'
            passwordBox.setAttribute('type','text')
        } else {
            this.className = 'fas fa-eye showpassword'
            passwordBox.setAttribute('type','password')
        }
    })
})
