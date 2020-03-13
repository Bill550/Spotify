<?php  include("includes/header.php"); 

if (isset($_GET['id'])) {
    $albumid = $_GET['id'];
}
else {
    header("Location: index.php");
}

$album = new Album($con, $albumid);
$artist = $album->getArtist();
?>

<div class="EntityInfo">
    <div class="leftSection">
        <img src=" <?php echo $album->getArtworkPath(); ?> ">
    </div>

    <div class="rightSection">
        <h2> <?php echo $album->getTitle(); ?> </h2>
        <p>By: <?php echo $artist->getName(); ?></p>
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
                                <img class='Play' src='Assets/Images/Icons/play-2.png' >
                                <span class='trackNumber'>$i</span>
                            </div>

                            <div class='Trackinfo'>
                                <span class='trackName'>".$albumSong->getTitle()."</span>
                                <span class='artistName'>".$albumArtist->getName()."</span>
                            </div>
                            
                            <div class = 'trackOption'>
                                <img src='Assets/Images/Icons/more.png' class='optionButton'>
                            </div>

                            <div class= 'trackDuration'>
                                <span class= 'duration'>". $albumSong->getDuratione() ."</span>
                            </div>

                        </li>";
                $i++;

            }
        ?>
    </ul>
</div>





<?php  include("includes/footer.php");  ?>