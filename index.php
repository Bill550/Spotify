<?php
    include("includes/config.php");
    
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
    <link rel="stylesheet" href="Assets/css/style.css">
</head>

<body>
    <div id="mainContainer">
        <div id="topContainer">
            <div id="NavbarContainer">
                <nav class="Navbar">
                    
                    <a href="index.php" class="logo">
                        <img src="Assets/Images/Icons/logo.png" alt="" srcset="">
                    </a>

                    <div class="group">
                        <div class="navItem">
                            <a href="search.php" class="navItemLink">Search
                                <img src="Assets/Images/Icons/search.png" alt="Search" class="icon">
                            </a>
                        </div>
                    </div>

                    <div class="group">
                        <div class="navItem">
                            <a href="browse.php" class="navItemLink">Browse</a>
                        </div>
                        <div class="navItem">
                            <a href="youMusic.php" class="navItemLink">Your Music</a>
                        </div>
                        <div class="navItem">
                            <a href="profile.php" class="navItemLink">Muhammad Bilal</a>
                        </div>
                    </div>

                </nav>
            </div>
        </div>

        <div id="nowPlayingBarContainer">
            <div id="nowPlayingBar">
                <div id="nowPlayingLeft">
                    <div class="content">
                        <span class="albumLink">
                            <img class="albumArtwork"
                                src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/0994d841602157.57ac63336b606.jpg"
                                alt="" srcset="">
                        </span>
                        <div class="trackInfo">
                            <span class="trackName">
                                <span>Haye Dil Bechara</span>
                            </span>

                            <span class="ArtistName">
                                <span>Jimmy khan</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="nowPlayingCenter">
                    <div class="content playerControls">
                        <div class="buttons">
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton shuffle" title="Shuffle Button">
                                <img src="Assets/images/icons/shuffle.png" alt="Shuffle">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton previous" title="Previous Putton">
                                <img src="Assets/images/icons/previous.png" alt="Previous">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton play" title="Play Button">
                                <img src="Assets/images/icons/play.png" alt="Play">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton pause" title="pause  Button" style="display: none;">
                                <img src="Assets/images/icons/pause.png" alt="pause">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton next" title="Next Button">
                                <img src="Assets/images/icons/next.png" alt="Next">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton repeat" title="Repeat Button">
                                <img src="Assets/images/icons/repeat.png" alt="Repeat">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                        </div>
                        <!-- /////////////////////////////////--- Progress Bar ---/////////////////////////////////////////// -->
                        <div class="playBackBar">
                            <span class="progressTime current">0.00</span>
                            <div class="progressBar">
                                <div class="progressBarBG">
                                    <div class="progress"> </div>
                                </div>
                            </div>
                            <span class="progressTime remaining">0.00</span>
                        </div>
                    </div>
                </div>
                <div id="nowplayingright">
                    <div class="volumeBar">
                        <button class="controlButton vloume" title="Volume Button">
                            <img src="Assets/images/icons/volume.png" alt="Vloume">
                        </button>

                        <div class="progressBar">
                            <div class="progressBarBG">
                                <div class="progress"> </div>
                            </div>
                        </div>

                        <!-- <button class="controlButton vloume" title="Volume Button">
                        <img src="Assets/images/icons/volume.png" alt="Vloume">
                    </button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>