<?php
	require("functions.php");
	
	//kui pole sisseloginud, siis sisselogimise lehele
	if (!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//kui logib välja
	if (isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: login.php");
	}
	
	/*
	while($stmt->fetch()){
		
	}
	*/
?>


<!DOCTYPE html>
<html>


<head>
	<meta charset="utf-8">
	<title>Kevin Kodasma</title>
</head>
<body>
	<h1>Kevin Kodasma</h1>
	<p>See veebileht on loodud veebiprogrammeerimise kursusel ning ei sisalda mingisugust tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja!</a></p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<h2>Kõik süsteemi kasutajad</h2>
	<table border="1" style="border: 1px solid black; border-collapse: collapse">
	<tr>
		<th>Eesnimi</th><th>Perekonnanimi</th><th>E-post</th>
	</tr>
	<tr>
		<td>Laura</td><td>Loora</td><td>laura@loora.ee</td>
	</tr>
	<tr>
		<td>Vladimir</td><td>Putin</td><td>vladimir@putin.ee</td>
	</tr>
	<tr>
		<td>Adolf</td><td>Hitler</td><td>adolf@hitler.ee</td>
	</tr>
	</table>
	
</body>
</html>