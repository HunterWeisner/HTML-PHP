<?php 
    require_once('../control/user.php');
    require_once('../control/user_controller.php');
    require_once('../control/validation.php');
    require_once('../control/level.php');
    require_once('../control/level_controller.php');
    
    //default user for add
    $levels = LevelController::getAllLevels();
    $user = new User('','','','','','','',$levels[0]);
    $user->setUserNo(-1);
    $pageTitle = "add a New User";

    //create error messages
    $userIDError='';
    $passwordError='';
    $fNameError='';
    $lNameError='';
    $hireDateError='';
    $eMailError='';
    $extensionError='';

    //get user from qstring
    if(isset($_GET['uNo'])){
        $user =
            UserController::getUserbyNo($_GET['uNo']);
            $test = $_GET['uNo'];
        $pageTitle = "Update an Existing User";
    }
    
    if(isset($_POST['save'])){
        //save button pressed
        //reset error messages
        $userIDError='';
        $passwordError='';
        $fNameError='';
        $lNameError='';
        $hireDateError='';
        $eMailError='';
        $extensionError='';
        //check for required fields
        Validation\requiredValidator($_POST['userID'], $userIDError);
        Validation\requiredValidator($_POST['password'], $passwordError);
        Validation\requiredValidator($_POST['fName'], $fNameError);
        Validation\requiredValidator($_POST['lName'], $lNameError);
        Validation\requiredValidator($_POST['hireDate'], $hireDateError);
        Validation\requiredValidator($_POST['eMail'], $eMailError);
        Validation\requiredValidator($_POST['extension'], $extensionError);
        //check for specific formats
        Validation\passwordValidator($_POST['password'], $passwordError);
        Validation\lenValidator($_POST['userID'], 4, $userIDError);
        Validation\lenValidator($_POST['fName'], 2, $fNameError);
        Validation\lenValidator($_POST['lName'], 2, $lNameError);
        Validation\eMailValidator($_POST['eMail'], $eMailError);
        Validation\extensionValidator($_POST['extension'], $extensionError);


        if(strlen($fNameError) == 0 && strlen($lNameError) == 0 && strlen($eMailError) == 0
            && strlen($userIDError) == 0 && strlen($passwordError) == 0 && strlen($extensionError) == 0
            && strlen($hireDateError) == 0)
        {
            
            $user = new User($_POST['userID'],$_POST['fName'], $_POST['lName'],$_POST['hireDate'],$_POST['eMail'],
                $_POST['password'], $_POST['extension'],$levels[$_POST['userLevel']-1]);
            $user->setUserNo($_POST['uNo']);

            if($user->getUserNo() === '-1'){
                //add
                UserController::addUser($user);
            
            }else{
                //update
                UserController::updateUser($user);
            
            }
    
            //return user list
            header('Location: ./admin_view_accounts.php');

        }
        
        
    }
    
    if(isset($_POST['cancel'])){
        //cancel and return to list
        header('Location: ./admin_view_accounts.php');
    }
    
?>

<html>
<head>
    <title>Hunter Weisner Final Practical</title>
</head>
<body>
    <h1>Hunter Weisner Final Practical</h1>
    <h2><?php echo $pageTitle ?></h2>
    <form method="POST">
        <h3>User ID: <input type="text" name="userID"
            value="<?php echo $user->getUserID(); ?>"/>
            <?php if(strlen($userIDError)> 0){
                echo "<span style='color: red;'>{$userIDError}</span>";
            }?>
        </h3>
        <h3>Password: <input type="text" name="password"
            value="<?php echo $user->getPassword(); ?>"/>
            <?php if(strlen($passwordError)> 0){
                echo "<span style='color: red;'>{$passwordError}</span>";
            }?>
        </h3>
        <h3>First Name: <input type="text" name="fName"
            value="<?php echo $user->getFirstName(); ?>"/>
            <?php if(strlen($fNameError)> 0){
                echo "<span style='color: red;'>{$fNameError}</span>";
            }?>
        </h3>
        <h3>Last Name: <input type="text" name="lName"
            value="<?php echo $user->getLastName(); ?>"/>
            <?php if(strlen($lNameError)> 0){
                echo "<span style='color: red;'>{$lNameError}</span>";
            }?>
        </h3>
        <h3>Hire Date: <input type="date" name="hireDate"
            value="<?php echo $user->getHireDate(); ?>"/>
            <?php if(strlen($hireDateError)> 0){
                echo "<span style='color: red;'>{$hireDateError}</span>";
            }?>
        </h3>
        <h3>E-Mail: <input type="text" name="eMail"
            value="<?php echo $user->getEMail(); ?>"/>
            <?php if(strlen($eMailError)> 0){ 
                echo "<span style='color: red;'>{$eMailError}</span>";
            }?>
        </h3>
        <h3>Extension: <input type="text" name="extension"
            value="<?php echo $user->getExtension(); ?>"/>
            <?php if(strlen($extensionError)> 0){ 
                echo "<span style='color: red;'>{$extensionError}</span>";
            }?>
        </h3>
        <h3>Level: <select name="userLevel">
            <?php foreach($levels as $level) : ?>
                <option value="<?php echo $level->getLevelNo(); ?>"
                    <?php if ($level->getLevelNo() ===
                        $user->getUserLevel()->getLevelNo()){
                        echo 'selected';}?>>
                <?php echo $level->getLevelName(); ?></option>
            <?php endforeach ?>
        </select></h3>
        <input type="hidden"
            value="<?php echo $user->getUserNo(); ?>" name="uNo"> 
        <input type="submit" name="save" value="Save">
        <input type="submit" name="cancel" value="Cancel">

    </form>
</body>
</html>