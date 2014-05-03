$(document).ready(function() {
	$('#hit-button').click(function() {
		location.href = baseUrl + "/game/hit";
	});
	$('#stand-button').click(function() {
		location.href = baseUrl + "/game/stand";
	});
});