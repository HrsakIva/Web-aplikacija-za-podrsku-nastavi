<?php
class StudentService{

  function studentExist($username){

		try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT JMBAG FROM studenti WHERE username=:username' );
			$st->execute(array( 'username' => $username));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			return 1;
		}
		else
			return 0;
	}

  function getStudentPassword($username){
    try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT password FROM studenti WHERE username=:username' );
			$st->execute(array( 'username' => $username));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			$row = $st->fetch();
			return $row['password'];
		}
		else
			return 0;
  }

  function getStudentJMBAG($username){
		try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT JMBAG FROM studenti WHERE username=:username' );
			$st->execute(array( 'username' => $username));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			$row = $st->fetch();
			return $row['JMBAG'];
		}
		else
			return 0;
	}

  function getStudentIme($JMBAG){
		try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT ime FROM studenti WHERE JMBAG=:JMBAG' );
			$st->execute(array( 'JMBAG' => $JMBAG));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			$row = $st->fetch();
			return $row['ime'];
		}
		else
			return 0;
	}

  function getStudentPrezime($JMBAG){
		try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT prezime FROM studenti WHERE JMBAG=:JMBAG' );
			$st->execute(array( 'JMBAG' => $JMBAG));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			$row = $st->fetch();
			return $row['prezime'];
		}
		else
			return 0;
	}

  function getPredmetByStudent($JMBAG){
    try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT DISTINCT predmet.isvu, predmet.naziv FROM predmet, studenti, upisao WHERE upisao.JMBAG=:JMBAG AND upisao.isvu=predmet.isvu' );
			$st->execute(array( 'JMBAG' => $JMBAG));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();

    while( $row = $st->fetch() ){
			$arr[] = new Predmet( $row['isvu'], $row['naziv'] );
		}

		return $arr;
  }

  function getNazivPredmeta($isvu)
  {
    try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT naziv FROM predmet WHERE isvu=:isvu' );
			$st->execute(array( 'isvu' => $isvu));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			$row = $st->fetch();
			return $row['naziv'];
		}
		else
			return 0;
  }

  function getOcjenaIzPredmeta($JMBAG, $isvu)
  {
    try{
      $db = DB::getConnection();
      $st = $db->prepare('SELECT OCJENA FROM upisao WHERE JMBAG=:JMBAG AND isvu=:isvu');
      $st->execute(array('JMBAG' => $JMBAG, 'isvu' => $isvu));
    }
    catch(PDOException $e) {exit('PDO error ' . $e->getMessage());}

    if( $st->rowCount() == 1 ){
      $row = $st->fetch();
      return $row['OCJENA'];
    }
    else {
      return 0;
    }
  }

  function getObavijestByPredmet($isvu)
  {
    try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, isvu, vrijeme, sadrzaj FROM obavijesti WHERE isvu=:isvu' );
			$st->execute(array( 'isvu' => $isvu));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();

    while( $row = $st->fetch() ){
			$arr[] = new Obavijest( $row['id'], $row['isvu'], $row['vrijeme'], $row['sadrzaj']);
		}

		return $arr;
  }

  function getRezultatiIzPredmeta($JMBAG, $isvu)
  {
    try{
      $db = DB::getConnection();
			$st = $db->prepare( 'SELECT DISTINCT studenti_rezultati.id_elementa, studenti_rezultati.postotak, elementi_ocjenjivanja.naziv_elementa
                            FROM studenti_rezultati, elementi_ocjenjivanja WHERE studenti_rezultati.isvu=:isvu AND studenti_rezultati.JMBAG=:JMBAG
                            AND studenti_rezultati.id_elementa = elementi_ocjenjivanja.id_elementa' );
      $st->execute(array( 'isvu' => $isvu, 'JMBAG' => $JMBAG));
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();

    while( $row = $st->fetch() ){
      $arr[] = new Rezultat( $isvu, $JMBAG, $row['id_elementa'],
              $row['naziv_elementa'], $row['postotak']);
    }

    return $arr;
  }

}
 ?>
