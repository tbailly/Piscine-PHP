<?php

session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/cart_functions.php";
include_once ROOT . "/private/models/products_categories_functions.php";
$title = "Panier";
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
            update_product_quantity($_SESSION['cart']['ids'][$i], round($quantity[$i]));
         }
         break;
      Default:
         break;
   }
}
$all_products = get_all_products();

?>



<!DOCTYPE html>
<html lang="fr">
<?php include_once ROOT . "/private/templates/meta.php"; ?>
<body>
<?php include_once ROOT . "/private/templates/header.php"; ?>

<div id='wrapper'>
  <h1>Mon Panier</h1>
<form method="post" action="panier.php">
	<table class="container">
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>
	<?php
	cart_creation();
	$nb_products = count($_SESSION['cart']['ids']);
	if ($nb_products <= 0)
		echo "<tr><td>Votre panier est vide </ td></tr>";
	for ($i=0 ;$i < $nb_products ; $i++)
	{
		foreach ($all_products as $key => $product) {
			if ($key === $_SESSION['cart']['ids'][$i])
			{
	?>
	<tr>
		<td>
		<img src="https://cdn.intra.42.fr/users/medium_<?= $product["name"] ?>.jpg" alt="<?= $product["name"] ?>">
		</td>
		<td><input type="text" size="4" name="q[]" value="<?= $_SESSION['cart']['quantities'][$i] ?>"/></td>
		<td><?= $product["price"] ?></td>
		<td><a href="panier.php?action=suppression&l=<?= $key ?>">Supprimer</a></td>
	</tr>

	<?php
			}
		}
	}
	?>
	<tr>
		<td colspan="2"></td>
		<td colspan="2">Total : <?= $total_price ?></td>
	</tr>
	<tr>
		<td colspan="4">
			<input type="submit" value="Rafraichir"/>
			<input type="hidden" name="action" value="refresh"/>
		</td>
	</tr>
</table>
</form>
</div>
<?php include_once ROOT . "/private/templates/footer.php"; ?>
</body>
</html>
