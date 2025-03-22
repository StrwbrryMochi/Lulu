const EntryContainer = document.querySelector(".entry-container");
const Journal = document.querySelector(".journey-modal");

function openJournal() {
    Journal.style.display = "flex";
    setTimeout(() => {
        Journal.classList.add("active");
    }, 10); 
}

function closeJournal() {
    Journal.classList.remove("active");
    setTimeout(() => {
        if (!Journal.classList.contains("active")) {
            Journal.style.display = "none";
        }
    }, 300);
}

function toggleJournal() {
    if (Journal.classList.contains("active")) {
        closeJournal();
    } else {
        openJournal();
    }
}