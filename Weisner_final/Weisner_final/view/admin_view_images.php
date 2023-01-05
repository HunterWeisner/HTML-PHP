<?php 
session_start();
require_once('../control/image_functions.php');
require_once('../util/security.php');

//confirm user is authorized for the page
Security::checkAuthority('admin');

//user clicked the logout button
if(isset($_POST['logout'])){
    Security::logout();
}

//get logs drectory in current working directory 
$dir = getcwd() . '/images/';
$imgName = '';
//User wants to view the images for the selection
if(isset($_POST['view'])){
    $imgName = $_POST['image_file'];
}

//user wants to delete the images for the selection
if(isset($_POST['delete'])){
    $fName = $_POST['image_file'];
    $editFile = ImageUtilities::DeleteImageFiles($dir, $fName);
    $imgName = '';
}

//user wants to upload a new file
if(isset($_POST['upload'])){
    //note: normally would want some error checking on file
    //size and type here; for demo of this ability
    //we're not preforming those checks
    $target = $dir . $_FILES['new_file']['name'];
    move_uploaded_file($_FILES['new_file']['tmp_name'],
        $target);
    ImageUtilities::ProcessImage($target);
    $imgName = '';
}
?>
<html>
<head>
    <title>Hunter Weisner Wk 5 Preformance Assesment</title>
</head>
<body>
    <h1>Hunter Weisner Wk 5 Preformance Assesment</h1>
    <form method="POST">
    <h3>image Files: <select name="image_file">
        <?php foreach(ImageUtilities::GetBaseImageslist($dir) as $file) : ?>
            <option value="<?php echo $file; ?>"><?php echo $file; ?>
            </option>
        <?php endforeach; ?></select>
        <input type="submit" value="View Images" name="view">
        <input type="submit" value="Delete Image" name="delete">
    </h3>
    </form>
    <h3>Upload Image File:
        <form method="POST" enctype="multipart/form-data">
        <input type="file" name="new_file" id="new_file">
        <input type="submit" value="Upload" name="upload">
        </form>
    </h3>
    <h4>Original Image:</h4>
    <img src="images/<?php echo $imgName; ?>" alt="<?php echo $imgName; ?>">
    <h4>200px Max Image:</h4>
    <img src="images/200/<?php echo $imgName; ?>" alt="<?php echo $imgName; ?>">
    <h1><a href="https://localhost/Weisner_final/view/admin.php">Home</a></h1>
    <form method="POST">
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>