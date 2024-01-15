<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if (isset($_GET['title']) && isset($_GET['content'])) {
    $title = $_GET['title'];
    $content = $_GET['content'];

    // Thực hiện truy vấn xóa "memo"
    $deleteSql = "DELETE FROM memos WHERE title = ? AND content = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Chuyển hướng sau khi xóa
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid request";
}
?>
