<?php
    include("../../config.php");

    if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
        $songId = $_POST['songId'];
        $playlistId = $_POST['playlistId'];

        $Query = mysqli_query($con, "DELETE FROM playlistsongs WHERE playlistId = '$playlistId' AND songId ='$songId' ");
    }
    else {
        echo "PlaylistId or songId was not passeed into removeFromPlaylist.php" ;
    }

?>