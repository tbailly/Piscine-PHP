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
	        setToDo(newToDoName).then(
				function(key) {
					insertNewToDoElement(key, newToDoName);
				}
			);
		} else if (newToDoName != "") {
			alert("Invalid input: forbidden semicolon and equal symbols");
		}
	});
}

function displayToDoList() {
	$.ajax({
	    url: "./select.php",
	    dataType: "text",
	    timeout: 20000,
	    success: function(allToDo) {
	    	allToDo = allToDo.trim().split(";");
			for (var i = 0 ; i < allToDo.length ; i++) {
				var keyval = allToDo[i].trim().split("=");
				if (keyval != "")
					insertNewToDoElement(keyval[0], keyval[1]);
			}
	    }
	});
}

async function setToDo(value) {
	return new Promise(function(resolve){
		$.ajax({
		    url: "./insert.php",
		    dataType: "text",
		    type: "GET",
		    timeout: 20000,
		    data: {"toDo": value},
		    success: function(key) {
		    	if (key != "WRONG")
		    		resolve(key);
		    	else
		    		alert("Keep using regular character while doing your to-do");
		    }
		});
	});
}

async function delToDo(key) {
	return new Promise(function(resolve){
		$.ajax({
		    url: "./delete.php",
		    dataType: "text",
		    type: "GET",
		    timeout: 20000,
		    data: {"key": key},
		    success: function(res) {
		    	resolve(res);
		    }
		});
	});
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
			delToDo(e.target.id);
			e.target.remove();
	    }
	});
	return;
}

function addElemFromInput() {
	var newToDoName = $.trim($("#new-todo").val());
	if (newToDoName != "" &&
		newToDoName.indexOf(';') == -1 && newToDoName.indexOf('=') == -1) {
		setToDo(newToDoName).then(
			function(key) {
				insertNewToDoElement(key, newToDoName);
				$("#new-todo").val("");
			}
		);
	} else if (newToDoName != "") {
		alert("Invalid input: forbidden semicolon and equal symbols");
	}
}