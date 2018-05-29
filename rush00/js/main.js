function updateCart(elem)
{
	console.log("CART TO UPDATE");
	buttonProductId = elem.getAttribute("product_data");
	var allQuantities = document.getElementsByClassName("quantity");
	for (var i = 0 ; i < allQuantities.length ; i++)
	{
		var productId = allQuantities[i].name.split("_")[0];
		if (productId == buttonProductId)
		{
			quantity = allQuantities[i].value;
			url = "./index.php?action=ajout&l=" + productId + "&q=" + quantity;
			window.open(url, "_self");
		}
	}
}