<?php

require_once '../../model/db.class.php';

$db = DB::getConnection();

/*try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS profesori (' .
		'id int(5) NOT NULL PRIMARY KEY,' .
		'ime varchar(50) NOT NULL,' .
		'prezime varchar(50) NOT NULL,' .
    'username varchar(50) NOT NULL,' .
		'password varchar(255) NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #1: " . $e->getMessage() ); }

echo "Napravio tablicu profesori.<br />";

// veza izmedju profesora i predmeta
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS predaje (' .
		'id int(5) NOT NULL,' .
		'isvu int(5) NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #2: " . $e->getMessage() ); }

echo "Napravio tablicu predaje.<br />";

//ubacimo profesore u tablicu profesori
try
{
	$st = $db->prepare( 'INSERT INTO profesori(id, ime, prezime, username, password) VALUES (:id, :ime, :prezime, :username, :password)' );

	$st->execute( array('id'=>'11223', 'ime' => 'Andrej', 'prezime' => 'Dujella', 'username'=>'adujella', 'password' => password_hash( 'adujellasifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'34512', 'ime' => 'Luka', 'prezime' => 'Grubišić', 'username'=>'lgrubi', 'password' => password_hash( 'lgrubisifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'51234', 'ime' => 'Leonardo', 'prezime' => 'Jelenković', 'username'=>'ljelenk', 'password' => password_hash( 'ljelenksifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'21354', 'ime' => 'Mladen', 'prezime' => 'Jurak', 'username'=>'mjurak', 'password' => password_hash( 'mjuraksifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'12233', 'ime' => 'Maja', 'prezime' => 'Starčević', 'username'=>'mstarcev', 'password' => password_hash( 'mstarcevsifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'45123', 'ime' => 'Mladen', 'prezime' => 'Vuković', 'username'=>'mvukov', 'password' => password_hash( 'mvukovsifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'21345', 'ime' => 'Robert', 'prezime' => 'Manger', 'username'=>'rmanger', 'password' => password_hash( 'rmangersifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'12345', 'ime' => 'Slobodan', 'prezime' => 'Ribarić', 'username'=>'sribaric', 'password' => password_hash( 'sribaricsifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'23451', 'ime' => 'Saša', 'prezime' => 'Singer', 'username'=>'ssinger', 'password' => password_hash( 'ssingersifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'23145', 'ime' => 'Vedran', 'prezime' => 'Čačić', 'username'=>'vcacic', 'password' => password_hash( 'vcacicsifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('id'=>'23154', 'ime' => 'Zvonimir', 'prezime' => 'Bujanović', 'username'=>'zbujanov', 'password' => password_hash( 'zbujanovsifra', PASSWORD_DEFAULT ) ) );

}
catch( PDOException $e ) { exit( "PDO error #4: " . $e->getMessage() ); }

echo "Ubacio profesore u tablicu profesori.<br />";

// ubacimo neke veze između profesora i predmeta
try
{
	$st = $db->prepare( 'INSERT INTO predaje(id, isvu) VALUES (:id, :isvu)' );

	$st->execute( array('id'=>'11223', 'isvu' => '92957'));
  $st->execute( array('id'=>'34512', 'isvu' => '45688'));
  $st->execute( array('id'=>'34512', 'isvu' => '92949'));
  $st->execute( array('id'=>'51234', 'isvu' => '45691'));
  $st->execute( array('id'=>'21354', 'isvu' => '45694'));
  $st->execute( array('id'=>'12233', 'isvu' => '61520'));
  $st->execute( array('id'=>'45123', 'isvu' => '92958'));
  $st->execute( array('id'=>'45123', 'isvu' => '45689'));
  $st->execute( array('id'=>'21345', 'isvu' => '45693'));
  $st->execute( array('id'=>'12345', 'isvu' => '92978'));
  $st->execute( array('id'=>'23451', 'isvu' => '92979'));
  $st->execute( array('id'=>'23145', 'isvu' => '61519'));
  $st->execute( array('id'=>'23154', 'isvu' => '45695'));
}
catch( PDOException $e ) { exit( "PDO error #4: " . $e->getMessage() ); }

echo "Ubacio profesore u tablicu profesori.<br />";
*/

