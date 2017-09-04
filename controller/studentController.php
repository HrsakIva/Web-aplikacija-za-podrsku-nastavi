<?php
class studentController extends BaseController{
	public function index(){

        if(!isset($_SESSION['JMBAG'])){
					$this->registry->template->title = 'Login';
					$this->registry->template->show('student_logForm');
        }
        else{
            $ps = new StudentService();
						$this->registry->template->title = '';
				    $this->registry->template->popisUpisanihPredmeta = $ps->getPredmetByStudent($_SESSION['JMBAG']);
				    $this->registry->template->show( 'student_index' );
        }
	}

  public function login(){

  $ps = new StudentService();
  if(!isset($_POST['username']) || !isset($_POST['password'])){
    $this->registry->template->title = 'Login';
    $this->registry->template->show('student_logForm');
    exit();
  }

  if( !preg_match('/^[a-zA-Z]{1,50}$/',$_POST['username'])){
    $this->registry->template->title = 'Login';
    $this->registry->template->show('student_logForm');
    exit();
  }

  $username = $_POST['username'];
  if($ps->studentExist($username) && password_verify( $_POST['password' ], $ps->getStudentPassword($username))){
    $_SESSION['JMBAG'] = $ps->getStudentJMBAG($username);
    $_SESSION['imes'] = $ps->getStudentIme($_SESSION['JMBAG']);
    $ime = $ps->getStudentIme($_SESSION['JMBAG']);
    $prezime = $ps->getStudentPrezime($_SESSION['JMBAG']);
    $_SESSION['prezimes'] = $ps->getStudentPrezime($_SESSION['JMBAG']);
    $_SESSION['usernames'] = $username;

    $this->registry->template->title = '';
    $this->registry->template->popisUpisanihPredmeta = $ps->getPredmetByStudent($_SESSION['JMBAG']);
    $this->registry->template->show( 'student_index' );
  }
  else if(!$ps->studentExist($username)){
    $this->registry->template->title = 'Login';
    $this->registry->template->show('student_logForm');
  }
  else{
    $this->registry->template->title = 'Login';
    $this->registry->template->show('student_logForm');

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
