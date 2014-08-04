//This is for the expanding and collapsing tree
$(".tree li:has(ul)").addClass("parent").click(function(event) {
	$(this).toggleClass("open");
	event.stopPropagation();
});

