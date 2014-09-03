$(function(){

	$('#autocomplete').autocomplete({
		serviceUrl:"ajax/search.php",
		onSelect: function(suggestion) {
			console.log(suggestion);
		}
	});
});

$(".clickableRow").click(function() {
		var rowId = this.id;
		var request = $.getJSON("../ajax/buildtree.php", {id : rowId}, function(data) {
			
			
			//populate($("#add"), data);
			//$("[name=submit]", $("#add")).val("Update");
			//$("[name=addmachine]", $("#add")).html("<h3>Update Machine:</h3>");
		});
	});
