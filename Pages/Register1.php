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
    $FirstName = htmlspecialchars($_POST['FirstName']);
    $LastName = htmlspecialchars($_POST['LastName']);
    $Gender = htmlspecialchars($_POST['Gender']);

    $stmt = $conn->prepare("UPDATE usertbl SET FirstName = '$FirstName', LastName = '$LastName', Gender = '$Gender' WHERE userID = $userID");

    if ($stmt->execute()) {
        $_SESSION['Email'] = $Email;
        echo "<script>window.location.href='Register2.php';</script>";
    } else {
        echo "<script>alert('Error registering user: " . $stmt->error . "'); window.location.href='register1.php?register_error=true';</script>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
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
        <form action="Register1.php" method="POST">
            <div class="input-box">
                <input type="text" id="fName" name="FirstName" required autocomplete="off" placeholder=" ">
                <label for="fName">First Name</label>
            </div>

            <div class="input-box">
                <input type="text" id="lName" name="LastName" required autocomplete="off" placeholder=" ">
                <label for="lName">Last Name</label>
            </div>

            <div class="input-box">
            <select id="gender" name="Gender" onchange="changeColor(); moveLabel('gender')" required>
                <option value="" disabled selected>Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label for="gender">Gender</label>
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
        <?php include '../Components/Image2.php';?>
    </div>
</body>
</html>

<script>
    const Back = document.querySelector(".backBtn");

    Back.addEventListener("click", function () {
        window.location.href = 'Register.php';
    });
</script>

<script>
      window.addEventListener('load', function(){
        document.querySelector('.register-details-form').classList.add('visible');
      })
    </script>

    <script>
        window.addEventListener('load', function() {
            document.querySelector('.details-svg-wrapper').classList.add('show');
        })
    </script>
    
    <script>
        function changeColor() {
            var genderSelect = document.getElementById('gender');

            if (genderSelect.value) {
                genderSelect.style.color = 'black';
            }
            
        }

        function moveLabel(inputId) {
            var inputElement = document.getElementById(inputId);
            var label = document.querySelector('label[for="' + inputId + '"]');

            if (inputElement.value) {
                label.style.top = '-8px';
                label.style.left = '16px';
                label.style.fontSize = '1.1em';
                label.style.color = 'var(--main)';
                label.style.backgroundColor = 'var(--light)';
            } else {
                label.style.top = '15px';
                label.style.left = '16px';
                label.style.fontSize = '1.2em';
                label.style.color = '#c0c0c0';
                label.style.backgroundColor = '#fff';
            }
        }

        // Initial check to position the labels if inputs already have values
        document.addEventListener('DOMContentLoaded', function() {
            moveLabel('gender');
        });
    </script>