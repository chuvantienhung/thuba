<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

// Hiển thị công việc
$sql = "SELECT * FROM memos";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    </header>

    <nav>
        <a href="#tab1" onclick="showTab('tab1')">MY MEMO</a>
        <a href="#tab2" onclick="showTab('tab2')">CREATE MEMO</a>
        <a href="logout.php">LOGOUT</a>
       
    </nav>

    <section id="tab1">
        <div class='memo_title'>
            <h2>MY MEMO</h2>
        </div>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='memo'>
                        <h3>タイトル: {$row['title']}</h3>
                        <br>
                        <p>内容: {$row['content']}</p>
                        <br>
                        <a href='#' onclick='editMemo(\"{$row['title']}\", \"{$row['content']}\")'>Edit</a>
                        <br>
                        <a href='#' onclick='confirmDelete(\"{$row['title']}\", \"{$row['content']}\")'>Delete</a>
                        </div>";
            }
        } else {
            echo "NO MEMO.";
        }
        ?>
    </section>

    <section id="tab2" style="display:none;">
        <h2>MY MEMO</h2>
    
</select>
        <form action="create_memo.php" method="POST">
            <label for="title" >MEMO TITLE: </label>
            <input type="text" name="title" required >
            <br>
            <label for="contenr">MEMO CONTENT:</label>
            <textarea name="content" rows="15"  cols="57"  required></textarea>

            <button type="submit">Submit</button>
        </form>
    </section>

    <script>
        function showTab(tabId) {
            var tabs = document.querySelectorAll('section');
            tabs.forEach(function(tab) {
                tab.style.display = 'none';
            });
            document.getElementById(tabId).style.display = 'block';
        }
    </script>
    <script>
   function confirmDelete(title, content) {
    var confirmation = confirm("このメモを削除してもよろしいですか?\nTitle: " + title + "\nContent: " + content);

    if (confirmation) {
        window.location.href = 'delete_memo.php?title=' + encodeURIComponent(title) + '&content=' + encodeURIComponent(content);
    }
}
</script>
<script>
function editMemo(title, content) {
    var newTitle = prompt("Enter new title:", title);
    var newContent = prompt("Enter new content:", content);

    if (newTitle !== null && newContent !== null) {
        // Gửi dữ liệu mới đến trang xử lý sửa
        window.location.href = 'edit_memo.php?title=' + encodeURIComponent(title) + '&newTitle=' + encodeURIComponent(newTitle) + '&newContent=' + encodeURIComponent(newContent);
    }
}
</script>
   
</body>
<footer>
        <p>&copy;2023</p>
       </footer>
</html>
