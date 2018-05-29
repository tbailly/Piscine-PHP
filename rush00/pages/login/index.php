<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
include_once ROOT . "/private/models/login_model.php";
$title = "Page de connexion";
$page = "admin";

$login_success = login();

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include_once ROOT . "/private/templates/meta.php"; ?>
	<body>
		<?php include_once ROOT . "/private/templates/header.php"; ?>

		<div id="main">
			<?php if ($login_success === 0){ ?>

			<h1>Bienvenue <?= $_SESSION["logged_on_user"]?> !</h1>
			<p>Vous pouvez maintenant <a href="../../">visitez notre site</a></p>

			<?php } else if ($login_success == 1) { ?>
					<h1>Se Connecter</h1>
				<form action="./" method="post">
					<input type="text" name="login" value="" placeholder="Identifiant">
					<input type="password" name="passwd" value="" placeholder="Mot de passe">
					<input class="submit" type="submit" name="submit" value="Se connecter">
				</form>

			<?php } else { ?>
			<h1>Erreur Login/Mot de passe</h1>
			<p>Login/Mot de passe incorrect, vous pouvez revenir à <a href="../../">l'acceuil</a> ou <a href="../login">essayez de vous reconnecter</a></p>

			<?php } ?>
		</div>

		<?php include_once ROOT . "/private/templates/footer.php"; ?>
	</body>
</html>
