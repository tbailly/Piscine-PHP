<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
include_once ROOT . "/private/models/orders_functions.php";
include_once ROOT . "/private/models/products_categories_functions.php";
include_once ROOT . "/private/models/modify_orders_model.php";
$title = "Modifer les commamdes";
$page = "modify_orders";

modify_orders();

if (check_admin(htmlentities($_SESSION["logged_on_user"])))
	$is_admin = TRUE;
else
	$is_admin = FALSE;

$all_orders = get_all_orders();
$all_products = get_all_products();

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
			foreach ($all_orders as $key => $order) {
			?>
			<div class="order">
				<form action="./" method="post">
					<input type="text" name="id" value="<?= $key ?>" disabled>
					<input type="text" name="user" value="<?= $order["user"] ?>" disabled>

					<?php
					foreach ($order["products"] as $key => $product) {
						echo "<p class='p_of_ord'>" . htmlentities($all_products[$key]["name"]);
						echo " x " . htmlentities($product) . "</p>";
					}
					?>
				</form>
			</div>
			<?php } ?>
			<div class="new-order">
				<form action="./" method="post">
					<input type="hidden" name="create_order" value="create_order">
					<input type="text" name="user" value="" placeholder="Utilisateur">

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
