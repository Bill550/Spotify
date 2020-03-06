<?php
class Account {
    private $errorArray;
    public function __construct(){
        $this -> errorArray = array();
    }
    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2){
        $this -> ValidateUsername($un);
        $this -> ValidateFirstname($fn);
        $this -> ValidateLastname($ln);
        $this -> ValidateEmails($em , $em2);
        $this -> ValidatePasswords($pw ,$pw2);

        if(empty($this -> errorArray) == true){
            // insert Into DATABASE
            return true;
        }
        else {
            return false;
        }
    }

    public function getError($error){
        if (!in_array($error, $this -> errorArray)) {
            $error = "";
        }
        return "<span class = 'errorMessage'> $error </span> ";
    } 

    private function ValidateUsername($un){
        if (strlen($un) > 25 || strlen($un) < 5 ) {
            array_push($this -> errorArray, Constants :: $UserNameCharacters);
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
}
?>