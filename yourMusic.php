<?php

    include("includes/IncludedFiles.php"); 

?>

<div class="playlistsContainer">
    <div class="gridviewContainer">
        <h2>PLAYLIST</h2>

        <div class="buttonItems">
            <button class="button green" onclick="createPlaylist()" > NEW PLAYLIST </button>
        </div>

        <?php
        $username =$userLoggedIn->getUsername();
            $playlistsQuery = mysqli_query($con,"SELECT * FROM playlists WHERE owner = '$username' ");
            if (mysqli_num_rows($playlistsQuery) == 0 ) {
                echo "<span class='noResult'> You Don't Have any Playlists Yet. </span>";
            }
            while($row = mysqli_fetch_array($playlistsQuery)){
                $playlist = new Playlist($con, $row);

                echo "  <div class='gridViewItem' role='link' tabindex='0' 
                        onclick='openPage(\"playlist.php?id=" . $playlist->getid() . "\")'>
                        
                            <div class='playlistImage'>
                                <img src='Assets/Images/Icons/playlist.png'>
                            </div>
                                <div class='gridViewInfo'>"
                                    . $playlist->getName() .
                                "</div>
                        </div>";
            }
        ?>


    </div>
</div>


