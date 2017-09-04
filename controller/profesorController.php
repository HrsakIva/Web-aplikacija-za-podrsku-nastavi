<?php
class profesorController extends BaseController{
	public function index(){

        if(!isset($_SESSION['id'])){
            $this->registry->template->title = '';
            $this->registry->template->show('profesor_logForm');
        }
        else{
            $ps = new PredmetService();
            $this->registry->template->popisPredmeta = $ps->getPredmetByProfesor($_SESSION['id']);
            $this->registry->template->title = '';
            $this->registry->template->show('profesor_index');
        }
	}

  public function login(){

  $ps = new PredmetService();
  if(!isset($_POST['username']) || !isset($_POST['password'])){
    $this->registry->template->title = '';
    $this->registry->template->show('profesor_logForm');
    exit();
  }

  if( !preg_match('/^[a-zA-Z]{1,50}$/',$_POST['username'])){
    $this->registry->template->title = '';
    $this->registry->template->show('profesor_logForm');
    exit();
  }
	
  $username = $_POST['username'];
  if($ps->profesorExist($username) && password_verify( $_POST['password' ], $ps->getProfesorPassword($username))){
    $_SESSION['id'] = $ps->getProfesorId($username);
    $_SESSION['ime'] = $ps->getProfesorIme($_SESSION['id']);
    $ime = $ps->getProfesorIme($_SESSION['id']);
    $prezime = $ps->getProfesorPrezime($_SESSION['id']);
    $_SESSION['prezime'] = $ps->getProfesorPrezime($_SESSION['id']);
    $_SESSION['username'] = $username;

    $this->registry->template->title = '';
    $this->registry->template->popisPredmeta = $ps->getPredmetByProfesor($_SESSION['id']);
    $this->registry->template->show( 'profesor_index' );
  }
  else if(!$ps->profesorExist($username)){
    $this->registry->template->title = '';
    $this->registry->template->show('profesor_logForm');
  }
  else{
    $this->registry->template->title = '';
    $this->registry->template->show('profesor_logForm');

  }
}

public function odjava()
{

	session_unset();
	session_destroy();

	header( 'Location: ' . __SITE_URL );
	exit();
}

}
 ?>
