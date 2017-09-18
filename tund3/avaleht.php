<?php
	//Muutujad
	$myName = "Kevin";
	$myFamilyName = "Kodasma";
	$practiceStarted = date("d.m.Y") ." " ."8.15";
	$myAge = 0;
	$myBirthYear;
	$myLivedYearsList = "";
	$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni",
	"juuli", "august", "september", "oktoober", "november", "detsember"];
	
	//var_dump($monthNamesEt);
	//echo $monthNamesEt[8];
	
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
	
	//nüüd vaatame, kas ja mida kasutaja sisestas
	if(isset($_POST["yearBirth"])){
		$myBirthYear = $_POST["yearBirth"];
		$myAge = date("Y") - $_POST["yearBirth"];
		
		//tekitame loendi kõigist elatud aastatest
		$myLivedYearsList .= "<ul> \n";
		for($i = $myBirthYear; $i <= date("Y"); $i++){
			$myLivedYearsList .= "<li>" .$i ."</li> \n";
		}
		$myLivedYearsList .= "</ul> \n";
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
		$monthIndex = date("n") - 1;		//n on kuu ilma lisanullita ees
		echo date("d.") .$monthNamesEt[$monthIndex] .date(" Y");
		echo ".</p>";
		echo "<p>Lehe laadimise hetkel oli kell: " .date("H:i:s") ."</p>";
		echo "Praegu on " .$partOfDay .".";
	?>
	<p>PHP käivitatakse lehe laadimisel ja siis tehakse kogu töö ära. 
	Hiljem, kui vaja midagi jälle "kalkuleerida", siis laetakse kogu leht uuesti.</p>
	<?php
		echo "<p>Lehe autori täisnimi on: " .$myName ." " .$myFamilyName .".</p>";
	?>
	<h2>Vanus</h2>
	<p>Järgnevalt palume sisestada oma sünniaasta</p>
	<form method="POST">
		<label>Teie sünniaasta: </label>
		<input id="yearBirth" name="yearBirth" type="number" min="1900" max="2017" value="<?php echo $myBirthYear; ?>">
		<input id="submitYearBirth" name="submitYearBirth" type="submit" value="Kinnita">
	
	</form>
	<p>Teie vanus on <?php echo $myAge; ?> aastat.</p>
	<?php
		if($myLivedYearsList != ""){
			echo "<h3>Oled elanud järgnevatel aastatel</h3> \n";
			echo $myLivedYearsList;
		}
	?>
	</body>
</html>