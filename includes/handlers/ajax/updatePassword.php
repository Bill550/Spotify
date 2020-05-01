<?php
    include("../../config.php");

    if(!isset($_POST['username'])) {
        echo " ERROR: Could not set Username ";
        exit();
    }
    if (!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])  ) {
        echo "Not All Password have been Set";
        exit();
    }
    if ($_POST['oldPassword'] == "" || $_POST['newPassword1'] == "" || $_POST['newPassword2'] == "") {
        echo "Please Fill in All Fields!";
        exit();
    }

    $username = $_POST['username'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword1 = $_POST['newPassword1'];
    $newPassword2 = $_POST['newPassword2'];

    $oldMd5 = md5($oldPassword);
    $passwordCheck = mysqli_query($con, "SELECT * from users WHERE username = '$username' AND password = '$oldMd5' ");
    if(mysqli_num_rows($passwordCheck) != 1){
        echo "Old Password is Incorrect!";
        exit();
    }

    if ($newPassword1 != $newPassword2) {
        echo "Your New Password don't Match";
        exit();
    }

    if (preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
        echo "Your Password must only Contain Letters or Number ";
        exit();
    }

    if (strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
        echo "Your Password must be Between 5 and 30 Characters";
        exit();
    }

    $newMd5 = md5($newPassword1);
        $query = mysqli_query($con, "UPDATE users SET password = '$newMd5' WHERE username = '$username' ");
        echo "Update Successfully!";

?>