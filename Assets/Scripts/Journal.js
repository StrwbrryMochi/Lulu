const EntryContainer = document.querySelector(".entry-container");
const Journal = document.querySelector(".journal-modal");
const closeJournalBtn = document.querySelector(".close-journal");
const AddJournal = document.querySelector(".add-journal");
const Entry = document.querySelector(".Entry");
const BackEntry = document.querySelectorAll(".back-entry");
const closeEntryBtn = document.querySelectorAll(".close-entry");
const ViewEntryContainer = document.querySelector(".view-entry");

function openJournal() {
    closeViewEntry();
    closeEntry();
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

function openEntry() {
    closeJournal();
    Entry.style.display = "flex";
    setTimeout(() => {
        Entry.classList.add("active");
    }, 10);
}


function closeEntry() {
    Entry.classList.remove("active");
    setTimeout(() => {
        if (!Entry.classList.contains("active")) {
            Entry.style.display = "none";
        }
    }, 300);
}

function openViewEntry(journal) {
    closeEntry();
    closeJournal();
    
    const title = journal.dataset.title;
    const entry = journal.dataset.entry;
    const date = journal.dataset.date;
    const time = journal.dataset.time;

    document.querySelector(".entry-header h1").textContent = title;
    document.querySelector(".entry-header p").textContent = `${date} • ${time}`;
    document.querySelector(".user-entry").innerHTML = `<p>${entry.replace(/\n/g, "<br>")}</p>`;
    
    ViewEntryContainer.style.display = "flex";
    setTimeout(() => {
        ViewEntryContainer.classList.add("active");
    }, 10);
}

function closeViewEntry() {
    ViewEntryContainer.classList.remove("active");
    setTimeout(() => {
        if (!ViewEntryContainer.classList.contains("active")) {
            ViewEntryContainer.style.display = "none";
        }
    }, 300);
}

EntryContainer.addEventListener("click", openJournal);
closeJournalBtn.addEventListener("click", closeJournal);
AddJournal.addEventListener("click", openEntry);

BackEntry.forEach(button => {
    button.addEventListener("click", function () {
        
        if (this.closest(".view-entry")) {
            closeViewEntry();
            setTimeout(() => {
                openJournal(); 
            }, 300);
        } else {
            closeEntry();
            setTimeout(() => {
                openJournal(); 
            }, 300);
        }
    });
});

closeEntryBtn.forEach(button => {
    button.addEventListener("click", function () {
        if (this.closest(".view-entry")) {
            closeViewEntry();
        } else {
            closeEntry();
        }
    });
});

document.querySelectorAll(".journal").forEach(journal => {
    journal.addEventListener("click", function () {
        openViewEntry(this);
    });
});
