<?php
class Account {
    private $errorArray;
    private $con;

    public function __construct($con){
        $this -> con = $con;
        $this -> errorArray = array();
    }
////////////////////////////////////---FOR LOGIN---////////////////////////////////////////////////////////////////
    public function login($un, $pw){
        $pw = md5($pw);
        $query = mysqli_query($this -> con, "SELECT * FROM users WHERE Username = '$un' AND Password = '$pw' " );
        if (mysqli_num_rows($query) == 1) {
            return true;
        }
        else{
            array_push($this -> errorArray, Constants :: $loginFailed);
            return false;
        }
    }
////////////////////////////////////---CALLING VALIDATION---////////////////////////////////////////////////////////////////
    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2){
        $this -> ValidateUsername($un);
        $this -> ValidateFirstname($fn);
        $this -> ValidateLastname($ln);
        $this -> ValidateEmails($em , $em2);
        $this -> ValidatePasswords($pw ,$pw2);

        if(empty($this -> errorArray) == true){
            // insert Into DATABASE
            return $this -> insertUserDetails($un, $fn, $ln, $em, $pw);
        }
        else {
            return false;
        }
    }
///////////////////////////////////////---FOR ERROR MESSAGE---/////////////////////////////////////////////////////////////
    public function getError($error){
        if (!in_array($error, $this -> errorArray)) {
            $error = "";
        }
        return "<span class = 'errorMessage'> $error </span> ";
    } 
//////////////////////////////////////---INSERTING VALUES---//////////////////////////////////////////////////////////////
    private function insertUserDetails($un, $fn, $ln, $em, $pw){
        $encryptedPw = md5($pw);
        $profilePic = "Assets/images/Profile-Pics/profile-user.png";
        $date = date("Y-m-d");
        
        $result = mysqli_query($this -> con, "INSERT INTO users 
        VALUES('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

        return $result;
    }
////////////////////////////////////////---VALIDATIONS---////////////////////////////////////////////////////////////
    private function ValidateUsername($un){
        if (strlen($un) > 25 || strlen($un) < 5 ) {
            array_push($this -> errorArray, Constants :: $UserNameCharacters);
            return;
        }
        $checkUsernameQuery = mysqli_query($this -> con ,"SELECT Username FROM users WHERE Username = '$un' ");
        if (mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this -> errorArray, Constants :: $UserNameTaken );
            return;
        }
    }
    private function ValidateFirstname($fn){
        if (strlen($fn) > 25 || strlen($fn) < 2 ) {
            array_push($this -> errorArray, Constants :: $FirstNameCharacters);
            return;
        }
    }
    private function ValidateLastname($ln){
        if (strlen($ln) > 25 || strlen($ln) < 2 ) {
            array_push($this -> errorArray, Constants :: $LastNameCharacters);
            return;
        }
    }
    private function ValidateEmails($em , $em2){
        if ($em != $em2) {
            array_push($this -> errorArray, Constants :: $EmailsDoNotMatch);
            return;
        }
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this -> errorArray, Constants :: $EmailInvalid);
            return;
        }
        $checkEmailQuery = mysqli_query($this -> con ,"SELECT Email FROM users WHERE Email = '$em' ");
        if (mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this -> errorArray, Constants :: $EmailTaken );
            return;
        }
    }
    private function ValidatePasswords($pw , $pw2){
        if ($pw != $pw2) {
            array_push($this -> errorArray, Constants :: $passwordsDoNotMatch);
            return;
        }
        if (preg_match('/[^A-Za-z0-9]/',$pw)) {
            array_push($this -> errorArray, Constants :: $passwordNotAlphanumeric);
            return;        
        }
        if (strlen($pw) > 30 || strlen($pw) < 5 ) {
            array_push($this -> errorArray, Constants :: $passwordCharacters);
            return;
        }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>