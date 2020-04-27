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