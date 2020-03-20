<?php
class Song {
    private $id;
    private $con;
    private $mysqliData;
    private $title;
    private $artistID;
    private $albumID;
    private $genre;
    private $duration;
    private $Path;


    public function __construct($con, $id){
        $this->con = $con;
        $this->id = $id;

        $Query = mysqli_query($this->con,"SELECT * FROM songs WHERE id = '$this->id'");
        $this->mysqliData = mysqli_fetch_array($Query);

        $this->title        =          $this->mysqliData['title'];
        $this->artistID     =          $this->mysqliData['artist'];        
        $this->albumID      =          $this->mysqliData['album'];
        $this->genre        =          $this->mysqliData['genre'];
        $this->duration     =          $this->mysqliData['duration'];
        $this->Path         =          $this->mysqliData['path'];
    }
    public function getId(){
        return $this->id ;
    }
    public function getTitle(){
        return $this->title ;
    }
    public function getArtist(){
        return new Artist($this->con, $this->artistID) ;
    }
    public function getAlbum(){
        return new Album($this->con, $this->albumID) ;
    }
    public function getPath(){
        return $this->Path ;
    }
    public function getDuratione(){
        return $this->duration ;
    }
    public function getGenre(){
        return $this->genre ;
    }
    public function getMysqliData(){
        return $this->mysqliData ;
    }
}
?>