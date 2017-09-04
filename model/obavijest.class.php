<?php
class Obavijest{

  protected $id, $isvu, $vrijeme, $sadrzaj;

  function __construct($id, $isvu, $vrijeme, $sadrzaj)
  {
    $this->id = $id;
    $this->isvu = $isvu;
    $this->vrijeme = $vrijeme;
    $this->sadrzaj = $sadrzaj;
  }
  
  function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

}


 ?>
