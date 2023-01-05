<?php 
session_start();

require_once('../control/file_utilities.php');
require_once('../util/security.php');

//confirm user is athourized for the apge
Security::checkAuthority('tech');

if(isset($_POST['logout'])){
    Security::logout();
}
//get logs directory current working directiory
$dir = getcwd() . "/logs/";
$viewFile = '';
$_POST['disabled'] = False;

//user selected to view file contents
if(isset($_POST['view']) || isset($_POST['load'])){
    if(isset($_POST['fileToViewOrEdit'])){
        $fName = $_POST['fileToViewOrEdit'];
        $viewFile = FileUtilities::GetFileContents($dir . $fName);
    }
    if(isset($_POST['view'])){
        $_POST['disabled'] = true;
    }else{
        $_POST['disabled'] = false;
    }

}

//User wants to save edited file contents
if(isset($_POST['save'])){
    $fName = $_POST['fileToViewOrEdit'];
    $content = $_POST['viewFile'];
    FileUtilities::WriteFile($dir . $fName, $content);
}

//user wants to create a new file
if(isset($_POST['create'])){
    $fName = $_POST['newFileName'];
    $content = $_POST['viewFile'];
    FileUtilities::WriteFile($dir . $fName, $content);
}

?>

<html>
<head>
    <title>Hunter Weisner Final Practical</title>
</head>
<body>
    <h1>Hunter Weisner Final Practical</h1>
    <h3>Manage Incident Text Files</h3>
    <form method="POST">
    <h3>View Text File: <select name="fileToViewOrEdit">
        <?php foreach(FileUtilities::GetFilesList($dir) as $file) : ?>
            <option value="<?php echo $file; ?>">
                <?php echo $file; ?>
            </option>   
        <?php endforeach; ?></select>
        <input type="submit" value="View File" name="view">
        <input type="submit" value="Edit File" name="load">
        <input type="submit" value="Save Edits" name="save">
        <input type="text" name="newFileName">
        <input type="submit" name="create" value="Create">
    </h3>
    <textarea id="viewFile" name="viewFile" rows="5" cols="50"
    <?php if($_POST['disabled']){echo "disabled";} ?>><?php echo $viewFile ?></textarea>
    </form>
    <h1><a href="https://localhost/Weisner_final/view/tech.php">Home</a></h1>
    <form method="POST">
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>