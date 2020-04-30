var currentPlaylist = [] ;
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false; 
var Shuffle = false;
var userLoggedIn;
var timer;

////////////////--- EVET WHEN WE SCROLL TO HIDE OPTION OF (...) ALBUM PAGE ---/////////////////////////////////
$(window).scroll(function () {
    hideOptionsMenu();
});
/////////////////////////////////////////////////////////////////

////////////////--- EVET WHEN WE CLICK AWAY TO HIDE OPTION OF (...) ALBUM PAGE ---/////////////////////////////////
$(document).click(function (click) {
    var target = $(click.target);
    if (!target.hasClass("item") && !target.hasClass("optionButton")) {
        hideOptionsMenu();
    }
});
/////////////////////////////////////////////////////////////////

////////////////--- EVET to get ID's of Song And Playlist ON (album.php) this Button (...) ---/////////////////////////////////
$(document).on("change" ,"select.playlist",function () {
    var select = $(this);
    var playlistId = select.val();
    var songId = select.prev(".songId").val();
    // console.log("playlistId: "+ playlistId);
    // console.log("songId: " + songId);

    $.post("includes/handlers/ajax/addToplaylist.php",  {playlistId: playlistId , songId: songId})
    .done(function (error) {
        
        if (error != "") {
            alert(error);
            return;
        }

        hideOptionsMenu();
        select.val("");
        
    });
});
/////////////////////////////////////////////////////////////////

/////////////////--- FOR SONG FROM DAELETE PLAYLIST ---//////////////////////
////////////////////// --- .Done handel More Prefer or precisely AJAX/////////

function removeFromPlaylist(button ,playlistId) {
    var songId = $(button).prevAll(".songId").val();

    $.post("includes/handlers/ajax/removeFromPlaylist.php", {
        playlistId: playlistId , songId: songId
    })
        .done(function (error) {
            if (error != "") {
                alert(error);
                return;
            }
            /// do something when AJAX retuns
            openPage("playlist.php?id=" + playlistId);
        });

}

/////////////////////////////////////////////////////////////////


/////////////////--- FOR CREATE PLAYLIST ---//////////////////////
////////////////////// --- .Done handel More Prefer or precisely AJAX/////////

function createPlaylist() {
    
    var popup = prompt("Please Enter the Name of your Playlist");
    if (popup != null) {
        $.post("includes/handlers/ajax/createPlaylist.php", { name: popup, username: userLoggedIn})
        .done(function (error) {
            if (error != "") {
                alert(error);
                return;
            }
            /// do something when AJAX retuns
            openPage("yourMusic.php");
        });
    }
}

/////////////////////////////////////////////////////////////////

/////////////////--- FOR DAELETE PLAYLIST ---//////////////////////
////////////////////// --- .Done handel More Prefer or precisely AJAX/////////

function deletePlaylist(playlistId) {

    var prompt = confirm("Are you sure ? You want to Delete this Playlist ");
    if (prompt == true) {

        $.post("includes/handlers/ajax/deletePlaylist.php", {
                playlistId: playlistId
            })
            .done(function (error) {
                if (error != "") {
                    alert(error);
                    return;
                }
                /// do something when AJAX retuns
                openPage("yourMusic.php");
            });
    }
}

/////////////////////////////////////////////////////////////////



//////////////////--- FOR PAGE TRANSITIONS ---////////////////////
function openPage(url){
    if (timer != null) {
        clearTimeout(timer);
    }
    if (url.indexOf("?") == -1) {
        url = url + "?";
    }
    var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null, null, url);
}
/////////////////////////////////////////////////////////////////
/////////////////--- FOR DURATION TIME ---//////////////////////

function formatTime(seconds){
    var time = Math.round(seconds);
    var minutes = Math.floor(time / 60);
    var seconds  = time - minutes * 60 ;
    var extraZero = (seconds < 10) ? "0" : "" ;
    return minutes + ":" + extraZero + seconds;
}

///////////////////////////////////////////////////////////////
/////////////////--- FOR SONG ProgressBar Update ---//////////////////////

function updateTimeProgressBar(audio) {
    $(".progressTime.current ").text(formatTime(audio.currentTime));
    $(".progressTime.remaining ").text(formatTime(audio.duration - audio.currentTime));
/////////// -- Percentage of Song -- //////////////
    var progress = audio.currentTime / audio.duration * 100;
    $(".playBackBar .progress").css("width", progress + "%");
}
////////////////////////////-- VLOUME PROGRESSBAR---/////////////////////////////////
function updateVolumeProgressBar(audio) {
    /////////// -- Percentage of Vloume -- //////////////
    var Volumeprogress = audio.volume * 100;
    $(".volumeBar .progress").css("width", Volumeprogress + "%");
}

function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement('audio');
    /////////////////--- FOR Repeating SONG when its end ---//////////////////////
    this.audio.addEventListener("ended", function () {
        nextSong();
    });
/////////////////--- FOR SONG TIME REMAINING Update ---//////////////////////
    this.audio.addEventListener("canplay", function () {
        ///---"this" refers to the object that the event was called on---///
        var duration = formatTime(this.duration);
        $(".progressTime.remaining").text(duration);
    });

/////////////////--- FOR SONG ProgressBar Update ---//////////////////////

    this.audio.addEventListener("timeupdate", function() {
        if (this.duration) {
            updateTimeProgressBar(this);
        }
    });
/////////////////////////////////////////////////////////////////////////////
/////////////////--- FOR Vloume ProgressBar Update ---//////////////////////
    this.audio.addEventListener("volumechange", function () {
        updateVolumeProgressBar(this);
    });

    this.setTrack = function(track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    }

    this.play = function() {
        this.audio.play();
    }

    this.pause = function() {
        this.audio.pause();
    }

    this.setTime = function(seconds) {
        this.audio.currentTime = seconds;
    }

}
/////////////////////////////////////////////////////////////////////////////
/////////////////--- FOR ARTIST PAGE (PLAY)BUTTON ---//////////////////////
function playFirstSong(params) {
    setTrack(tempPlaylist[0], tempPlaylist, true)
}

/////////////////////////////////////////////////////////////////////////////
/////////////////--- FOR MENU HIDE RIGHT NEXT TO (...) IN ALBUM ---//////////////////////
function hideOptionsMenu() {  /////////// HTML Object (button)
    var menu = $(".optionsMenu");
    if (menu.css("display") != "none") {
        menu.css("display", "none");
    }
}

/////////////////////////////////////////////////////////////////////////////
/////////////////--- FOR MENU DISPLAY RIGHT NEXT TO (...) IN ALBUM ---//////////////////////
function showOptionsMenu(button) {  /////////// HTML Object (button)
    var songId = $(button).prevAll(".songId").val();
    var menu = $(".optionsMenu");
    var menuWidth = menu.width();
    menu.find(".songId").val(songId);
    var scrollTop = $(window).scrollTop(); ///scrollTop(): distance form top of windows to top of document
    var elementOffset = $(button).offset().top;        //// JQuery Object (button) or distance from top of document
    var top = elementOffset - scrollTop;
    var left = $(button).position().left;
    menu.css({ "top": top + "px", "left": left - menuWidth + "px", "display": "inline" });
}
