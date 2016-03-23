$("#platformRadio").change(function() {
    var _selection = $(":input:checked").attr("id");
	var table = document.getElementById("buildsTable");
	if (table) {
		// Skip the first row, it's the headers row
		for(var i = 1; i < table.rows.length; i++){
			var row = table.rows[i];
			row.style.display = _selection === 'all' ? '' : (row.id === _selection? '' : 'none');
		}
	}
});