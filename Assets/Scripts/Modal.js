const profileModal = document.querySelector(".profile-modal");
const profileButton = document.querySelector(".profile-border");
const settingsButton = document.querySelector(".option");
const backButton = document.querySelector(".modal-back");

function openModal() {
    profileModal.style.display = "flex";
    setTimeout(() => {
        profileModal.classList.add("active");
    }, 10); // Small delay to allow CSS transition
}

function closeModal() {
    profileModal.classList.remove("active");
    setTimeout(() => {
        if (!profileModal.classList.contains("active")) {
            profileModal.style.display = "none";
        }
    }, 300);
}

function toggleModal() {
    if (profileModal.classList.contains("active")) {
        closeModal();
    } else {
        openModal();
    }
}

profileButton.addEventListener("click", toggleModal);
settingsButton.addEventListener("click", openModal);
backButton.addEventListener("click", closeModal);
