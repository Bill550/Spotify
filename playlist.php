<?php  

    include("includes/IncludedFiles.php"); 

if (isset($_GET['id'])) {
    $playlistId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());
?>

<div class="EntityInfo">
    <div class="leftSection">
        <div class="playlistImage">
            <img src=" Assets/Images/Icons/playlist.png ">
        </div>
    </div>

    <div class="rightSection">
        <h2> <?php echo $playlist->getName(); ?> </h2>
        <p>By: <?php echo $playlist->getOwner(); ?></p>
        <p> <?php echo $playlist->getNumberOfSongs(); ?> Songs</p>
        <button class="button" onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELETE PLAYLIST</button>
    </div>
</div>
<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songIdArray = $playlist->getSongIDs();
            $i = 1;
            foreach ($songIdArray as $songId) {

                $playlistSong = new Song($con, $songId);
                $aongArtist = $playlistSong->getArtist();
                echo "  <li class='trackListRow'>

                            <div class='TrackCount'>
                                <img class='Play' src='Assets/Images/Icons/play-2.png' onclick='setTrack(\"" 
                                . $playlistSong->getId() . "\", tempPlaylist, true )' >
                                <span class='trackNumber'>$i</span>
                            </div>

                            <div class='Trackinfo'>
                                <span class='trackName'>".$playlistSong->getTitle()."</span>
                                <span class='artistName'>".$aongArtist->getName()."</span>
                            </div>
                            
                            <div class = 'trackOption'>
                                <img src='Assets/Images/Icons/more.png' class='optionButton'>
                            </div>

                            <div class= 'trackDuration'>
                                <span class= 'duration'>". $playlistSong->getDuratione() ."</span>
                            </div>

                        </li>";
                $i++;

            }
        ?>

        <script>
            var tempSongIds =  '<?php echo json_encode($songIdArray); ?>' ;
            tempPlaylist = JSON.parse(tempSongIds);
            console.log(tempPlaylist);
        </script>

    </ul>
</div>

