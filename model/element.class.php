<?php
class Element{

  protected $id_elementa, $isvu, $naziv_elementa;

  function __construct($id_elementa, $isvu, $naziv_elementa)
  {
    $this->id_elementa = $id_elementa;
    $this->isvu = $isvu;
    $this->naziv_elementa = $naziv_elementa;
  }

  function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

}
?>
