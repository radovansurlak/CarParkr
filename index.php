<!DOCTYPE html>
<html>
<head>
	<title>CarParkr - See live data</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<img src="logo.png" alt="logo">
	</header>

<main>
	<?php
		include("render.php");
	?>
</main>

<script type="text/javascript">
		window.setInterval(function(){
	  	$("main").load("render.php");
		}, 30000);
</script>


</body>
</html>
