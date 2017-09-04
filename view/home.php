<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div id="home">
<div id="homeSlika">
  <img src="<?php echo __SITE_URL;?>/view/naslovna.jpg" alt="Avatar" id="imgNaslovna">
</div>
<div id="homeNaslov">
<h1>Računarci</h1>
</div>

<div id="gumbProfesor">
  <a href="<?php echo __SITE_URL; ?>/index.php?rt=profesor"><button class="pocetni">Profesor</button></a>
</div>

<div id="gumbStudent">
  <a href="<?php echo __SITE_URL; ?>/index.php?rt=student"><button class="pocetni">Student</button></a>
</div>

</div>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
