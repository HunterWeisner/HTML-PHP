<?php 

session_start();
require_once('../util/security.php');

//confirm user is authorized for the page
Security::checkAuthority('admin');

//user clicked the logout button
if(isset($_POST['logout'])){
    Security::logout();
}

?>

<html>
<head>
    <title>Hunter Weisner Wk 4 Performance Assessment</title>
</head>
<body>
    <h1>Hunter Weisner Wk 4 Performance Assessment</h1>
    <h2>Administrator Options</h2>
    <ul>
        <li><a href="../view/admin_view_accounts.php">Manage Users</a></li>
        <li><a href="../view/admin_view_images.php">Manage Images</a></li>
    </ul>
    <form method="POST">
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>