<?php 

session_start();
require_once('../util/security.php');

//confirm user is athourized for the apge
Security::checkAuthority('tech');

if(isset($_POST['logout'])){
    Security::logout();
}

?>
<html>
<head>
    <title>Weisner Final Practical</title>
</head>
<body>
    <h1>Weisner Final Practical</h1>
    <h2>Technician Menu</h2>
    <ul>
        <li><a href="../view/tech_view_incidents.php">Manage Incidents</a></li>
        <li><a href="../view/tech_view_DB_status.php">View DB Status</a></li>
    </ul>
    <form method="POST">
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>