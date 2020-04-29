<?php

class Playlist {
    private $con;
    private $id;
    private $name;
    private $owner;
    
    
    public function __construct($con, $data){

        if (!is_array($data)) {
            /// Data is an id (Sting)
            $query = mysqli_query($con, "SELECT * From playlists WHERE id ='$data'");
            $data = mysqli_fetch_array($query);
        }
        $this->con = $con;
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->owner = $data['owner'];
    }

    /////////////////////--- For Returning ID ---/////////////////////
    public function getid(){
        return $this->id;
    }
    public function getName(){
        /////////////////////--- For Returning Name ---/////////////////////
        return $this->name;
    }
    /////////////////////--- For Returning Owner name ---/////////////////////
    public function getOwner(){
        return $this->owner;
    }
    /////////////////////--- For Returning No of song ---/////////////////////
    public function getNumberOfSongs(){
        $query = mysqli_query($this->con, "SELECT songId FROM playlistsongs WHERE playlistId='$this->id' ");
        return mysqli_num_rows($query);
    }
/////////////////////--- For Returning song id---/////////////////////
        public function getSongIDs() {
        $Query = mysqli_query($this->con, "SELECT songId FROM playlistsongs WHERE  playlistId='$this->id'
        ORDER BY playlistOrder ASC");

        $array = array();
        while($row = mysqli_fetch_array($Query)){
            array_push($array,$row['songId']);
        }
        return $array;
    }


}

?>