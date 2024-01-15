<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memosTitle = $_POST['title'];
    $memosContent = $_POST['content'];
  
    
    $sql = "INSERT INTO memos (title,content) VALUES ('$memosTitle', '$memosContent')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "エラー: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
