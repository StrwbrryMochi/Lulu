<?php
include '../Backend/connections.php';
session_start();

if (isset($_SESSION['Email'])) { 
    $Email = $_SESSION['Email'];

    $sqlfetch = "SELECT * FROM usertbl WHERE Email = '$Email'";
    $result = mysqli_query($conn, $sqlfetch);

    if ($conn && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['userID'];
    }

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Birthday = htmlspecialchars($_POST['Birthday']);
    $Address = htmlspecialchars($_POST['Address']);
    $Contact = htmlspecialchars($_POST['Contact']);

    $stmt = $conn->prepare("UPDATE usertbl SET Birthday = '$Birthday', Address = '$Address', Contact = '$Contact' WHERE userID = $userID");

    if ($stmt->execute()) {
        $_SESSION['Email'] = $Email;
        echo "<script>window.location.href='RegisterPhoto.php';</script>";
    } else {
        echo "<script>alert('Error registering user: " . $stmt->error . "'); window.location.href='register2.php?register_error=true';</script>";
    }

    $stmt->close();
    $connections->close();
}

} else {
    echo "You are not in session";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Assets/Images/Lulu.svg">
    <link rel="stylesheet" href="../Assets/Styles/auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="lib/js/flatpickr.min.js"></script>
    <title>Create an Account</title>
</head>
<body>
    <div class="form-container">
    <Button class="backBtn">
        <i class="fa-solid fa-arrow-left"></i>
    </Button>
        <div class="logo-container">
            <img src="../Assets/Images/Lulu.svg" alt="">
            <h1>Lulu</h1>
        </div>
        <div class="header">
            <h1>Sign Up</h1>
            <p>Enter your details</p>
        </div>
        <form action="Register2.php" method="POST">
            <div class="input-box">
                <input type="text" id="birthday" name="Birthday" required autocomplete="off" placeholder=" ">
                <label for="birthday">Birthday</label>
            </div>

            <div class="input-box">
                <input type="text" id="address" name="Address" required autocomplete="off" placeholder=" ">
                <label for="address">Address</label>
            </div>

            <div class="input-box">
                <input type="text" id="phone" name="Contact" required autocomplete="off" placeholder=" ">
                <label for="phone">Contact</label>
            </div>
            <Button type="submit">Next</Button>
        </form>
    </div>
    <div class="image-container">
        <div class="box">
            <img src="../Assets/Images/Lulu.svg" alt="">
        </div>
        <div class="progress">
            <div class="circle">
                <h1>1</h1>
            </div>
            <div class="circle">
                <h1>2</h1>
            </div>
            <div class="circle">
                <h1>3</h1>
            </div>
            <div class="line"></div>
        </div>
        <?php include '../Components/Image3.php';?>
    </div>
</body>
</html>

<script>
    const Back = document.querySelector(".backBtn");

    Back.addEventListener("click", function () {
        window.location.href = 'Register1.php';
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#birthday", {
            dateFormat: "Y-m-d",
            maxDate: "today" 
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const line = document.querySelector(".line");

        // Set the height after a delay to trigger the transition
        setTimeout(() => {
            line.style.height = "150px"; 
        }, 500);
    });
</script>