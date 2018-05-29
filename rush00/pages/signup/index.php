<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
include_once ROOT . "/private/models/login_model.php";
include_once ROOT . "/private/models/signup_model.php";
$title = "S'inscrire";
$page = "admin";

$signup_res = signup();
if ($signup_res === 0)
	login();

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include_once ROOT . "/private/templates/meta.php"; ?>
	<body>
		<?php include_once ROOT . "/private/templates/header.php"; ?>

			<?php if ($signup_res === 0){ ?>

			<h1>Votre inscription a bien été prise en compte !</h1>

			<?php } else if ($signup_res == 1) { ?>

			<h1>Vous etes déja connecté. Déconnectez vous d'abord pour créer un nouveau compte</h1>

			<?php } else if ($signup_res == 2) { ?>

			<div id="main">
				<h1>S'inscrire</h1>
				<form action="./" method="post">
					<input type="text" name="first_name" value="" placeholder="Prénom">
					<input type="text" name="last_name" value="" placeholder="Nom">
					<input type="text" name="login" value="" placeholder="Identifiant">
					<input type="password" name="passwd" value="" placeholder="Mot de passe">
					<input class="submit" type="submit" name="submit" value="S'inscrire">
				</form>
			</div>

			<?php } else { ?>

			<h1>L'utilisateur <?= $_POST["login"] ?> existe déja</h1>

			<?php } ?>



		<?php include_once ROOT . "/private/templates/footer.php"; ?>
	</body>
</html>
