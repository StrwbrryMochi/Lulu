<?php
include '../Backend/connections.php';
include '../Backend/Data.php';
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
            <div class="modal-btn">
                <button>
                    <i class="fa-solid fa-user"></i>
                    Account
                </button>
                <button>
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Log Out
                </button>
            </div>
        </div>

        <div class="Dashboard">
            <div class="grid1">
                <div class="greet">
                    It's good to see you again, <span><?php echo htmlspecialchars($FirstName)?></span>. You're in a safe space!
                </div>
                <img src="../Assets/Images/Greetings.svg" alt="">
            </div>
            <div class="grid2"></div>
            <div class="grid3"></div>
            <div class="grid4"></div>
            <div class="grid5"></div>
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
        <button>
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