<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
$title = "Mon Compte";
$page = "admin";
?>


<!DOCTYPE html>
<html lang="en">
<?php include_once ROOT . "/private/templates/meta.php"; ?>
<body>
<?php include_once ROOT . "/private/templates/header.php"; ?>

<div id="main">

    <h1>Profil</h1>
        <form action="" method="post">
          <input type="text" name="firt_name" value="" placeholder="Prénom">
					<input type="text" name="last_name" value="" placeholder="Nom">
					<input type="text" name="login" value="" placeholder="Identifiant">
					<input type="password" name="passwd" value="" placeholder="Mot de passe">
          <input type="password" name="newpasswd" value="" placeholder="Nouveau mot de passe">
					<input class="submit" type="submit" name="submit" value="Appliquer">
				</form>
        <hr />
        <h1>Suprimer mon compte</h1>
        <form action="../delete_account" method="post">
        <input class="submit" type="submit" name="submit" value="Suprimer">
        </form>



</div>


	<?php include_once ROOT . "/private/templates/footer.php"; ?>
</body>
</html>
