<?php 

session_start();
require_once('../util/security.php');
require_once('../control/user.php');
require_once('../control/user_controller.php');
require_once('../control/level.php');
require_once('../control/level_controller.php');
//confirm user is authorized for the page
Security::checkAuthority('admin');

//user clicked the logout button
if(isset($_POST['logout'])){
    Security::logout();
}

if (isset($_POST['update'])){
    //update button pressed for a user
    if(isset($_POST['uNoUpd'])){
        header('Location: ../view/add_update_user.php?uNo='. $_POST['uNoUpd']);
    }
    unset($_POST['update']);
    unset($_POST['uNoUpd']);

}

if(isset($_POST['delete'])){
    //delete button pressed for a user
    if(isset($_POST['uNoDel'])){
        UserController::deleteUser($_POST['uNoDel']);
    }
    unset($_POST['delete']);
    unset($_POST['uNoDel']);
}
?>
<html>
<head>
    <title>Hunter Weisner Final Practical</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Hunter Weisner Final Practical</h1>
    <h1>Manage User Accounts</h1>
    <h2><a href="../view/add_update_user.php">Add User</a></h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Hire Date</th>
            <th>E-Mail Address</th>
            <th>Extension</th>
            <th>Level</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach (UserController::getAllusers() as $user) : ?>
            <tr>
                <td><?php echo $user->getUserID(); ?></td>
                <td><?php echo $user->getFirstName(); ?></td>
                <td><?php echo $user->getLastName();?></td>
                <td><?php echo $user->getHireDate(); ?></td>
                <td><?php echo $user->getEMail(); ?></td>
                <td><?php echo $user->getExtension(); ?></td>
                <td><?php echo $user->getUserLevel()->getLevelName(); ?></td>
                <td><form method="POST">
                    <input type="hidden" name="uNoUpd"
                        value="<?php echo $user->getUserNo(); ?>"/>
                    <input type="submit" name="update" value="Update">
                </form></td>
                <td><form method="POST">
                    <input type="hidden" name="uNoDel" 
                        value="<?php echo $user->getUserNo(); ?>">
                    <input type="submit" value="Delete" name="delete" />
                </form></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3><a href="https://localhost/Weisner_final/view/admin.php">Home</a></h3>
    <form method="POST">
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>