function displayRows(select, display) {
	
	var output = "";
	var num = select.value;
	
	output += "<table>\n";
	output += "<tr>\n";
	output += "<td>Floor Code (ex: g)</td>\n";
	output += "<td>Floor Name (ex: Ground)</td>\n";
	output += "</tr>\n";
	
	for (var i = 1; i <= num; i++) {
		output += "<tr>\n";
		output += "<td><input type=\"text\" id=\"floor_code_"+i+"\" name=\"floor_code_"+i+"\" class=\"floorCodeInput\" /></td>\n";
		output += "<td><input type=\"text\" id=\"floor_name_"+i+"\" name=\"floor_name_"+i+"\" class=\"floorNameInput\" /></td>\n";
		output += "</tr>\n";
	}
	
	output += "</table>\n";
	
	document.getElementById(display).innerHTML = output;
	
}


