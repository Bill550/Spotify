<?php

/////////////////////////////////////////////////////////////////////
    function sanitizeFormUsername($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ","",$inputText);
        return $inputText;
    }
    function sanitizeFormString($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ","",$inputText);
        $inputText = ucfirst(strtolower($inputText));
        return $inputText;
    }
    function sanitizeFormPassword($inputText){
        $inputText = strip_tags($inputText);
        return $inputText;
    }
////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
if (isset($_POST['RegisterButton'])) {
    
    $Username   = sanitizeFormUsername  ($_POST['Username']);
    $FirstName  = sanitizeFormString    ($_POST['FirstName']);
    $LastName   = sanitizeFormString    ($_POST['LastName']);
    $Email      = sanitizeFormString    ($_POST['Email']);
    $Email2     = sanitizeFormString    ($_POST['Email2']);
    $Password   = sanitizeFormPassword  ($_POST['Password']);
    $Password2  = sanitizeFormPassword  ($_POST['Password2']);

    $wasSuccessful = $account -> register($Username, $FirstName, $LastName, $Email, $Email2, $Password, $Password2);

    if ($wasSuccessful == true) {
        header("Location: index.php");
    }

}
?>