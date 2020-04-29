<?php

    include("includes/IncludedFiles.php");
    if (isset($_GET['id'])) {
        $artistId = $_GET['id'];
    }
    else {
        header("Location: index.php");
    }

    $artist = new Artist($con, $artistId);


?>

<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName"> <?php echo $artist->getName(); ?> </h1>
            <div class="headerButtons">
                <button class="button green" onclick ="playFirstSong();">PLAY</button>
            </div>
        </div>
    </div>
</div>

<div class="trackListContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="trackList">
        <?php
            $songIdArray = $artist->getSongIDs();
            $i = 1;
            foreach ($songIdArray as $songId) {
                if ($i > 5) {
                    break;
                }

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
                                <img src='Assets/Images/Icons/more.png' class='optionButton'>
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
            console.log(tempPlaylist);
        </script>

    </ul>
</div>

<div class="gridViewContainer">
            <h2>ALBUMS</h2>
        <?php
            $albumQuery = mysqli_query($con,"SELECT * FROM album WHERE artist = '$artistId' ");
            while($row = mysqli_fetch_array($albumQuery)){

                echo "  <div class='gridViewItem'>
                            <span role='link' tabindex='0' onclick = 'openPage(\"album.php?id=". $row['id'] ."\")'>
                                <img src='".$row['artworkPath']."'>
                                <div class='gridViewInfo'>"
                                    .$row['title'].
                                "</div>
                            </span>
                        </div>";
            }
        ?>
</div>
