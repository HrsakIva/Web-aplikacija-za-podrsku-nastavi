<?php
class Rezultat{

  protected $isvu, $JMBAG, $id_elementa, $naziv_elementa, $postotak;

  function __construct($isvu, $JMBAG, $id_elementa, $naziv_elementa, $postotak)
  {
    $this->isvu = $isvu;
    $this->JMBAG = $JMBAG;
    $this->id_elementa = $id_elementa;
    $this->naziv_elementa = $naziv_elementa;
    $this->postotak = $postotak;
  }

  function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

}
?>
