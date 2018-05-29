document.addEventListener("DOMContentLoaded", init);

function init() {
	console.log("init");
	document.cookie = "name=oeschger";
	document.cookie = "favorite_food=tripe";
	
}
function alertCookie() {
  alert(document.cookie);
}

// setCookie("oui", "lol");
// console.log(getCookie("oui"));

// function getCookie(cname) {
// 	console.log(document.cookie);
// }

// function setCookie(key, value) {
// 	var tmp = new Date();
// 	var tmp = tmp.setMonth(tmp.getMonth() + 1);
// 	var expiry = new Date(tmp).toUTCString();
// 	console.log(key + "=" + value + "; expires=" + expiry + "; path=/;");
// 	document.cookie = key + "=" + value + "; expires=" + expiry + "; path=/;";
// }
