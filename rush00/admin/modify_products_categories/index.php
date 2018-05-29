<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
include_once ROOT . "/private/models/products_categories_functions.php";
include_once ROOT . "/private/models/modify_products_model.php";
include_once ROOT . "/private/models/modify_categories_model.php";
$title = "Modifier les produits";
$page = "modify_products_categories";

modify_products();
modify_categories();
$all_categories = get_all_categories();
$all_products = get_all_products();
if (check_admin($_SESSION["logged_on_user"]))
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


			<?php if ($is_admin) { ?>
			<div id="products">
			<?php foreach ($all_products as $key => $product) { ?>
				<div class="product">
					<form action="./" method="post">
						<input type="text" name="id" value="<?= $key ?>" disabled>
						<input type="text" name="name" value="<?= $product["name"] ?>">
						<input type="number" name="price" value="<?= $product["price"] ?>" min="0" step="0.01">

						<?php
						foreach ($all_categories as $c_key => $category) {
							foreach ($category["products"] as $p_key => $product_in_cat) {
								if ($key == $product_in_cat)
									echo "<p class='cat_of_p'>" . $category['name'] . "</p>";
							}
						}
						?>

						<input type="submit" name="<?= $key ?>_delete" value="delete">
						<input type="submit" name="<?= $key ?>_update" value="Update">
					</form>
				</div>
			<?php } ?>
				<div class="new-product">
					<form action="./" method="post">
						<input type="hidden" name="create_product" value="create_product">
						<input type="text" name="name" placeholder="Nom du produit">
						<input type="number" name="price" min="0" step="0.01" placeholder="Prix">

						<input type="submit" value="Create">
					</form>
				</div>
			</div>


			<div id="categories">
				<?php foreach ($all_categories as $key => $category) { ?>
				<div class="category">
					<form action="./" method="post">
						<input type="text" name="id" value="<?= $key ?>" disabled>
						<input type="text" name="name" value="<?= $category["name"] ?>">

						<?php foreach ($category["products"] as $p_key => $product) {
							echo "<p class='cat_of_p'>" . $all_products[$product]['name'] . "</p>";
						} ?>

						<input type="submit" name="<?= $key ?>_delete" value="delete">
						<input type="submit" name="<?= $key ?>_update" value="Update">
					</form>
				</div>
				<?php } ?>
				<div class="new-category">
					<form action="./" method="post">
						<input type="hidden" name="create_category" value="create_category">
						<input type="text" name="name" value="">

						<input type="submit" value="Create">
					</form>
				</div>
			</div>

			<div id="link">
				<form action="./" method="post">
					<input type="hidden" name="link-unlink" value="link-unlink">
					<select name="product">
						<option name="">Product</option>
						<?php foreach ($all_products as $key => $product) { ?>
						<option name="<?= $key ?>"><?= $product["name"] ?></option>
						<?php } ?>
					</select>

					<select name="category">
						<option name="">Category</option>
						<?php foreach ($all_categories as $key => $category) { ?>
						<option name="<?= $key ?>"><?= $category["name"] ?></option>
						<?php } ?>
					</select>

					<input type="submit" value="Link / Unlink">
				</form>
			</div>

			<?php } else { ?>

			<h1>Vous n'êtes pas autorisés a accéder a cette page</h1>

			<?php } ?>
		</div>
		<?php include_once ROOT . "/private/templates/footer.php"; ?>
	</body>
</html>
