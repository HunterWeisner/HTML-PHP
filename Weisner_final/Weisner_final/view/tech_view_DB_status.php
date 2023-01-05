<?php 
session_start();
require_once('../model/database.php');
require_once('../util/security.php');

//confirm user is athourized for the apge
Security::checkAuthority('tech');

if(isset($_POST['logout'])){
    Security::logout();
}

//set error reporting to errors onliny
error_reporting(E_ERROR);

//create and instance of the db class

$db = new Database();

?>

<html>
<head>
    <title>Hunter Weisner Final Practical</title>
</head>

<body>
    <h1>Hunter Weisner Final Practical</h1>
    <h1>Database Connection Status</h1>
    <?php if(strlen($db->getDbError())) : ?>
        <ul>
            <li><?php echo "Database Name: "
            . $db->getDbName(); ?></li>
            <li><?php echo "Database User: "
            . $db->getDbUser(); ?></li>
            <li><?php echo"Database User Password: "
            . $db->getDbUserPw(); ?></li>
        </ul>
        <h2>Connection Failed</h2>
    <?php else : ?>
        <ul>
            <li><?php echo "Database Name: "
            . $db->getDbName(); ?></li>
            <li><?php echo "Database User: "
            . $db->getDbUser(); ?></li>
            <li><?php echo"Database User Password: "
            . $db->getDbUserPw(); ?></li>
        </ul>
        <h2>Connection Successful</h2>
    <?php endif; ?>
    <h1><a href="https://localhost/Weisner_final/view/tech.php">Home</a></h1>
    <form method="POST">
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>