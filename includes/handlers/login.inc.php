<?php
if (isset($_POST['LoginButton'])) {
    $LoginUsername = $_POST['LoginUsername'];
    $LoginPassword = $_POST['LoginPassword'];

    $result = $account -> login( $LoginUsername, $LoginPassword );
    if ($result == true) {
        $_SESSION['userLoggedIn'] = $LoginUsername;
        header("Location: index.php");
    }
}
?>