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
    $photoFilePath = '';

    if (isset($_FILES['Photo'])) {
        if ($_FILES['Photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['Photo']['tmp_name'];
            $fileName = $_FILES['Photo']['name'];
            $fileSize = $_FILES['Photo']['size'];
            $fileType = $_FILES['Photo']['type'];

            // Validate the image file type
            $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($fileType, $allowedFileTypes)) {
                echo "<script>alert('Invalid image format. Please upload JPEG, PNG, or GIF.'); window.location.href='registerphoto.php?register_error=true';</script>";
                exit;
            }

            // Validate file size 
            if ($fileSize > 2 * 1024 * 1024) {
                echo "<script>alert('File size exceeds 2MB limit.'); window.location.href='registerphoto.php?register_error=true';</script>";
                exit;
            }

            // Move the uploaded file to the uploads directory
            $uploadFileDir = '../Assets/Uploads/';
            $newFileName = uniqid() . '_' . basename($fileName);
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photoFilePath = $newFileName; 
            } else {
                echo "<script>alert('There was an error moving the uploaded file.'); window.location.href='registerphoto.php?register_error=true';</script>";
                exit;
            }
        } else {
            echo "<script>alert('No image uploaded or there was an upload error.'); window.location.href='registerphoto.php?register_error=true';</script>";
            exit;
        }
    } else {
        echo "<script>alert('File input not set.'); window.location.href='registerphoto.php?register_error=true';</script>";
        exit;
    }


    $stmt = $conn->prepare("UPDATE usertbl SET Photo = '$photoFilePath' WHERE userID = $userID");

    if ($stmt->execute()) {
        $_SESSION['Email'] = $Email;
        echo "<script>window.location.href='Main.php';</script>";
    } else {
        echo "<script>alert('Error registering user: " . $stmt->error . "'); window.location.href='registerphoto.php?register_error=true';</script>";
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
        <form action="RegisterPhoto.php" method="POST" enctype="multipart/form-data">

        <div class="photo-box">
            <div class="drop-area" id="drop-area">
                <p>Drag & Drop your image here or <strong>click to select image</strong></p>
                <input type="file" name="Photo" id="fileElem" accept="image/*" style="display:none;">
                <img id="preview" class="preview-img" alt="Image Preview">
                <div class="file-info" id="file-info"></div>
            </div>
        </div>

            <Button type="submit" style="margin-top: 30px;">Done</Button>
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
            <div class="line" style="height: 150px;"></div>
        </div>
        <?php include '../Components/Image4.php';?>
    </div>
</body>
</html>

<script>
    const Back = document.querySelector(".backBtn");

    Back.addEventListener("click", function () {
        window.location.href = 'Register2.php';
    });
</script>

<script PhotoHandling>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');
    const previewImg = document.getElementById('preview');
    const fileInfo = document.getElementById('file-info');
    const dropText = dropArea.querySelector('p');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    // Remove highlight when dragging leaves
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);
    dropArea.addEventListener('click', () => fileInput.click(), false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        dropArea.classList.add('highlight');
    }

    function unhighlight() {
        dropArea.classList.remove('highlight');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        handleFiles(files);
    });

    function handleFiles(files) {
    fileInfo.innerHTML = '';
    if (files.length > 0) {
        const file = files[0]; 
        if (file && file.type.startsWith('image/')) {
            // Update the input's files property
            fileInput.files = files; 

            const reader = new FileReader();
                reader.onload = function (event) {
                    previewImg.src = event.target.result; 
                    previewImg.style.display = 'block'; 
                    previewImg.classList.add('grow'); 
                    dropArea.classList.add('grow');
                    dropArea.classList.add('valid');
                    dropText.style.opacity = '0';
                    fileInfo.style.opacity = '0';
                    displayPhotoError('');

                    // Remove the class after the animation duration
                    setTimeout(() => {
                        previewImg.classList.remove('grow'); 
                        dropArea.classList.remove('grow'); 
                    }, 500); 
                };
            reader.readAsDataURL(file);
            fileInfo.innerHTML = `<p>${file.name} (${(file.size / 1024).toFixed(2)} KB)</p>`;
        } else {
                Swal.fire({
            icon: 'error',
            title: 'Invalid File Type',
            text: 'Please upload a valid image file (JPEG, PNG, or GIF).',
            timer: 2000,
            showConfirmButton: false
        });
        fileInput.value = ''; 
        previewImg.style.display = 'none'; 
        fileInfo.innerHTML = '';
        dropText.style.opacity = '1'; 
        fileInfo.style.opacity = '1';
        }
    }
}
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const line = document.querySelector(".line");

        setTimeout(() => {
            line.style.height = "300px"; 
        }, 500);
    });
</script>