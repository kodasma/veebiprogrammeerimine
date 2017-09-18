<?php
	//Muutujad
	$myName = "Kevin";
	$myFamilyName = "Kodasma";
	$practiceStarted = date("d.m.Y") ." " ."8.15";
	
	//echo strtotime($practiceStarted);
	//echo strtotime("now");
	$timePassed = round((strtotime("now") - strtotime($practiceStarted))/60);
	echo $timePassed;
	
	$hourNow = date("H");
	$partOfDay = "";
	
	if ($hourNow < 8){
		$partOfDay = "varane hommik";
	}
	if ($hourNow >= 8 and $hourNow < 16){
		$partOfDay = "koolipäev";
	}
	if ($hourNow >= 16){
		$partOfDay = "vaba aeg";
	}
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
	
	<h2>Absoluutselt</h2>
	<p>Aeg on uueks linnapeaks.</p>
	
	<?php
		echo "<p>Täna on vastik ilm!</p>";
		echo "<p>Täna on ";
		echo date("d.m.Y");
		echo ".</p>";
		echo "<p>Lehe laadimise hetkel oli kell: " .date("H:i:s") ."</p>";
		echo "Praegu on " .$partOfDay .".";
	?>
	<p>PHP käivitatakse lehe laadimisel ja siis tehakse kogu töö ära. 
	Hiljem, kui vaja midagi jälle "kalkuleerida", siis laetakse kogu leht uuesti.</p>
	<?php
		echo "<p>Lehe autori täisnimi on: " .$myName ." " .$myFamilyName .".</p>";
	?>
	</body>
</html>