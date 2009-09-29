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
			//return false;
			break;
			
		case 'create_announcement':
			errorText = validateNewAnnouncement();
			break;
			
		case 'edit_announcement':
			errorText = validateEditAnnouncement();
			break;
			
		case 'edit_normal_hours':
			errorText = validateNormalHours();
			break;
			
		case 'add_event':
		case 'edit_event':
			errorText = validateEvent();
			break;
			
		case 'add_series':
		case 'edit_series':
			errorText = validateSeries();
			break;
			
		case 'delete_event':
			errorText = validateDeleteEvent();
			break;
			
		case 'revert_event':
			errorText = validateRevertEvent();
			break;
			
		case 'delete_series':
			errorText = validateDeleteSeries();
			break;
			
		case 'commit_hours':
			errorText = validateCommitChanges();
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

function validateNewAnnouncement() {
	var errorText = "";
	var announcement = document.getElementById("message");
	
	if (announcement.value == "") {
		errorText += "Please enter an announcement.<br />";
	}
	
	return errorText;
}

function validateEditAnnouncement() {
	var errorText = "";
	var formName = document.getElementById("editAnnouncement");
	var announcement;
	
	for (var i = 0; i < formName.elements.length; i++) {
		announcement = formName.elements[i];
		if (announcement.name.substr(0,8) == "message_") {
			if (announcement.value == "") {
				errorText += "An announcement was left blank.<br />";
			}
		}
	}
	
	return errorText;
}

function validateNormalHours() {
	var errorText = "";
	var month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
	var weekday = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

	var startHour = [];
	var startMinute = [];
	var startTime = [];
	var endHour = [];
	var endMinute = [];
	var endTime = [];
	
	for (var i = 0; i < 7; i++) {
		hoursType = document.getElementById("hoursType_"+i).value;
		startHour = document.getElementById("startHour_"+i).value;
		startMinute = document.getElementById("startMinute_"+i).value;
		startTime = document.getElementById("startTime_"+i).value;
		endHour = document.getElementById("endHour_"+i).value;
		endMinute = document.getElementById("endMinute_"+i).value;
		endTime = document.getElementById("endTime_"+i).value;
		
		switch (hoursType) {
			case "normal":
				if (startHour == "" || startMinute == "" || startTime == "" || endHour == "" || endMinute == "" || endTime == "") {
					errorText += "Please enter a complete open and close time for "+weekday[i]+".<br />";
				}
				break;
				
			case "no_open":
				if (endHour == "" || endMinute == "" || endTime == "") {
					errorText += "Please enter a complete close time for "+weekday[i]+".<br />";
				}
				break;
				
			case "no_close":
				if (startHour == "" || startMinute == "" || startTime == "") {
					errorText += "Please enter a complete open time for "+weekday[i]+".<br />";
				}
				break;
				
			case "":
				errorText += "You must select a type for "+weekday[i]+".<br />";
				break;
		}
	}
	
	var startDateMonth = document.getElementById("startDateMonth").value;
	var startDateDate = document.getElementById("startDateDate").value;
	var startDateYear = document.getElementById("startDateYear").value;
	var lastDayOfStartMonth = new Date(startDateYear, startDateMonth,0).getDate();
	
	var endDateMonth = document.getElementById("endDateMonth").value;
	var endDateDate = document.getElementById("endDateDate").value;
	var endDateYear = document.getElementById("endDateYear").value;
	var lastDayOfEndMonth = new Date(endDateYear, endDateMonth,0).getDate();
	
	if (startDateDate > lastDayOfStartMonth) {
		errorText += "Invalid Date: "+month[startDateMonth-1]+" only has "+lastDayOfStartMonth+" days.<br />";
	}
	if (endDateDate > lastDayOfEndMonth) {
		errorText += "Invalid Date: "+month[endDateMonth-1]+" only has "+lastDayOfEndMonth+" days.<br />";
	}
	
	var startDate = new Date(startDateYear,startDateMonth-1,startDateDate);
	var endDate = new Date(endDateYear,endDateMonth-1,endDateDate);
	
	var startDateTime = startDate.getTime()/1000.0;
	var endDateTime = endDate.getTime()/1000.0;

	if (startDateTime > endDateTime) {
		errorText += "The start date must occur before the end date.<br />";
	}
	
	var dateRanges = document.getElementById('date_ranges').value;
	var rangeStart = [];
	var rangeEnd = [];
	
	var ranges = dateRanges.split("|");
	for (var i = 0; i < ranges.length; i++) {
		rangeStart[i] = ranges[i].substr(0,10);
		rangeEnd[i] = ranges[i].substr(11,10);
		
		if ((rangeStart[i] <= startDateTime && startDateTime <= rangeEnd[i]) || (rangeStart[i] <= endDateTime && endDateTime <= rangeEnd[i]) || (startDateTime <= rangeStart[i] && rangeEnd[i] <= endDateTime)) {
			errorText += "Date Conflict: Check the start and end dates to make sure there are no normal hours declared in the range.<br />";
			break;
		}
	}
	

	return errorText;
}

