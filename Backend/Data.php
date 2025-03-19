<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['Email'])) { 
    $Email = $_SESSION['Email'];
    
    $sqlfetch = "SELECT * FROM usertbl WHERE Email = ?";
    $stmt = $conn->prepare($sqlfetch);
    
    if (!$stmt) {
        die("SQL prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $Email);
    
    if (!$stmt->execute()) {
        die("SQL execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        
        
        $FirstName = $row['FirstName'];
        $LastName = $row['LastName'];
        $Email = $row['Email'];
        $Gender = $row['Gender'];
        $Contact = $row['Contact'];
        $Birthday = $row['Birthday'];
        $Address = $row['Address'];
        $Photo = '../Assets/Uploads/' . $row['Photo'];

        
        $currentUser = [
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Gender' => $Gender,
            'Contact' => $Contact,
            'Birthday' => $Birthday,
            'Address' => $Address,
            'Photo' => $Photo
        ];
    
    $stmt->close();
    $conn->close();
} else {
    echo "<script>window.location.href='../staffPage/session.php?session=error';</script>";
    exit;
}
}