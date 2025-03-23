<?php
include 'connections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-journal'])) {
    session_start();

    $userID = $_SESSION['userID'];
    $journalTitle = trim($_POST['journal-name']);
    $journalEntry = trim($_POST['journal-entry']);

    if (empty($journalTitle) || empty($journalEntry)) {
        die("Title and Entry cannot be empty.");
    }

    $sql = "INSERT INTO journaltbl (userID, journal_title, entry, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $userID, $journalTitle, $journalEntry);

    if ($stmt->execute()) {
        echo "<script>window.location.href='../Pages/Main.php'</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function fetchJournal($conn, $userID) {
    $sql = "SELECT * FROM journaltbl WHERE userID = ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    return $stmt->get_result();
}

function fetchLatestJournal($conn, $userID) {
    $sql = "SELECT entry FROM journaltbl WHERE userID = ? ORDER BY created_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row['entry'];
    }
    return null;
}