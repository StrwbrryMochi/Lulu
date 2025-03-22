const profileModal = document.querySelector(".profile-modal");
const profileButton = document.querySelector(".profile-border");

profileButton.addEventListener("click", function () {
    if (profileModal.style.display === "none" || profileModal.style.display === "") {
        profileModal.style.display = "flex";
        setTimeout(() => {
            profileModal.classList.add("active"); // Trigger animation
        }, 10); 
    } else {
        profileModal.classList.remove("active"); // Animate out
        setTimeout(() => {
            profileModal.style.display = "none"; // Hide after animation
        }, 300); // Matches CSS transition time
    }
});