<?php

session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/cart_functions.php";
include_once ROOT . "/private/models/products_categories_functions.php";
$title = "MiniShop";
$page = "home";

$error = FALSE;
$action = NULL;
$l = NULL;
$q = NULL;
if ($_GET && isset($_GET['action']))
	$action = $_GET['action'];
if($action !== NULL)
{
	if(!in_array($action, array('ajout', 'suppression', 'refresh')))
		$error = TRUE;
	if (isset($_GET['l']))
		$l = $_GET['l'];
	if (isset($_GET['q']))
		$q = $_GET['q'];

	if (is_array($q)){
		$quantity = array();
		$i = 0;
		foreach ($q as $content){
		 $quantity[$i++] = intval($content);
		}
	}
	else
		$q = intval($q);
}

if (!$error){
   switch($action){
      Case "ajout":
         add_product($l, $q);
         break;

      Case "suppression":
         delete_product($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($quantity) ; $i++)
         {
            update_product_quantity($_SESSION['cart']['ids'][$i],round($quantity[$i]));
         }
         break;
      Default:
         break;
   }
}
$all_products = get_all_products();
$all_categories = get_all_categories();

?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once ROOT . "/private/templates/meta.php"; ?>
<body>
	<?php include_once ROOT . "/private/templates/header.php"; ?>

		<div id='wrapper'>
			<div id="categories">
				
			</div>

			<div class='product'>

				<table class="container">
					<thead>
						<tr>
							<th><h1>Eleves</h1></th>
							<th><h1>Categorie</h1></th>
							<th><h1>Quantité</h1></th>
							<th><h1>Prix</h1></th>
							<th><h1>Acheter</h1></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($all_products as $key => $product) { ?>
						
						<tr>
							<td><img src="https://cdn.intra.42.fr/users/medium_<?= $product["name"] ?>.jpg" alt="<?= $product["name"] ?>"></td>
							<td>
							
							<?php
							foreach ($all_categories as $c_key => $category)
							{
								if ((array_search($key, $category["products"])) !== FALSE)
									echo "<span>" . $category["name"] . "</span>";
							} ?>

							</td>
							<td>
								<input class="quantity" type="number" min="0" name="<?= $key ?>_quantity">
							</td>
							<td><?= $product["price"] ?></td>
							<td><h2>
								<button product_data="<?= $key ?>" onclick="updateCart(this)">Ajouter au panier</button>
							</h2></td>
						</tr>

						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>

	<?php include_once ROOT . "/private/templates/footer.php"; ?>
	
	<script src="<?php echo URL ?>/js/main.js"></script>
</body>
</html>
