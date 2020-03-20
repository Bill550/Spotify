<?php
    include("includes/config.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php");

    if (isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    }
    else {
        header("Location: register.php");
    }
?>
<html>

<head>
    <title>Welcome To Spotify!</title>
    <link rel="shortcut icon" type="image/x-icon" href="Assets/Images/Icons/logo.png" />
    <link rel="stylesheet" href="Assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="Assets/js/script.js"></script>
</head>

<body>


    <div id="mainContainer">
        <div id="topContainer">
        <?php  include("includes/navBarContainer.php");  ?>
        <div id="mainViewContainer">
            <div id="mainContent">