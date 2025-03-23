<?php
include '../Backend/connections.php';
include '../Backend/Data.php';
include '../Backend/journal.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Assets/Images/Lulu.svg">
    <link rel="stylesheet" href="../Assets/Styles/Main.css">
    <link rel="stylesheet" href="../Assets/Resources/sweetalert.css">
    <script src="../Assets/Resources/sweetalert.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <title>Home</title>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="../Assets/Images/Lulu.svg" alt="">
        </div>
        <div class="navBtn">
            <div class="profile-border">
                <img src="<?php echo htmlspecialchars($Photo) ?>" alt="">
            </div>
        </div>
    </nav>
    <main>

        <div class="profile-modal">
            <button class="modal-back">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <img src="<?php echo htmlspecialchars($Photo)?>" alt="">
            <h1><?php echo htmlspecialchars($FirstName). ' ' . htmlspecialchars($LastName)?></h1>
            <p><?php echo htmlspecialchars($Email)?></p>
            <form action="../Backend/LogOut.php">
            <div class="modal-btn">
                <button type="button">
                    <i class="fa-solid fa-user"></i>
                    Account
                </button>
                    <button type="submit">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Log Out
                    </button>
            </div>
            </form>
        </div>

        <div class="journal-modal">
            <div class="journal-header">
                <h1>Your Journals</h1>
                <button class="close-journal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="journal-body">
                <?php
               $journals = fetchJournal($conn, $userID);
               foreach ($journals as $journalData):
                $formattedDate = date("F j, Y", strtotime($journalData['created_at']));
                $formattedTime = date("g:i A", strtotime($journalData['created_at'])); 
                ?>
                    <div class="journal"
                        data-entry="<?= htmlspecialchars($journalData['entry']) ?>" 
                        data-title="<?= htmlspecialchars($journalData['journal_title']) ?>"
                        data-date="<?= date("F j, Y", strtotime($journalData['created_at'])) ?>"
                        data-time="<?= date("g:i A", strtotime($journalData['created_at'])) ?>"
                        data-id="<?= $journalData['journal_id'] ?>">
                        <div class="journal-title">
                            <?= htmlspecialchars($journalData['journal_title'])?>
                            <p><?= $formattedDate ?></p>
                        </div>
                        <div class="journal-time">
                            <?= $formattedTime ?>
                        </div>
                    </div>  
                <?php endforeach; ?>
            </div>
                <button class="add-journal">
                    <i class="fa-solid fa-plus"></i>
                </button>
        </div>

        <div class="Entry">
            <form action="../Backend/journal.php" method="POST">
            <div class="Entry-header">
                <button class="back-entry" type="button">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <input type="text" placeholder="Title" name="journal-name" required autocomplete="off">
                <button class="close-entry" type="button">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <textarea name="journal-entry" id="" required></textarea>
                <button class="add-Entry" type="submit" name="submit-journal">
                    <i class="fa-solid fa-check"></i>
                </button>
            </form>
        </div>

        <div class="view-entry">
            <div class="Entry-header">
                <button class="back-entry" type="button">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <div class="entry-header">
                    <h1></h1>
                    <p></p>
                </div>
                <button class="close-entry" type="button">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="user-entry"></div>
        </div>

        <div class="Dashboard">
            <div class="grid1">
                <div class="greet">
                    It's good to see you again, <span><?php echo htmlspecialchars($FirstName)?></span>. You're in a safe space!
                </div>
                <img src="../Assets/Images/Greetings.svg" alt="">
            </div>
            <div class="grid2">
                <div class="title">Mood</div>
                <img src="../Assets/Images/Emojis/happy-svgrepo-com.svg" alt="">
            </div>
            <div class="grid3">
                <div class="title">Self-Journal</div>
                <?php
                $latestEntry = fetchLatestJournal($conn, $userID);
                ?>
                <div class="entry-container">
                <?php if ($latestEntry): ?>
                    <?= htmlspecialchars($latestEntry) ?>
                <?php else: ?>
                    What's on your mind, <?= htmlspecialchars($FirstName) ?>?
                <?php endif; ?>
                </div>
            </div>

            <div class="grid4">
                <div class="title">Self-care Routine</div>
                <div class="routines">
                <label class="round-checkbox">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="round-checkbox">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="round-checkbox">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="round-checkbox">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="round-checkbox">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            
                </div>
            </div>
            <div class="grid5">
                <div class="title">Your Wellness Recap</div>
            </div>
        </div>
        <div class="Lulu-Main">
            <img src="../Assets/Images/logos.svg" alt="">
        </div>
    </main>
    <footer>
        <button class="active">
            <i class="fa-solid fa-house"></i>
            <p>Home</p>
        </button>
        <div class="LuluBorder">
            <div class="Lulu-Footer">
                <img src="../Assets/Images/logos.svg" alt="">
            </div>
        </div>
        <button class="option">
                <i class="fa-solid fa-gear"></i>
                <p>Settings</p>
        </button>
    </footer>
</body>
</html>

<?php include '../Backend/alerts.php'; ?>

<script>
    const Lulu = document.querySelector(".Lulu-Main");
    const LuluMobile = document.querySelector(".Lulu-Footer");

    Lulu.addEventListener("click", function (){
        window.location.href = "Lulu.php";
    });

    LuluMobile.addEventListener("click", function() {
        window.location.href = "Lulu.php";
    })
</script>

<script src="../Assets/Scripts/Modal.js"></script>
<script src="../Assets/Scripts/Journal.js"></script>