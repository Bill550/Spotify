<?php
    $songQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY RAND() LIMIT 5");
    $resultArray = array();
    while ($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }
    ///////////////////---Converting Array to javascript using json---///////////////////////////////////////
    $jsonArray = json_encode($resultArray);

?>
<script>
    $(document).ready(function(){
        var newPlaylist = <?php echo $jsonArray; ?> ;
        audioElement = new Audio();
        setTrack(newPlaylist[0], newPlaylist, false);
        updateVolumeProgressBar(audioElement.audio);

        //////////////////////-- FOR STOPING Highllighting WHEN CLICKING -- ///////////////////

        $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
            e.preventDefault();
        });

        ///////////////////////-- FOR PROGRESSBAR MOVING Control --////////////////////////////
        $(".playBackBar .progressBar").mousedown(function() {
            mouseDown = true; 
        });
        $(".playBackBar .progressBar").mousemove(function(e) {
            if (mouseDown == true) {
                ///////////// SET TIME OF SONG USING MOUSE ////////////////////
                timeFromOffset(e, this);
            }
        });
        $(".playBackBar .progressBar").mouseup(function(e) {
            ///////////// SET TIME OF SONG USING MOUSE ////////////////////
            timeFromOffset(e, this);
        });

//////////////////////////-- For VOLUME BAR ---/////////////////////////////////////////////////////
///////////////////////-- FOR PROGRESSBAR MOVING Control --////////////////////////////
        $(".volumeBar .progressBar").mousedown(function() {
            mouseDown = true; 
        });
        $(".volumeBar .progressBar").mousemove(function(e) {
            if (mouseDown == true) {
                ///////////// SET HOW MUCH OF VLUME MOUSE MOVE ////////////////////
                var percentage = e.offsetX / $(this).width();
                if (percentage >= 0 && percentage <= 1) {
                    audioElement.audio.volume = percentage ;
                }

            }
        });
        $(".volumeBar .progressBar").mouseup(function(e) {
            ///////////// SET Voulme USING MOUSE ////////////////////
            var percentage = e.offsetX / $(this).width();
            if (percentage >= 0 && percentage <= 1) {
                audioElement.audio.volume = percentage ;
            }
        });

        ///////////////////////--- FOR PROGRESSBAR TO PLAY WHERE MOUSE DRAG ---////////////////////////////
        $(document).mouseup(function() {
            mouseDown = false;
        });

    });
////////////////////////For SET TIME OF SONG USING MOUSE ////////////////////////////////////////
    function timeFromOffset(mouse, progressBar) {
        ///////////////////-- For Getting HOW MANY BAR is SELECTED TO MOVE /////////////////
        var percentage = mouse.offsetX / $(progressBar).width() * 100;
        //////////////////-- For SECOND --////////////////////////
        var seconds = audioElement.audio.duration * (percentage / 100); 
        audioElement.setTime(seconds);
    }
