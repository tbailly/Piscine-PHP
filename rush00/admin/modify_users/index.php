<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
include_once ROOT . "/private/models/modify_users_model.php";
$title = "Modifier les comptes";
$page = "modify_users";

modify_users();

$all_users = get_all_users();
if (check_admin(htmlentities($_SESSION["logged_on_user"])))
	$is_admin = TRUE;
else
	$is_admin = FALSE;

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include_once ROOT . "/private/templates/meta.php"; ?>
	<body>
		<?php include_once ROOT . "/private/templates/header.php"; ?>

		<div id="main">

			<?php
			if ($is_admin)
			{
			foreach ($all_users as $key => $user) {
			?>
			<div class="user">
				<form action="./" method="post">
					<input type="text" name="first_name" value="<?= $user["first_name"] ?>">
					<input type="text" name="last_name" value="<?= $user["last_name"] ?>">
					<input type="text" name="role" value="<?= $user["role"] ?>">
					<input type="text" name="login" value="<?= $user["login"] ?>">
					<input type="password" name="passwd" value="">

					<input type="submit" name="<?= $user["login"] ?>_update" value="Update">
					<input type="submit" name="<?= $user["login"] ?>_delete" value="delete">
				</form>
			</div>
			<?php } ?>
			<div class="new-user">
				<form action="./" method="post">
					<input type="hidden" name="create_user" value="create_user">
					<input type="text" name="first_name" value="" placeholder="Prénom">
					<input type="text" name="last_name" value="" placeholder="Nom">
					<input type="text" name="role" value="" placeholder="Rôle">
					<input type="text" name="login" value="" placeholder="Login">
					<input type="password" name="passwd" value="" placeholder="Mot de passe">

					<input type="submit" name="create" value="Create">
				</form>
			</div>

		<?php } else { ?>

		<h1>Vous n'êtes pas autorisés a accéder a cette page</h1>

		<?php } ?>
		</div>
		<?php include_once ROOT . "/private/templates/footer.php"; ?>
	</body>
</html>
