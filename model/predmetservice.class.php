<?php
class PredmetService{

  function profesorExist($username){
		try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id FROM profesori WHERE username=:username' );
			$st->execute(array( 'username' => $username));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			return 1;
		}
		else
			return 0;
	}

  function getProfesorPassword($username){
    try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT password FROM profesori WHERE username=:username' );
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

  function getProfesorId($username){
		try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id FROM profesori WHERE username=:username' );
			$st->execute(array( 'username' => $username));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			$row = $st->fetch();
			return $row['id'];
		}
		else
			return 0;
	}

  function getProfesorIme($id){
		try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT ime FROM profesori WHERE id=:id' );
			$st->execute(array( 'id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			$row = $st->fetch();
			return $row['ime'];
		}
		else
			return 0;
	}

  function getProfesorPrezime($id){
		try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT prezime FROM profesori WHERE id=:id' );
			$st->execute(array( 'id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() === 1 ){
			$row = $st->fetch();
			return $row['prezime'];
		}
		else
			return 0;
	}

  function getPredmetByProfesor($id){
    try{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT DISTINCT predmet.isvu, predmet.naziv FROM predmet, profesori, predaje WHERE predaje.id=:id AND predaje.isvu=predmet.isvu' );
			$st->execute(array( 'id' => $id));
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

  function napraviNovuObavijest($isvu, $vrijeme, $sadrzaj)
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare( 'INSERT INTO obavijesti(isvu, vrijeme, sadrzaj) VALUES (:isvu, :vrijeme, :sadrzaj)' );
      $st->execute( array( 'isvu' => $isvu, 'vrijeme' => $vrijeme, 'sadrzaj' => $sadrzaj ));
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
  }

  function getStudentiByPredmet($isvu)
{
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare('SELECT DISTINCT studenti.JMBAG, studenti.ime, studenti.prezime, studenti.username, studenti.password
                      FROM studenti, upisao, predmet WHERE studenti.JMBAG=upisao.JMBAG AND upisao.isvu=:isvu');
    $st->execute( array( 'isvu' => $isvu) );
  }
  catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}

  $arr = array();

  while( $row = $st->fetch() ){
    $arr[] = new Student( $row['JMBAG'], $row['ime'], $row['prezime'], $row['username'], $row['password']);
  }

  return $arr;
}

function obrisiObavijest($id, $isvu)
{
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare('DELETE FROM obavijesti WHERE id=:id');
    $st->execute( array( 'id' => $id) );
  }
  catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}

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

function napraviNoviElement($isvu_predmeta, $naziv_elementa)
{
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare('INSERT INTO elementi_ocjenjivanja(isvu, naziv_elementa) VALUES(:isvu, :naziv_elementa)');
    $st->execute( array( 'isvu' => $isvu_predmeta, 'naziv_elementa' => $naziv_elementa) );
  }
  catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}
}

function getElementiOcjenjivanja($isvu_predmeta)
{
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare('SELECT id_elementa, isvu, naziv_elementa FROM elementi_ocjenjivanja WHERE isvu=:isvu');
    $st->execute( array( 'isvu' => $isvu_predmeta) );
  }
  catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}

$arr = array();

while( $row = $st->fetch() ){
  $arr[] = new Element($row['id_elementa'], $row['isvu'], $row['naziv_elementa']);
}

return $arr;
}

function obrisiElementByPredmet($isvu_predmeta, $idElementa)
{
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare('DELETE FROM elementi_ocjenjivanja WHERE id_elementa=:idElementa');
    $st->execute( array( 'idElementa' => $idElementa ) );
  }
  catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}

  try
  {
    $db = DB::getConnection();
    $st = $db->prepare('SELECT id_elementa, isvu, naziv_elementa FROM elementi_ocjenjivanja WHERE isvu=:isvu');
    $st->execute( array( 'isvu' => $isvu_predmeta) );
  }
  catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}

$arr = array();

while( $row = $st->fetch() ){
  $arr[] = new Element($row['id_elementa'], $row['isvu'], $row['naziv_elementa']);
}

return $arr;
}

function unesiRezultat($isvu, $JMBAG, $id_elementa, $postotak)
{
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare('SELECT isvu, JMBAG, id_elementa, postotak FROM studenti_rezultati
                        WHERE isvu=:isvu AND JMBAG=:JMBAG AND id_elementa=:id_elementa');
    $st->execute( array( 'isvu' => $isvu, 'JMBAG' => $JMBAG, 'id_elementa' => $id_elementa) );
  }
  catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}

  if($st->rowCount() === 0)
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('INSERT INTO studenti_rezultati(isvu, JMBAG, id_elementa, postotak)
                          VALUES(:isvu, :JMBAG, :id_elementa, :postotak)' );
      $st->execute( array( 'isvu' => $isvu, 'JMBAG' => $JMBAG, 'id_elementa' => $id_elementa, 'postotak' => $postotak) );
    }
    catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}
  }

  else {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('UPDATE studenti_rezultati SET postotak=:postotak
                          WHERE isvu=:isvu AND JMBAG=:JMBAG AND id_elementa=:id_elementa');
      $st->execute( array( 'isvu' => $isvu, 'JMBAG' => $JMBAG, 'id_elementa' => $id_elementa, 'postotak' => $postotak) );
    }
    catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}
  }
}

function unesiZavrsnuOcjenu($JMBAG, $isvu, $ocjena)
{
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare('UPDATE upisao SET OCJENA=:OCJENA WHERE JMBAG=:JMBAG AND isvu=:isvu' );
    $st->execute( array( 'OCJENA' => $ocjena, 'JMBAG' => $JMBAG, 'isvu' => $isvu) );
  }
  catch(PDOException $e) {exit('PDO error ' . $e->getMessage() );}
}

}
 ?>
