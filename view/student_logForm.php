<?php require_once __SITE_PATH . '/view/_header.php'; ?>

    <form  method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=student/login">
        <div class="imgcontainer">
          <img src="<?php echo __SITE_URL;?>/view/student.png" alt="Avatar" class="avatar">
        </div>
        <div class="container">
        <label><b>Korisničko ime:</b></label>
        <input type="text" name="username" required/>
        <label><b>Lozinka:</b></label>
        <input type="password" name="password" required/>

    	<button type="submit" class="submitButton">Prijavi se!</button>
    </div>
    </form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