function validateEvent() {
	var errorText = "";
	var label = document.getElementById("e_label");

	if (label.value.length > 30) {
		errorText += "The label cannot exceed 30 characters.<br />";
	}
	
	var hoursType = document.getElementById("e_hoursType").value;
	var startHour = document.getElementById("e_startHour").value;
	var startMinute = document.getElementById("e_startMinute").value;
	var startTime = document.getElementById("e_startTime").value;
	var endHour = document.getElementById("e_endHour").value;
	var endMinute = document.getElementById("e_endMinute").value;
	var endTime = document.getElementById("e_endTime").value;
		
	switch (hoursType) {
		case "normal":
			if (startHour == "" || startMinute == "" || startTime == "" || endHour == "" || endMinute == "" || endTime == "") {
				errorText += "Please enter a complete open and close time.<br />";
			}
			break;
			
		case "no_open":
			if (endHour == "" || endMinute == "" || endTime == "") {
				errorText += "Please enter a complete close time.<br />";
			}
			break;
			
		case "no_close":
			if (startHour == "" || startMinute == "" || startTime == "") {
				errorText += "Please enter a complete open time.<br />";
			}
			break;
			
		case "":
			errorText += "You must select a type.<br />";
			break;
	}
	
	return errorText;
}

function validateSeries() {
	var errorText = "";
	var month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
	var weekday = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

	var label = document.getElementById("s_label");
	if (label.value.length > 30) {
		errorText += "The label cannot exceed 30 characters.<br />";
	}
	
	var hoursType = document.getElementById("s_hoursType").value;
	var startHour = document.getElementById("s_startHour").value;
	var startMinute = document.getElementById("s_startMinute").value;
	var startTime = document.getElementById("s_startTime").value;
	var endHour = document.getElementById("s_endHour").value;
	var endMinute = document.getElementById("s_endMinute").value;
	var endTime = document.getElementById("s_endTime").value;
		
	switch (hoursType) {
		case "normal":
			if (startHour == "" || startMinute == "" || startTime == "" || endHour == "" || endMinute == "" || endTime == "") {
				errorText += "Please enter a complete open and close time.<br />";
			}
			break;
			
		case "no_open":
			if (endHour == "" || endMinute == "" || endTime == "") {
				errorText += "Please enter a complete close time.<br />";
			}
			break;
			
		case "no_close":
			if (startHour == "" || startMinute == "" || startTime == "") {
				errorText += "Please enter a complete open time.<br />";
			}
			break;
			
		case "":
			errorText += "You must select a type.<br />";
			break;
	}
	
	var startDateMonth = document.getElementById("s_startDateMonth").value;
	var startDateDate = document.getElementById("s_startDateDate").value;
	var startDateYear = document.getElementById("s_startDateYear").value;
	var lastDayOfStartMonth = new Date(startDateYear,startDateMonth,0).getDate();
	
	var endDateMonth = document.getElementById("s_endDateMonth").value;
	var endDateDate = document.getElementById("s_endDateDate").value;
	var endDateYear = document.getElementById("s_endDateYear").value;
	var lastDayOfEndMonth = new Date(endDateYear,endDateMonth,0).getDate();
	
	if (startDateDate > lastDayOfStartMonth) {
		errorText += "Invalid Start Date: "+month[startDateMonth-1]+" only has "+lastDayOfStartMonth+" days.<br />";
	}
	if (endDateDate > lastDayOfEndMonth) {
		errorText += "Invalid End Date: "+month[endDateMonth-1]+" only has "+lastDayOfEndMonth+" days.<br />";
	}
	
	var d = new Date();
	var todayMonth = d.getMonth();
	var todayDate = d.getDate();
	var todayYear = d.getFullYear();
	
	var startDate = new Date(Date.UTC(startDateYear,startDateMonth-1,startDateDate));
	var endDate = new Date(Date.UTC(endDateYear,endDateMonth-1,endDateDate));
	
	var startDateTime = startDate.getTime()/1000.0;
	var endDateTime = endDate.getTime()/1000.0;
	
	if (endDateTime < startDateTime ) {
		errorText += "The start date must come before the end date.<br />";
	}
	if (endDateTime == startDateTime ) {
		errorText += "A multiple day event must be at least 2 days long.<br />";
	}
	
	return errorText;
}

function validateDeleteEvent() {
	var errorText = "";
	var confirmation = document.getElementById("confirmDeleteEvent");
	
	if (confirmation.checked == false) {
		errorText += "You must confirm that you want to delete this single day event by checking the box below.<br />";
	}
	
	return errorText;
}

function validateRevertEvent() {
	var errorText = "";
	var confirmation = document.getElementById("confirmRevertEvent");
	
	if (confirmation.checked == false) {
		errorText += "You must confirm that you want to revert this event by checking the box below.<br />";
	}
	
	return errorText;
}

function validateDeleteSeries() {
	var errorText = "";
	var confirmation = document.getElementById("confirmDeleteSeries");
	
	if (confirmation.checked == false) {
		errorText += "You must confirm that you want to delete this multiple day event by checking the box below.<br />";
	}
	
	return errorText;
}

function validateCommitChanges() {
	var errorText = "";
	var confirmation = document.getElementById("confirmCommitHours");
	
	if (confirmation.checked == false) {
		errorText += "You must confirm that you want to commit the changes by checking the box below.<br />";
	}
	
	return errorText;
}

