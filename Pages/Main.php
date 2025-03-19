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
            <button class="notif">
                <i class="fa-solid fa-bell"></i>
            </button>
            <div class="profile-border">
                <img src="<?php echo htmlspecialchars($Photo) ?>" alt="">
            </div>
        </div>
    </nav>
    <main>
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