///////////////////////////////////////////For Skipping to next Song////////////////////////////////
    function nextSong(){
        //////////////////////////////////// For dont move next on single click /////////////////////////////////////////
        if (repeat == true) {
            audioElement.setTime(0);
            playSong();
            return;
        }
        if (currentIndex == currentPlaylist.length - 1) {
            currentIndex = 0;
        }
        else{
            currentIndex++;
        }
        var trackToPlay = Shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    ///////////////////////////////////////////For Skipping to next Song////////////////////////////////
    function previousSong(){
        //////////////////////////////////// For dont move next on single click /////////////////////////////////////////
        if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
            audioElement.setTime(0);
        }
        else{
            currentIndex = currentIndex--;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////// For Repeat /////////////////////////////////////////
    function setRepeat() {
        repeat = !repeat;                       //same as if(repeat == true){repeat = false}else{repeat = true} 
        var imageName = repeat ? "repeat-active.png" : "repeat.png" ;
        $(".controlButton.repeat img").attr("src", "Assets/images/icons/" + imageName);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// For Mute //////////////////////////////////////////////////
    function setMute() {
        audioElement.audio.muted = !audioElement.audio.muted;                       //same as if(repeat == true){repeat = false}else{repeat = true} 
        var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png" ;
        $(".controlButton.volume img").attr("src", "Assets/images/icons/" + imageName);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////// For Shuffle /////////////////////////////////////////
    function setShuffle() {
        Shuffle = !Shuffle;                       //same as if(repeat == true){repeat = false}else{repeat = true} 
        var imageName = Shuffle ? "Shuffle-active.png" : "Shuffle.png" ;
        $(".controlButton.shuffle img").attr("src", "Assets/images/icons/" + imageName);
        if (Shuffle == true) {
            //Randomize playlist 
            shuffleArray(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
        else{
            //shuffle has been deactivatd go back to regular playlist
            currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
    }
    function shuffleArray(a) {
        var j, x, i;
        for (i = a.length - 1; i > 0; i--) {
            j = Math.floor(Math.random() * (i + 1));
            x = a[i];
            a[i] = a[j];
            a[j] = x;
        }
        return a;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////
    function setTrack(trackId, newPlaylist, play){
        /////////////////////////Copying Current Playlist Into Shuffle Playlist ///////////////
        if (newPlaylist != currentPlaylist) {
            currentPlaylist = newPlaylist;
            shufflePlaylist = currentPlaylist.slice();
            shuffleArray(shufflePlaylist);
        }
        ///////////////////////////////////////////////////////////////////////////////////////
        if (Shuffle == true) {
            cureentIndex = shufflePlaylist.indexOf(trackId);
        }
        else{
            /////////////////////For Skipping Song////////////////////////////////
            cureentIndex = currentPlaylist.indexOf(trackId); 
            ////////////////////////////////////////////////////////////////////////
        }
        pauseSong();
            ////////////////////AJAX//////////////////////////////////////
        $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {

            var track = JSON.parse(data);
            //////////Jquery//////////
            $(".trackName span").text(track.title);
            /////////////////////////
            ///////////////////GETTING ARTIST USING JSON /////////////////////////////
            $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
                var artist = JSON.parse(data);
                $(".trackInfo .ArtistName span").text(artist.name);
                $(".trackInfo .ArtistName span").attr("onclick", "openPage('artist.php?id=" + artist.id +" ')" );
            });
            //////////////////////////////////////////////////////////////////////////
            ///////////////////GETTING ALBUM USING JSON //////////////////////////////
                $.post("includes/handlers/ajax/getAlbumJson.php", { albumid: track.album }, function(data) {
                var album = JSON.parse(data);
                $(".content .albumLink img").attr("src", album.artworkPath);
                $(".content .albumLink img").attr("onclick", "openPage('album.php?id=" + album.id +" ')" );
                $(".trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + album.id +" ')" );
            });
            /////////////////////////////////////////////////////////////////////////
            audioElement.setTrack(track);
            if (play) {
            playSong();
            }
        });
        /////////////////////////////////////////////////////////////
        
    }
    function playSong(){
        //////////////JSON FOR COUNT Play ///////////
        if (audioElement.audio.currentTime == 0) {
            $.post("includes/handlers/ajax/updatePlays.php", {songId: audioElement.currentlyPlaying.id});
        }

        /////////////////////////////////////////////
        //////////////Javascript/////////////////////
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
        /////////////////////////////////////////////
    }
    function pauseSong(){
        $(".controlButton.pause").hide();
        $(".controlButton.play").show();
        audioElement.pause();
    }
</script>

        <div id="nowPlayingBarContainer">
            <div id="nowPlayingBar">
                <div id="nowPlayingLeft">
                    <div class="content">
                        <span class="albumLink">
                            <img role = "link" tabindex="0" class="albumArtwork" >
                        </span>
                        <div class="trackInfo">
                            <span class="trackName">
                                <span role = "link" tabindex="0"></span>
                            </span>

                            <span class="ArtistName">
                                <span role = "link" tabindex="0"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="nowPlayingCenter">
                    <div class="content playerControls">
                        <div class="buttons">
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton shuffle" title="Shuffle Button" onclick="setShuffle()">
                                <img src="Assets/images/icons/shuffle.png" alt="Shuffle">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton previous" title="Previous Putton" onclick="previousSong()">
                                <img src="Assets/images/icons/previous.png" alt="Previous">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton play" title="Play Button" onclick="playSong()">
                                <img src="Assets/images/icons/play.png" alt="Play">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton pause" title="pause  Button" onclick="pauseSong()" style="display: none;">
                                <img src="Assets/images/icons/pause.png" alt="pause">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton next" title="Next Button"onclick="nextSong()">
                                <img src="Assets/images/icons/next.png" alt="Next">
                            </button>
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                            <button class="controlButton repeat" title="Repeat Button"onclick="setRepeat()">
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
                        <button class="controlButton volume" title="Volume Button" onclick="setMute()">
                            <img src="Assets/images/icons/volume.png" alt="Volume">
                        </button>

                        <div class="progressBar">
                            <div class="progressBarBG">
                                <div class="progress"> </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
