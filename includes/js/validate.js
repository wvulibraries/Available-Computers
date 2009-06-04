function validate (form) {
	var errorText = "";
	
	switch (form) {
		
		case 'add_building':
			errorText = validateAddBuilding();
			break;
			
		case 'edit_buildings':
			errorText = validateEditBuildings();
			break;
			
		case 'library_properties':
			errorText = validateLibraryProperties();
			break;
			
	}
	
	if (errorText == "") {
		return true;
	}
	else {
		if (document.getElementById("errorDisplayModal")) {
			document.getElementById("errorDisplayModal").innerHTML = errorText;
			document.getElementById("errorDisplayModal").style.display = "block";
			document.getElementById("TB_ajaxContent").scrollTop = 0;
		}
		else if (document.getElementById("errorDisplay")) {
			document.getElementById("errorDisplay").innerHTML = errorText;
			document.getElementById("errorDisplay").style.display = "block";
			window.scroll(0,0);
		}
		
		return false;
	}
}



function validateAddBuilding() {
	var errorText = "";
	var buildingName = document.getElementById("building_name").value;
	var numFloors = document.getElementById("num_floors").selectedIndex;
	var floorCode = [];
	var floorName = [];
	
	for (var i = 1; i <= numFloors; i++) {
		floorCode[i] = document.getElementById("floor_code_"+i).value;
		floorName[i] = document.getElementById("floor_name_"+i).value;
	}
	
	if (buildingName == "") {
		errorText += "Please enter a building name.<br />";
	}
	else if (buildingName.length > 50) {
		errorText += "The building name cannot exceed 50 characters.<br />";
	}
	
	if (numFloors == "") {
		errorText += "A building must have at least 1 floor.<br />";
	}
	
	for (var i = 1; i <= numFloors; i++) {
		if (floorCode[i] == "") {
			errorText += "A floor code was left empty.<br />";
			break;
		}
	}
	
	for (var i = 1; i <= numFloors; i++) {
		if (floorName[i] == "") {
			errorText += "A floor name was left empty.<br />";
			break;
		}
	}
	
	return errorText;
}

function validateEditBuildings() {
	var errorText = "";
	var numBuildings = document.getElementById("num_buildings").value;
	var newName;
	var deleteBox;
	var countBlank = 0;
	var countLong = 0;
	
	for (var i = 0; i < numBuildings; i++) {
		newName = document.getElementById("building_"+i).value;
		deleteBox = document.getElementById("delete_building_"+i);
		
		if (deleteBox.checked == false) {
			if (newName.value == "") {
				countBlank += 1;
			}
			else if (newName.length > 50) {
				countLong += 1;
			}
		}
	}
	
	if (countBlank > 0) {
		errorText += "Please enter a building name in all fields that are not being deleted.<br />";
	}
	if (countLong > 0) {
		errorText += "Building names cannot exceed 50 characters.<br />";
	}
	
	return errorText;
}

function validateLibraryProperties() {
	var errorText = "";
	
	// No validation required on this form.
	
	return errorText;
}

