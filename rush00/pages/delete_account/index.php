<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
include_once ROOT . "/private/models/delete_account_model.php";
include_once ROOT . "/private/models/logout_model.php";
$title = "Suprimer un compte";
$page = "admin";

$account_deleted = delete_account();

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include_once ROOT . "/private/templates/meta.php"; ?>
	<body>
		<?php include_once ROOT . "/private/templates/header.php"; ?>

		<div id="main">
			<?php if ($account_deleted === 0){ ?>

			<h1>Votre compte est bien suprimer !</h1>

			<?php } else if ($account_deleted == 1) { ?>

			<h1>Vous devez être connecté pour suprimer un compte</h1>

			<?php } ?>
		</div>

		<?php include_once ROOT . "/private/templates/footer.php"; ?>
	</body>
</html>
