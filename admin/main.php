<?php
session_start();
// Include the configuration file
include_once '../config.php';
// Check if admin is logged in
if (!isset($_SESSION['admin_loggedin'])) {
    header('Location: login.php');
    exit;
}
try {
    $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
}
// Template admin header
function template_admin_header($title, $selected = 'dashboard') {
    global $pdo;
    // Retrieve the total number of unread messages
    $stmt = $pdo->prepare('SELECT COUNT(*) AS total FROM messages WHERE is_read = 0');
    $stmt->execute();
    $unread_messages = $stmt->fetchColumn();
    // Admin HTML links
    $admin_links = '
        <a href="index.php"' . ($selected == 'dashboard' ? ' class="selected"' : '') . '><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        <a href="messages.php"' . ($selected == 'messages' ? ' class="selected"' : '') . '><i class="fas fa-inbox"></i>Messages<span>' . $unread_messages . '</span></a>
        <a href="posts.php"' . ($selected == 'posts' ? ' class="selected"' : '') . '><i class="fas fa-comment-dots"></i>Blog posts</a>
        <a href="comments.php"' . ($selected == 'comments' ? ' class="selected"' : '') . '><i class="fas fa-comment-dots"></i>Blog comments</a>
        <a href="settings.php"' . ($selected == 'settings' ? ' class="selected"' : '') . '><i class="fas fa-tools"></i>Settings</a>
    ';
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>$title</title>
		<link href="admin.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="adminjostyle.css" rel="stylesheet" type="text/css">
        <!-- Include TinyMCE stylesheet -->
        <link rel="stylesheet" href="../vendor/tinymce/tinymce/skins/ui/oxide/skin.min.css">

        <!-- Include TinyMCE script -->
        <script src="../vendor/tinymce/tinymce/tinymce.min.js"></script>


	</head>
	<body class="admin">
        <aside class="responsive-width-100 responsive-hidden">
            <h1>Admin Panel</h1>
            $admin_links
        </aside>
        <main class="responsive-width-100">
            <header>
                <a class="responsive-toggle" href="#">
                    <i class="fas fa-bars"></i>
                </a>
                <div class="space-between"></div>
                <a href="about.php" class="right"><i class="fas fa-question-circle"></i></a>
                <a href="logout.php" class="right"><i class="fas fa-sign-out-alt"></i></a>
            </header>
EOT;
}
// Template admin footer
function template_admin_footer() {
echo <<<EOT
        </main>
        <script>
        document.querySelector(".responsive-toggle").onclick = function(event) {
            event.preventDefault();
            let aside = document.querySelector("aside"), main = document.querySelector("main"), header = document.querySelector("header");
            let asideStyle = window.getComputedStyle(aside);
            if (asideStyle.display == "none") {
                aside.classList.remove("closed", "responsive-hidden");
                main.classList.remove("full");
                header.classList.remove("full");
            } else {
                aside.classList.add("closed", "responsive-hidden");
                main.classList.add("full");
                header.classList.add("full");
            }
        };
        </script>
    </body>
</html>
EOT;
}
?>
