<?php
include('db.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    
       
</head>
<body>
    <form action="" method="POST">
 
        <h2>Đăng nhập</h2>

        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>

        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" required>

        <button type="submit">Đăng nhập</button>

        <div class="register-link">
            <p>Nếu chưa có tài khoản, <a href="register.php">đăng ký ngay</a>.</p>
        </div>
    </form>
   
</body>
<footer>
        <p>&copy;Make By K227007 CHU VAN TIEN HUNG</p>
    </footer>

</html>
