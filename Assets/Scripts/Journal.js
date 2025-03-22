const EntryContainer = document.querySelector(".entry-container");
const Journal = document.querySelector(".journey-modal");

function openJournal() {
    Journal.style.display = "flex";
    setTimeout(() => {
        Journal.classList.add("active");
    }, 10); 
}

function closeJournal() {
    profileModal.classList.remove("active");
    setTimeout(() => {
        if (!profileModal.classList.contains("active")) {
            profileModal.style.display = "none";
        }
    }, 300);
}

function toggleJournal() {
    if (profileModal.classList.contains("active")) {
        closeModal();
    } else {
        openModal();
    }
}