<?php require_once __SITE_PATH . '/view/_header.php'; ?>
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
<div id="popisPP">
<?php

	if($popisPredmeta == false){
		echo '<p>Ne predajete ni jedan kolegij.</p>';
	}
	else{
    echo '<table class="popisPT">';
		foreach( $popisPredmeta as $predmet ){
			echo '<tr><td>' .$predmet->naziv.'<hr></td>';
?>
    <td>
    <form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=predmet/pokaziPredmetProfesor">
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
