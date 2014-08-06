$(function(){
  var currencies = [
    { value: 'Afghan afghani', data: 'AFN' },
    { value: 'Albanian lek', data: 'ALL' },
    { value: 'Algerian dinar', data: 'DZD' },
    { value: 'European euro', data: 'EUR' },
    { value: 'Angolan kwanza', data: 'AOA' },
    { value: 'East Caribbean dollar', data: 'XCD' },
    { value: 'Vietnamese dong', data: 'VND' },
    { value: 'Yemeni rial', data: 'YER' },
    { value: 'Zambian kwacha', data: 'ZMK' },
    { value: 'Zimbabwean dollar', data: 'ZWD' },
  ];

//This is for the auto complete box to search for parts
$('#autocomplete').autocomplete({
  lookup: currencies,
  onSelect: function (suggestion) {
  // some function here
  }
});

// setup autocomplete function pulling from currencies[] array
$('#autocomplete').autocomplete({
  lookup: currencies,
  onSelect: function (suggestion) {
    var thehtml = '<strong>Currency Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;
    $('#outputcontent').html(thehtml);
  }
});

//This is for the expanding and collapsing tree
$(".tree li:has(ul)").addClass("parent").click(function(event) {
	$(this).toggleClass("open");
	event.stopPropagation();
});



