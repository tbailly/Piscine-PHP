<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
include_once ROOT . "/private/models/login_model.php";
$title = "Administration";
$page = "admin";

$login_status = login_admin();

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include_once ROOT . "/private/templates/meta.php"; ?>
	<body>
		<?php include_once ROOT . "/private/templates/header.php"; ?>
		
		<div id="main">

			<?php if ($login_status == 0) { ?>

			<h1>Panneau de contrôle</h1>
			<div class="button-wrapper">
				<a class="button-like" href="modify_users">Gérer les utilisateurs</a><br>
				<a class="button-like" href="modify_products_categories">Gérer les produits et les catégories</a><br>
				<a class="button-like" href="modify_orders">Gérer les commandes</a>
			</div>

			<?php } else if ($login_status == 3) { ?>

			<h1>Vous n'êtes pas autorisé à accéder à cette partie du site</h1>

			<?php } else if ($login_status == 4) { ?>

			<h1>Vous n'êtes pas autorisé à accéder à cette partie du site</h1>
			<p>Authentification réussie, mais seul les administrateurs du site sont autorisés ici.</p>

			<?php } if ($login_status == 3 || $login_status == 4) { ?>

			<p>Si vous êtes un administrateur du site, vous pouvez <a href="<?php echo URL . '/pages/logout'?>">vous déconnecter</a>.</p>
			<p>Sinon, nous vous invitons à revenir sur la <a href="<?php echo URL ?>">page principale</a>.</p>

			<?php } if ($login_status == 1 || $login_status == 2) { ?>

				<h1>Veuillez vous connecter pour accéder a l'interface d'administration</h1>
				<form action="./" method="post">
					<input type="text" name="login" value="" placeholder="Identifiant">
					<input type="password" name="passwd" value="" placeholder="Mot de passe">
					<input class="submit" type="submit" name="submit" value="Se connecter">
				</form>

			<?php } if ($login_status == 2) { ?>
					<p class="error_message">Mauvais login/mot de passe<p>
			<?php } ?>

		</div>

		<?php include_once ROOT . "/private/templates/footer.php"; ?>
	</body>
</html>