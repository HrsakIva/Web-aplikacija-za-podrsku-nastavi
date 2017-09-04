<?php
class PredmetController extends BaseController{
  public function index(){
		header( 'Location: ' . __SITE_URL );
		exit();
	}

  public function pokaziPredmetProfesor()
  {
    $ps = new PredmetService();

		if(!isset($_SESSION['id'])){

			header( 'Location: ' . __SITE_URL);
			exit();
		}

		if(!isset($_POST['isvu'])){

			header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
			exit();
		}

		$this->registry->template->idPredmet = $_POST['isvu'];
    $this->registry->template->title = '';
		$this->registry->template->nazivPredmeta = $ps->getNazivPredmeta($_POST['isvu']);
    $this->registry->template->obavijesti = $ps->getObavijestByPredmet($_POST['isvu']);
    $this->registry->template->upisaniStudenti = $ps->getStudentiByPredmet($_POST['isvu']);
    $this->registry->template->elementi = $ps->getElementiOcjenjivanja($_POST['isvu']);
		$this->registry->template->show('profesor_prikaz_predmeta');
  }

  public function novaObavijest()
  {
    $ps = new PredmetService();

		if(!isset($_SESSION['id'])){
			header( 'Location: ' . __SITE_URL);
			exit();
		}

		if(!isset($_POST['isvu'])){
			header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
			exit();
		}
    if(!isset($_POST['sadrzaj'])){
			header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
			exit();
    }

    $tmp_isvu = $_POST['isvu'];
    $phpdate = time();
    $sql_vrijeme = date('Y-m-d H:i:s', $phpdate );
    $tmp_sadrzaj = $_POST['sadrzaj'];
    $ps->napraviNovuObavijest($tmp_isvu, $sql_vrijeme, $tmp_sadrzaj);

    $this->registry->template->idPredmet = $_POST['isvu'];
    $this->registry->template->title = '';
		$this->registry->template->nazivPredmeta = $ps->getNazivPredmeta($_POST['isvu']);
    $this->registry->template->obavijesti = $ps->getObavijestByPredmet($_POST['isvu']);
    $this->registry->template->upisaniStudenti = $ps->getStudentiByPredmet($_POST['isvu']);
    $this->registry->template->elementi = $ps->getElementiOcjenjivanja($_POST['isvu']);
		$this->registry->template->show('profesor_prikaz_predmeta');
  }

