<?php

class Predmet{
  protected $isvu, $naziv;

  function __construct($isvu, $naziv)
  {
    $this->isvu=$isvu;
    $this->naziv = $naziv;
  }

  function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
  
}

 ?>
