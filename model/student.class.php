<?php
class Student{
  protected $JMBAG, $ime, $prezime, $username, $password;

  function __construct($JMBAG, $ime, $prezime, $username, $password)
  {
    $this->JMBAG = $JMBAG;
    $this->ime = $ime;
    $this->prezime = $prezime;
    $this->username = $username;
    $this->password = $password;
  }

  function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

}

 ?>
