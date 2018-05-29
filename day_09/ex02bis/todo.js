$(document).ready(init);

function init() {
	displayToDoList();
	var newFromInputButton = $("#new-from-input");
	var newButton = $("#new");
	var newInput = $("#new-todo");

	newFromInputButton.on("click", function(){
		if (newInput.hasClass("active")) {
			newInput.removeClass("active");
			newFromInputButton.removeClass("active");
		}
		else {
			newInput.focus();
			newInput.addClass("active");
			newFromInputButton.addClass("active");
			newInput.on("keydown", function(e){
				if(e.keyCode == 13)
					addElemFromInput();
			});
		}
	});

	newButton.on("click", function(){
		var newToDoName = prompt("Add a task to your to-do list");
		if (newToDoName !== null) {
			newToDoName = newToDoName.trim();
		}
		else
			return;
	    if (newToDoName.length > 0 && newToDoName.indexOf(';') == -1 && newToDoName.indexOf('=') == -1) {
	        var key = setCookie(newToDoName);
			insertNewToDoElement(key, newToDoName);
		} else if (newToDoName != "") {
			alert("Invalid input: forbidden semicolon and equal symbols");
		}
	});
}

function displayToDoList() {
	var allToDo = document.cookie.split(";");
	for (var i = 0 ; i < allToDo.length ; i++) {
		var keyval = allToDo[i].trim().split("=");
		if (keyval != "")
			insertNewToDoElement(keyval[0], keyval[1]);
	}
}

function getCookie(name) {
	var str = "; " + document.cookie;
	var parts = str.split("; " + name + "=");
	if (parts.length == 2)
		parts = parts.pop().split(";").shift();
	else
		parts = null;
	return (parts);
}


function setCookie(value) {
	var tmp = new Date();
	tmp = tmp.setMonth(tmp.getMonth() + 1);
	var expiry = new Date(tmp).toUTCString();

	var key = 0;
	while (getCookie(key.toString()) != null) {
		key++;
	}

	document.cookie = key + "=" + value + "; expires=" + expiry + "; path=/;";
	return (key);
}

function insertNewToDoElement(key, value) {
	var list = $("#ft_list");
	var newToDo = $(document.createElement("DIV"));
    newToDo.attr("id", key);
    newToDo.addClass("list-elem");
    newToDo.prepend(value);
	list.prepend(newToDo);
	
	newToDo.on("click", function(e){
		var confirmation;
	    if (confirm("Do you really want to delete the to-do '" + value + "'")) {
			delCookie(e.target.id);
			e.target.remove();
	    }
	});
	return;
}

function delCookie(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
    return;
};

function addElemFromInput() {
	var newToDoName = $.trim($("#new-todo").val());
	if (newToDoName != "" &&
		newToDoName.indexOf(';') == -1 && newToDoName.indexOf('=') == -1) {
		var key = setCookie(newToDoName);
		insertNewToDoElement(key, newToDoName);
		$("#new-todo").val("");
	} else if (newToDoName != "") {
		alert("Invalid input: forbidden semicolon and equal symbols");
	}
}