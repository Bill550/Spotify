<?php
class Album {
    private $id;
    private $con;
    private $title;
    private $artistID;
    private $genre;
    private $artworkPath;

    public function __construct($con, $id){
        $this->con = $con;
        $this->id = $id;

        $Query = mysqli_query($this->con,"SELECT * FROM album WHERE id = '$this->id'");
        $album = mysqli_fetch_array($Query);

        $this->title        =          $album['title'];
        $this->artistID     =          $album['artist'];
        $this->genre        =          $album['genre'];
        $this->artworkPath  =          $album['artworkPath'];
    }

    public function getTitle(){
        return $this->title ;
    }
    public function getArtworkPath(){
        return $this->artworkPath ;
    }
    public function getArtist(){
        return new Artist($this->con, $this->artistID) ;
    }
    public function getGenre(){
        return $this->genre ;
    }
    public function getNumberOfSongs(){
        $NoOfSongQuery = mysqli_query($this->con, "SELECT COUNT(*) FROM songs WHERE album = '$this->id'");
        return mysqli_num_rows($NoOfSongQuery);
    }
    public function getSongIDs() {
        $Query = mysqli_query($this->con, "SELECT id FROM songs WHERE album = '$this->id' 
        ORDER BY albumOrder ASC");

        $array = array();
        while($row = mysqli_fetch_array($Query)){
            array_push($array,$row['id']);
        }
        return $array;
    }

}
?>