<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<script>
	function prikazi_skriveni(neki_id)
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

<div id="zaglavljeSI">
<?php
if(isset($_SESSION['imes'])){
	echo '<h1>' . $_SESSION['imes'].' '.$_SESSION['prezimes'] . '</h1>';
	?>
	</div>
	<div class="odjava">
		<a href="<?php echo __SITE_URL; ?>/index.php?rt=student/odjava"><button class="odjavaGumb">Odjavi se!</button></a>
	</div>
	<?php
}
?>
<div id="obavijestiS">
<?php
	echo '<h2>'.$nazivPredmeta.'</h2>';
	if($obavijesti == false){
		echo '<p>Nema obavijesti.<hr></p>';
	}
	else{
		foreach( $obavijesti as $obavijest ){
			echo '<p>[' .$obavijest->vrijeme.'] '.$obavijest->sadrzaj.'<hr></p>';
    }}
?>

<?php
  if( !($ocjena == NULL)){
    echo "<p id='ocjena'>Vaša ocjena: " . $ocjena . ".</p>";
  }
 ?>

<button id='prikazi_rezultate' onclick="prikazi_skriveni('dosadasnji_rezultati')">REZULTATI !</button>
 <div id='dosadasnji_rezultati' style="display: none;">
	 <br>
	 <table id='rezultati_predmeta'>
		 <tr>
		 	<th class="rezultatiTD">ELEMENT</th>
			<th class="rezultatiTD">POSTOTAK</th>
		 </tr>
		 <?php
		 foreach($rezultati as $rezultat)
		 {
			 ?>
			 <tr>
				 <td class="rezultatiTD"><?php echo $rezultat->naziv_elementa; ?></td>
				 <td class="rezultatiTD"><?php echo $rezultat->postotak; ?></td>
			 </tr>
			 <?php
		 }
		  ?>
	 </table>
	 <br>
	 <button id='zatvori_rezultate' onclick="zatvori_skriveni('dosadasnji_rezultati')">Sakrij rezultate!</button>
 </div>
</div>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
