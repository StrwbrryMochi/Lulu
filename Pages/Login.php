<?php
include '../Backend/connections.php';
session_start();
$Email = $passwordPost = "";

// Ensure database connection is working
if (!$conn) {
    die("Database connection failed.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["Email"])) {
        echo "<script>window.location.href='login.php?email_empty=true';</script>";
        exit; 
    } else {
        $Email = $_POST["Email"];
    }

    if (empty($_POST["Password"])) {
        echo "<script>window.location.href='login.php?password_empty=true';</script>";
        exit; 
    } else {
        $passwordPost = $_POST["Password"];
    }

    if ($Email && $passwordPost) {
        // Prepare and execute SQL query
        $stmt = $conn->prepare("SELECT userID, Password FROM usertbl WHERE Email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db_password = $row["Password"];

            // Verify password (update if passwords are stored in plain text)
            if ($passwordPost === $db_password) {
                $_SESSION['userID'] = $userID;
                echo "<script>window.location.href='Main.php?welcome=true';</script>";
                exit; // Ensure script stops executing after redirection
            } else {
                echo "<script>window.location.href='login.php?password_error=true';</script>";
                exit;
            }
        } else {
            echo "<script>window.location.href='login.php?email_error=true';</script>";
            exit;
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Assets/Images/Lulu.svg">
    <link rel="stylesheet" href="../Assets/Styles/auth.css">
    <title>Login</title>
</head>
<body>
    <div class="form-container">
        <div class="logo-container">
            <img src="../Assets/Images/Lulu.svg" alt="">
            <h1>Lulu</h1>
        </div>
        <div class="header">
            <h1>Sign In</h1>
            <p>Enter your details</p>
        </div>
        <form action="Login.php" method="POST">
            <div class="input-box">
                <input type="Email" id="Email" name="Email" required autocomplete="off" placeholder=" ">
                <label for="Email">Email</label>
            </div>

            <div class="input-box">
                <input type="Password" id="Password" name="Password" required autocomplete="off" placeholder=" ">
                <label for="Password">Password</label>
            </div>
            <Button type="submit">Sign In</Button>
            <p>Don't have an account? <a href="Register.php">Sign Up</a> </p>
        </form>
    </div>
    <div class="image-container">
        <div class="box">
            <img src="../Assets/Images/Lulu.svg" alt="">
        </div>
        <?php include '../Components/Image5.php';?>
    </div>
</body>
</html>