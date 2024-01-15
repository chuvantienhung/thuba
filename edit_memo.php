<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if (isset($_GET['title']) && isset($_GET['newTitle']) && isset($_GET['newContent'])) {
    $title = $_GET['title'];
    $newTitle = $_GET['newTitle'];
    $newContent = $_GET['newContent'];

    // Thực hiện truy vấn cập nhật "memo"
    $updateSql = "UPDATE memos SET title = ?, content = ? WHERE title = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sss", $newTitle, $newContent, $title);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Chuyển hướng sau khi sửa
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid request";
}
?>
