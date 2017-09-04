<?php
class Profesor{
  protected $id, $ime, $prezime, $username, $password;

  function __construct($id, $ime, $prezime, $username, $password)
  {
    $this->id = $id;
    $this->ime = $ime;
    $this->prezime = $prezime;
    $this->username = $username;
    $this->password = $password;
  }

  function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

}

 ?>