// kreiramo tablicu sa studentima
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS studenti (' .
		'JMBAG int(10) NOT NULL PRIMARY KEY,' .
		'ime varchar(50) NOT NULL,' .
		'prezime varchar(50) NOT NULL,' .
    'username varchar(50) NOT NULL,' .
		'password varchar(255) NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #1: " . $e->getMessage() ); }

echo "Napravio tablicu studenti.</br>";

//kreiramo tablicu s upisanim predmetima
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS upisao (' .
		'JMBAG int(10) NOT NULL,' .
		'isvu int(5) NOT NULL,' .
		'OCJENA int(1))'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #1: " . $e->getMessage() ); }

echo "Napravio tablicu s upisanim predmetima.</br>";

//ubacimo studente u tablicu sa studentima
try
{
	$st = $db->prepare( 'INSERT INTO studenti(JMBAG, ime, prezime, username, password) VALUES (:JMBAG, :ime, :prezime, :username, :password)' );

	$st->execute( array('JMBAG'=>'1191227595', 'ime' => 'Ana', 'prezime' => 'Iveković', 'username'=>'aivekov', 'password' => password_hash( 'aivekovsifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('JMBAG'=>'1191228519', 'ime' => 'Iva', 'prezime' => 'Hršak', 'username'=>'ihrsak', 'password' => password_hash( 'ihrsaksifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('JMBAG'=>'1191227233', 'ime' => 'Mirna', 'prezime' => 'Hanžek', 'username'=>'mhanze', 'password' => password_hash( 'mhanzesifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('JMBAG'=>'1191230865', 'ime' => 'Ana', 'prezime' => 'Mlinarić', 'username'=>'amlina', 'password' => password_hash( 'amlinasifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('JMBAG'=>'1191230043', 'ime' => 'Stjepan', 'prezime' => 'Zbiljski', 'username'=>'szbilj', 'password' => password_hash( 'szbiljsifra', PASSWORD_DEFAULT ) ) );
  $st->execute( array('JMBAG'=>'1191230503', 'ime' => 'Luka', 'prezime' => 'Seničić', 'username'=>'lsenic', 'password' => password_hash( 'lsenicsifra', PASSWORD_DEFAULT ) ) );
}
catch( PDOException $e ) { exit( "PDO error #4: " . $e->getMessage() ); }

echo "Ubacio studente u tablicu studenti.<br />";

//popunjavamo tablicu s podatcima o upisima predmeta
try
{
	$st = $db->prepare( 'INSERT INTO upisao(JMBAG, isvu) VALUES (:JMBAG, :isvu)' );

	$st->execute( array('JMBAG'=>'1191227595', 'isvu' => '45688' ) );
	$st->execute( array('JMBAG'=>'1191227595', 'isvu' => '45691' ) );
	$st->execute( array('JMBAG'=>'1191227595', 'isvu' => '45695' ) );
	$st->execute( array('JMBAG'=>'1191227595', 'isvu' => '92957' ) );

	$st->execute( array('JMBAG'=>'1191228519', 'isvu' => '92950' ) );
	$st->execute( array('JMBAG'=>'1191228519', 'isvu' => '61519' ) );
	$st->execute( array('JMBAG'=>'1191228519', 'isvu' => '45689' ) );
	$st->execute( array('JMBAG'=>'1191228519', 'isvu' => '45691' ) );

	$st->execute( array('JMBAG'=>'1191227233', 'isvu' => '92949' ) );
	$st->execute( array('JMBAG'=>'1191227233', 'isvu' => '45694' ) );
	$st->execute( array('JMBAG'=>'1191227233', 'isvu' => '45691' ) );
	$st->execute( array('JMBAG'=>'1191227233', 'isvu' => '92956' ) );

	$st->execute( array('JMBAG'=>'1191230865', 'isvu' => '92978' ) );
	$st->execute( array('JMBAG'=>'1191230865', 'isvu' => '92979' ) );
	$st->execute( array('JMBAG'=>'1191230865', 'isvu' => '45693' ) );
	$st->execute( array('JMBAG'=>'1191230865', 'isvu' => '45694' ) );

	$st->execute( array('JMBAG'=>'1191230043', 'isvu' => '92956' ) );
	$st->execute( array('JMBAG'=>'1191230043', 'isvu' => '92957' ) );
	$st->execute( array('JMBAG'=>'1191230043', 'isvu' => '61520' ) );
	$st->execute( array('JMBAG'=>'1191230043', 'isvu' => '61518' ) );

	$st->execute( array('JMBAG'=>'1191230503', 'isvu' => '45689' ) );
	$st->execute( array('JMBAG'=>'1191230503', 'isvu' => '92950' ) );
	$st->execute( array('JMBAG'=>'1191230503', 'isvu' => '61519' ) );
	$st->execute( array('JMBAG'=>'1191230503', 'isvu' => '45694' ) );
}
catch( PDOException $e ) { exit( "PDO error #4: " . $e->getMessage() ); }

echo "Popunio tablicu s upisanim predmetima.<br />";

 ?>