  public function pokaziPredmetStudent()
  {
    $ps = new StudentService();

    if(!isset($_SESSION['JMBAG'])){
      header( 'Location: ' . __SITE_URL);
      exit();
    }

    if(!isset($_POST['isvu'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    $this->registry->template->idPredmet = $_POST['isvu'];
    $this->registry->template->title = '';
    $this->registry->template->nazivPredmeta = $ps->getNazivPredmeta($_POST['isvu']);
    $this->registry->template->obavijesti = $ps->getObavijestByPredmet($_POST['isvu']);
    $this->registry->template->ocjena = $ps->getOcjenaIzPredmeta($_SESSION['JMBAG'], $_POST['isvu']);
    $this->registry->template->rezultati = $ps->getRezultatiIzPredmeta($_SESSION['JMBAG'], $_POST['isvu']);
    $this->registry->template->show('student_prikaz_predmeta');
  }

  public function obrisiObavijest()
  {
    $ps = new PredmetService();

    if(!isset($_SESSION['id'])){
      header( 'Location: ' . __SITE_URL);
      exit();
    }

    if(!isset($_POST['obrisi'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    $this->registry->template->idObavijesti = $_POST['obrisi'];
    $this->registry->template->idPredmet = $_POST['obrisanoIzPredmeta'];
    $this->registry->template->title = '';
    $this->registry->template->nazivPredmeta = $ps->getNazivPredmeta($_POST['obrisanoIzPredmeta']);
    $this->registry->template->obavijesti = $ps->obrisiObavijest($_POST['obrisi'], $_POST['obrisanoIzPredmeta'] );
    $this->registry->template->upisaniStudenti = $ps->getStudentiByPredmet($_POST['obrisanoIzPredmeta']);
    $this->registry->template->elementi = $ps->getElementiOcjenjivanja($_POST['obrisanoIzPredmeta']);
    $this->registry->template->show('profesor_prikaz_predmeta');
  }

  public function noviElement()
  {
    $ps = new PredmetService();

    if(!isset($_POST['isvu_predmeta'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }
    if(!isset($_POST['naziv_elementa'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    $tmp_isvu = $_POST['isvu_predmeta'];
    $tmp_naziv = $_POST['naziv_elementa'];
    $ps->napraviNoviElement($tmp_isvu, $tmp_naziv);

    $this->registry->template->idPredmet = $_POST['isvu_predmeta'];
    $this->registry->template->title = '';
    $this->registry->template->nazivPredmeta = $ps->getNazivPredmeta($_POST['isvu_predmeta']);
    $this->registry->template->obavijesti = $ps->getObavijestByPredmet($_POST['isvu_predmeta']);
    $this->registry->template->upisaniStudenti = $ps->getStudentiByPredmet($_POST['isvu_predmeta']);
    $this->registry->template->elementi = $ps->getElementiOcjenjivanja($_POST['isvu_predmeta']);
    $this->registry->template->show('profesor_prikaz_predmeta');
  }

  public function obrisiElement()
  {
    $ps = new PredmetService();

    if(!isset($_POST['obrisi_element'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }
    if(!isset($_POST['obrisanElementIzPredmeta'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    $tmp_isvu = $_POST['obrisanElementIzPredmeta'];
    $tmp_idElementa = $_POST['obrisi_element'];

    $this->registry->template->idPredmet = $_POST['obrisanElementIzPredmeta'];
    $this->registry->template->title = '';
    $this->registry->template->nazivPredmeta = $ps->getNazivPredmeta($_POST['obrisanElementIzPredmeta']);
    $this->registry->template->obavijesti = $ps->getObavijestByPredmet($_POST['obrisanElementIzPredmeta']);
    $this->registry->template->upisaniStudenti = $ps->getStudentiByPredmet($_POST['obrisanElementIzPredmeta']);
    $this->registry->template->elementi = $ps->obrisiElementByPredmet($_POST['obrisanElementIzPredmeta'], $_POST['obrisi_element']);
    $this->registry->template->show('profesor_prikaz_predmeta');
  }

  public function noviRezultat()
  {
    $ps = new PredmetService();

    if(!isset($_POST['isvu_predmeta_rezultat'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    if(!isset($_POST['ocjenjujem'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    if(!isset($_POST['postotak'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    if(!isset($_POST['JMBAG_rezultat'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    $ps->unesiRezultat($_POST['isvu_predmeta_rezultat'], $_POST['JMBAG_rezultat'], $_POST['ocjenjujem'], $_POST['postotak']);

    $this->registry->template->idPredmet = $_POST['isvu_predmeta_rezultat'];
    $this->registry->template->title = '';
    $this->registry->template->nazivPredmeta = $ps->getNazivPredmeta($_POST['isvu_predmeta_rezultat']);
    $this->registry->template->obavijesti = $ps->getObavijestByPredmet($_POST['isvu_predmeta_rezultat']);
    $this->registry->template->upisaniStudenti = $ps->getStudentiByPredmet($_POST['isvu_predmeta_rezultat']);
    $this->registry->template->elementi = $ps->getElementiOcjenjivanja($_POST['isvu_predmeta_rezultat']);
    $this->registry->template->show('profesor_prikaz_predmeta');
  }

  public function unesiOcjenu()
  {
    $ps = new PredmetService();

    if(!isset($_POST['zavrsna_ocjena'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    if(!isset($_POST['JMBAG_zavrsna'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    if(!isset($_POST['isvu_zavrsna'])){
      header( 'Location: ' . __SITE_URL . '/index.php?rt=predmet');
      exit();
    }

    $ps->unesiZavrsnuOcjenu($_POST['JMBAG_zavrsna'], $_POST['isvu_zavrsna'], $_POST['zavrsna_ocjena']);

    $this->registry->template->idPredmet = $_POST['isvu_zavrsna'];
    $this->registry->template->title = '';
    $this->registry->template->nazivPredmeta = $ps->getNazivPredmeta($_POST['isvu_zavrsna']);
    $this->registry->template->obavijesti = $ps->getObavijestByPredmet($_POST['isvu_zavrsna']);
    $this->registry->template->upisaniStudenti = $ps->getStudentiByPredmet($_POST['isvu_zavrsna']);
    $this->registry->template->elementi = $ps->getElementiOcjenjivanja($_POST['isvu_zavrsna']);
    $this->registry->template->show('profesor_prikaz_predmeta');
  }
}


 ?>
