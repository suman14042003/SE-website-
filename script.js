// Open Registration Modal
const signupBtns = document.querySelectorAll("#signupBtn, #signupBtnMain");
const modal = document.getElementById("registrationModal");
const closeModalBtn = document.getElementById("closeModal");

signupBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        modal.style.display = "block";
    });
});

// Close Modal
closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});
