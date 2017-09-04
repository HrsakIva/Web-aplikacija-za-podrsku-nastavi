<?php require_once __SITE_PATH . '/view/_header.php'; ?>
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
<div id="popisPS">
<?php

	if($popisUpisanihPredmeta == false){
		echo '<p>Niste upisali nijedan kolegij.</p>';
	}
	else{
    echo '<table class="popisPT">';
		foreach( $popisUpisanihPredmeta as $predmet ){
			echo '<tr><td>' .$predmet->naziv.'<hr></td>';
?>
    <td>
    <form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=predmet/pokaziPredmetStudent">
      <input type="hidden" name="isvu" value="<?php echo $predmet->isvu;?>"/>
      <button type="submit" class="pregledaj">Pregledaj</button>
    </form>
  </td>
</tr>
<?php
    }
    echo '</table>';
  }
?>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
