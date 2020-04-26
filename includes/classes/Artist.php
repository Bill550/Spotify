<?php
class Artist {
    private $id;
    private $con;

    public function __construct($con, $id){
        $this->con = $con;
        $this->id = $id;
    }

    public function getName(){
        $artistQuery = mysqli_query($this->con,"SELECT name FROM artists WHERE id = '$this->id'");
        $artist = mysqli_fetch_array($artistQuery);
        return $artist['name'];
    }

    public function getSongIDs(){
        $Query = mysqli_query($this->con, "SELECT id FROM songs WHERE artist = '$this->id' 
        ORDER BY plays DESC");

        $array = array();
        while($row = mysqli_fetch_array($Query)){
            array_push($array,$row['id']);
        }
        return $array;
    }
}
?>