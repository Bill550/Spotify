<?php  

    include("includes/IncludedFiles.php"); 

if (isset($_GET['id'])) {
    $albumid = $_GET['id'];
}
else {
    header("Location: index.php");
}

$album = new Album($con, $albumid);
$artist = $album->getArtist();
$artistId = $artist->getId();
?>

<div class="EntityInfo">
    <div class="leftSection">
        <img src=" <?php echo $album->getArtworkPath(); ?> ">
    </div>

    <div class="rightSection">
        <h2> <?php echo $album->getTitle(); ?> </h2>
        <p role="link" tabindex="0" onclick="openPage('artist.php?id=$artistId')">By: 
                <?php echo $artist->getName(); ?></p>
                
        <p> <?php echo $album->getNumberOfSongs(); ?> Songs</p>

    </div>
</div>
<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songIdArray = $album->getSongIDs();
            $i = 1;
            foreach ($songIdArray as $songId) {

                $albumSong = new Song($con, $songId);
                $albumArtist = $albumSong->getArtist();
                echo "  <li class='trackListRow'>

                            <div class='TrackCount'>
                                <img class='Play' src='Assets/Images/Icons/play-2.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true )' >
                                <span class='trackNumber'>$i</span>
                            </div>

                            <div class='Trackinfo'>
                                <span class='trackName'>".$albumSong->getTitle()."</span>
                                <span class='artistName'>".$albumArtist->getName()."</span>
                            </div>
                            
                            <div class = 'trackOption'>
                                <input type='hidden' class='songId' value ='" . $albumSong->getId() . "'>
                                <img src='Assets/Images/Icons/more.png' class='optionButton' 
                                        onclick='showOptionsMenu(this)' >
                            </div>

                            <div class= 'trackDuration'>
                                <span class= 'duration'>". $albumSong->getDuratione() ."</span>
                            </div>

                        </li>";
                $i++;

            }
        ?>

        <script>
            var tempSongIds =  '<?php echo json_encode($songIdArray); ?>' ;
            tempPlaylist = JSON.parse(tempSongIds);
        </script>

    </ul>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <!-- //////--- goto Class (Playlist.php) ---////// -->
    <!-- <select class="item playlist">
            <option value=""> Add To Playlist </option>
    </select> -->
    <?php echo Playlist :: getPlaylistDropdown($con, $userLoggedIn->getUsername());?>
    <!-- <div class="item">Item 2</div>
    <div class="item">Item 3</div> -->
</nav>

