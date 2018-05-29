<?php

session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/cart_functions.php";
include_once ROOT . "/private/models/products_categories_functions.php";

$product_number = strval(product_count());
$all_products = get_all_products();
$total_price = total_price($all_products);
?>

<header>
	<ul>
		<li><a href="<?php echo URL ?>/index.php">Accueil</a></li>
		<li><a href="<?php echo URL ?>/admin">Administration</a></li>
		<li>
			<a href="<?php echo URL ?>/pages/panier/panier.php">
				Panier(<?= $product_number ?>) Total : <?= $total_price ?>€
			</a>
		</li>

	<?php if (($login = $_SESSION["logged_on_user"]) !== NULL && ($login = $_SESSION["logged_on_user"]) !== "") { ?>

		<li><a href="<?php echo URL ?>/pages/account">Profil</a></li>
		<li><a href="<?php echo URL ?>/pages/logout">Déconnexion</a></li>
		<li class="welcome"> Bienvenue <?= $login ?>!</a></li>

	<?php } else { ?>

		<li><a href="<?php echo URL ?>/pages/login">Connexion</a></li>
		<li><a href="<?php echo URL ?>/pages/signup">S'inscrire</a></li>

	<?php } ?>

	</ul>
</header>
