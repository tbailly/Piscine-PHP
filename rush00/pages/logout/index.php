<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
include_once ROOT . "/private/models/logout_model.php";
$title = "Page de deconnexion";
$page = "admin";

$logout_success = logout();

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include_once ROOT . "/private/templates/meta.php"; ?>
	<body>
		<?php include_once ROOT . "/private/templates/header.php"; ?>

		<div id="main">
			<?php if ($logout_success === 0) { ?>

			<h1>Vous êtes maintenant déconnecté </h1>
			<p>Vous pouvez toujours <a href="../../">voir nos produits</a>, et vous <a href="../login">login</a> !</p>

			<?php } else { ?>

			<h1>You're not logged in</h1>

			<?php } ?>
		</div>

		<?php include_once ROOT . "/private/templates/footer.php"; ?>
	</body>
</html>
