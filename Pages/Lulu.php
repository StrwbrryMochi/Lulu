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
    <link rel="stylesheet" href="../Assets/Styles/Chat.css">
    <link rel="stylesheet" href="../Assets/Resources/sweetalert.css">
    <script src="../Assets/Resources/sweetalert.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <title>Chat</title>
</head>
<body>

    <nav>
        <button class="navHome">
            <i class="fa-solid fa-house"></i>
        </button>
        <div class="navBtn">
            <div class="profile-border">
                <img src="<?php echo htmlspecialchars($Photo) ?>" alt="">
            </div>
        </div>
    </nav>

    <main>

    <button class="home">
        <i class="fa-solid fa-house"></i>
    </button>

    <div class="user-border">
        <img src="<?php echo htmlspecialchars($Photo) ?>" alt="">
    </div>

        <div class="Chat-container">
            <div class="Chat"></div>
            <div class="Input-Container">
                <textarea name="" id="" placeholder="What's on your mind, <?php echo htmlspecialchars($FirstName)?>?"></textarea>
                <button>
                    <i class="fa-solid fa-arrow-up"></i>
                </button>
            </div>
        </div>
    </main>
</body>
</html>

<?php include '../Backend/alerts.php'; ?>

<script>
    const Home = document.querySelector(".home");
    const HomeMobile = document.querySelector(".navHome");

    Home.addEventListener("click", function() {
        window.location.href = "Main.php";
    });

    HomeMobile.addEventListener("click", function() {
        window.location.href = "Main.php";
    });
</script>

<script src="../Assets/Scripts/Chat.js"></script>