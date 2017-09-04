<?php require_once __SITE_PATH . '/view/_header.php'; ?>


<script>
	function dodaj_novi(neki_id)
	{
			var modal = document.getElementById(neki_id);
			modal.style.display = "block";
	}

	function zatvori_skriveni(neki_id)
	{
		var modal = document.getElementById(neki_id);
		modal.style.display = "none";
	}
</script>

<div id="zaglavljePI">
<?php

	if(isset($_SESSION['ime'])){
		echo '<h1>' . $_SESSION['ime'].' '.$_SESSION['prezime'] . '</h1>';
?>
</div>
<div class="odjava">
	<a href="<?php echo __SITE_URL; ?>/index.php?rt=profesor/odjava"><button class="odjavaGumb">Odjavi se!</button></a>
</div>
<?php
}

?>
<div id="obavijestiP">
<?php
	echo '<h2>'.$nazivPredmeta.'</h2>';
	if($obavijesti == false){
		echo '<p>Nema obavijesti.<hr></p>';
	}
	else{
		foreach( $obavijesti as $obavijest ){
			?>

		<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=predmet/obrisiObavijest">
			<?php echo '<p>[' .$obavijest->vrijeme.'] '.$obavijest->sadrzaj; ?>
		  <input type="hidden" name="obrisi" value="<?php echo $obavijest->id;?>"/>
			<input type="hidden" name="obrisanoIzPredmeta" value="<?php echo $idPredmet;?>"/>
		  <button class="izbrisi" type="submit">X</button></p><hr>
		</form>
		<?php
    }
	}
?>

<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=predmet/novaObavijest">
  <input type="hidden" name="isvu" value="<?php echo $idPredmet;?>"/>
  <textarea name="sadrzaj" rows="10" cols="50"> Ovdje napisite obavijest!</textarea>
  <button type="submit">Objavi!</button>
</form>
</div>
<div id="upisani">
<?php
	if( $upisaniStudenti == false )
	 	echo "<p id='nemaUpisanih'>Nema upisanih studenata.</p>";

	else {
		echo "<div id='popis_upisanih_studenata'>";
		echo "<p id='popis_studenata_naslov'><b>UPISANI STUDENTI:</b></p>";
		foreach($upisaniStudenti as $student){
			?>
			<button class='gumb_student'  onclick="dodaj_novi('<?php echo $student->JMBAG; ?>')"> <?php echo $student->JMBAG . "\t" .
			$student->ime . "\t" . $student->prezime; ?></button> <br />

			<div class='unos_rezultata' id="<?php echo $student->JMBAG; ?>"  style="display: none;">
				<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=predmet/noviRezultat">
				<input type="hidden" name="JMBAG_rezultat" value="<?php echo $student->JMBAG; ?>" />
				<input type="hidden" name="isvu_predmeta_rezultat" value="<?php echo $idPredmet;?>"/>
				<?php
				foreach($elementi as $element)
				{
					?>
					<input type="radio" name="ocjenjujem" value="<?php echo $element->id_elementa; ?>"><?php echo $element->naziv_elementa; ?></input><br />
					<?php
				}
				 ?>
				<input type="text" id="unos_elementa" name="postotak"></input>
				<button type="submit">Unesi!</button>
				</form>
				<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=predmet/unesiOcjenu">
					<p id="zavrsna_ocj_poruka">Ovdje možete unijeti završnu ocjenu:</p><br />
					<input type="number" name="zavrsna_ocjena" min="1" max="5" />
					<input type="hidden" name="JMBAG_zavrsna" value="<?php echo $student->JMBAG; ?>" />
					<input type="hidden" name="isvu_zavrsna" value="<?php echo $idPredmet;?>"/>
					<button type="submit">Unesi završnu ocjenu!</button>
				</form>
				<button class='zatvarac' onclick="zatvori_skriveni('<?php echo $student->JMBAG; ?>')">Zatvori!</button>
			</div>
	<?php
	}
	echo "</div>";
}
?>

<div id="elementi_ocj" >
	<p><span id="elementi_ocj_naslov"><b>ELEMENTI OCJENJIVANJA:</b></span></p>
	<?php
		if(! ($elementi == false))
		{
			foreach($elementi as $element)
			{

			?>
			<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=predmet/obrisiElement">
				<?php echo "<p id='element_profesor_prikaz'>" . $element->naziv_elementa.' '; ?>
				<input type="hidden" name="obrisi_element" value="<?php echo $element->id_elementa;?>"/>
				<input type="hidden" name="obrisanElementIzPredmeta" value="<?php echo $idPredmet;?>"/>
				<button class="izbrisi" type="submit">X</button></p>
			</form>

			<?php
			}
		}
		?>

	<button id="novi_element" onclick="dodaj_novi('skriveni1')">Dodaj novi element!</button>
</div>

	<div id="skriveni1" style="display: none;">
		<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=predmet/noviElement">
		<input type="hidden" name="isvu_predmeta" value="<?php echo $idPredmet;?>"/>
		<textarea name="naziv_elementa" rows="2" cols="10" id="unos_elementa">Unesite ime elementa!</textarea>
		<button type="submit">Dodaj!</button>
	</div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
