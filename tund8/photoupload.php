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


?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Piltide üles laadimine</title>
	<h1>Piltide üles laadimine</h1>
</head>
<body>
	<p><a href="?logout=1">Logi välja!</a></p>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Vali pilt (Max 2MB):<br><br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br><br>
    <input type="submit" value="Lae Üles" name="submit">
</form>	
</body>

</html>