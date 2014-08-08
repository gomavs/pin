$(function(){

	$('#autocomplete').autocomplete({
		serviceUrl:"ajax/search.php",
		onSelect: function(suggestion) {
			console.log(suggestion);
		}
	});
	


});