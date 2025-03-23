<?php
include '../Backend/connections.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $Password = htmlspecialchars($_POST['Password']);
    $ConfirmPass = htmlspecialchars($_POST['confirmPass']);

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location.href='register.php?register_error=true';</script>";
        exit;
    }

    if ($Password !== $ConfirmPass) {
        echo "<script>alert('Passwords do not match'); window.location.href='register.php?password_mismatch=true';</script>";
        exit;
    }

    $checkEmailStmt = $conn->prepare("SELECT * FROM usertbl WHERE Email = ?");
    $checkEmailStmt->bind_param("s", $Email);
    $checkEmailStmt->execute();
    $result = $checkEmailStmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>window.location.href='register.php?email_exists=true'</script>";
        $checkEmailStmt->close();
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO usertbl (Email, Password) VALUES (?, ?)");
    $stmt->bind_param("ss", $Email, $Password);

    if ($stmt->execute()) {
        $userID = $stmt->insert_id;
        $_SESSION['userID'] = $userID;
        echo "<script>window.location.href='Register1.php';</script>";
    } else {
        echo "<script>alert('Error registering user: " . $stmt->error . "'); window.location.href='register.php?register_error=true';</script>";
    }

    $stmt->close();
    $connections->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Assets/Images/Lulu.svg">
    <link rel="stylesheet" href="../Assets/Styles/auth.css">
    <title>Create an Account</title>
</head>
<body>
    <div class="form-container">
        <div class="logo-container">
            <img src="../Assets/Images/Lulu.svg" alt="">
            <h1>Lulu</h1>
        </div>
        <div class="header">
            <h1>Sign Up</h1>
            <p>Enter your details</p>
        </div>
        <form action="Register.php" method="POST">
            <div class="input-box">
                <input type="Email" id="Email" name="Email" required autocomplete="off" placeholder=" ">
                <label for="Email">Email</label>
            </div>

            <div class="input-box">
                <input type="Password" id="Password" name="Password" required autocomplete="off" placeholder=" ">
                <label for="Password">Password</label>
            </div>

            <div class="input-box">
                <input type="Password" id="confirm" name="confirmPass" required autocomplete="off" placeholder=" ">
                <label for="confirm">Confirm Password</label>
            </div>
            <Button type="submit">Create Account</Button>
            <p>Already have an account? <a href="Login.php">Sign In</a> </p>
        </form>
    </div>
    <div class="image-container">
        <div class="box">
            <img src="../Assets/Images/Lulu.svg" alt="">
        </div>
        <?php include '../Components/Image1.php';?>
    </div>
</body>
</html>