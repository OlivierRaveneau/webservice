 <!DOCTYPE html>
<html>
<head>
<title>Client PizzaStore</title>
<script src="jquery-3.2.1.min.js"></script>
</head>
<body>
<h1>Client PizzaStore</h1>
<h2>Request</h2>
<div>
<p>
<button id="get">GET</button>
<button id="post">POST</button>
<button id="delete">DELETE</button>
</p>
<p><label for="url">URL : </label><input id="url" type="text" name="" value="http://localhost.webservice/v2/pizzas"></p>
<p>
<label for="json">JSON : </label><br>
<textarea id="json" name="" rows="10" cols="30">
{"name":"jambon","status":"à emporter"}
</textarea>
</p>
</div>
<h2>Result</h2>
<div id="result"></div>
<script type="text/javascript">
$('#get').click(function(){
	var url = $('#url').val();
	$.get( url, function(data) {
  	$("#result").html(data);
	}, 'html');

	return false;
});
$('#post').click(function(){
	var url = $('#url').val();
	var json = $('#json').val();
	$.post( url, json, function(data) {
		console.log(data);
  	$("#result").html(data);
	}, 'html');

	return false;
});
$('#delete').click(function(){
	var url = $('#url').val();
	$.ajax({
		"method": "DELETE",
		"url": url
	}).done(function(data) {
		$("#result").html(data);
	});

	return false;
});

</script>
</body>
</html>
