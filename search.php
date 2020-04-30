<?php

    include("includes/IncludedFiles.php"); 

    if (isset($_GET['term'])) {
        $term = urldecode($_GET['term']);
    }
    else{
        $term = "";
    }
?>

<div class="searchContainer">
    <h4>Search for an Artist, Album or Song</h4>
    <input type="text" class="searchInput" value="<?php echo $term;?>" placeholder="Start Typing....." onfocus="this.value = this.value" >
</div>

<script>
    $(".searchInput").focus();

    $(function(){
        
        $(".searchInput").keyup(function(){
            clearTimeout(timer);
            timer = setTimeout(function(){
                var val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 1000);
        });
    });
</script>

<?php
    if ($term =="") {
        exit();
    }
?>


<div class="trackListContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="trackList">
        <?php
            $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10 ");
            if (mysqli_num_rows($songsQuery) == 0 ) {
                echo "<span class='noResult'> NO Songs Found Matching " . $term . "</span>";
            }

            $songIdArray = array();
            $i = 1;
            while ($row = mysqli_fetch_array($songsQuery)) {
                if ($i > 15) {
                    break;
                }

                array_push($songIdArray, $row['id']);

                $albumSong = new Song($con, $row['id']);
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
            console.log(tempPlaylist);
        </script>

    </ul>
</div>

<div class="artistsContainer borderBottom">
    <h2>ARTIST</h2>
    <?php
        $artistsQuery =mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10 ");
        if (mysqli_num_rows($artistsQuery) == 0 ) {
                echo "<span class='noResult'> NO Artists Found Matching " . $term . "</span>";
        }

        while ($row = mysqli_fetch_array($artistsQuery)) {
            $artistFound = new Artist ($con, $row['id']);
            echo "<div class ='searchResultRow' >
                    <div class ='artistName'>
                        <span role='link' tabindex='0' onclick = 'openPage(\"artist.php?id=" . $artistFound->getId() . "\")'>
                        "
                            . $artistFound->getName() . 
                        "
                        </span>
                    </div>
                </div>";
        }
    ?>
</div>

<div class="gridViewContainer">
            <h2>ALBUMS</h2>
        <?php
            $albumQuery = mysqli_query($con,"SELECT * FROM album WHERE title LIKE '$term%' LIMIT 10");
            if (mysqli_num_rows($albumQuery) == 0 ) {
                echo "<span class='noResult'> NO Album Found Matching " . $term . "</span>";
            }
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

