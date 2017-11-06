<?php
	require("kontrolltoo_functions.php");
	
	//MUUTUJAD
	$kkFirstName = "";
	$kkFamilyName = "";
	$kkLanguage = "";
	$kkJanuary = "";
	$kkFebruary = "";
	$kkMarch = "";
	$kkApril = "";
	$kkMay = "";
	$kkJune = "";
	$kkJuly = "";
	$kkAugust = "";
	$kkSeptember = "";
	$kkOctober = "";
	$kkNovember = "";
	$kkDecember = "";
	
	$kkFirstNameError = "";
	$kkFamilyNameError = "";
	$kkLanguageError = "";
	$kkJanuaryError = "";
	$kkFebruaryError = "";
	$kkMarchError = "";
	$kkAprilError = "";
	$kkMayError = "";
	$kkJuneError = "";
	$kkJulyError = "";
	$kkAugustError = "";
	$kkSeptemberError = "";
	$kkOctoberError = "";
	$kkNovemberError = "";
	$kkDecemberError = "";
	

	
if(isset($_POST["loginButton"]) and $_POST["loginButton"] == "Sisesta"){

	//kontrollime, kas kirjutati eesnimi
	if (isset ($_POST["kkFirstName"])){
		if (empty ($_POST["kkFirstName"])){
			$kkFirstNameError = "NB! Väli on kohustuslik!";
		} else {
			$kkFirstName = $_POST["kkFirstName"];
		}
	}
	
	//kontrollime, kas kirjutati perekonnanimi
	if (isset ($_POST["kkFamilyName"])){
		if (empty ($_POST["kkFamilyName"])){
			$kkFamilyNameError = "NB! Väli on kohustuslik!";
		} else {
			$kkFamilyName = $_POST["kkFamilyName"];
		}
	}
	
	//kontrollime, kas sisestati keel
	if (isset ($_POST["kkLanguage"])){
		if (empty ($_POST["kkLanguage"])){
			$kkLanguageError = "NB! Väli on kohustuslik!";
		} else {
			$kkLanguage = $_POST["kkLanguage"];
		}
	}
	
	//kontrollime, kas kirjutati kuud
	if (isset ($_POST["kkJanuary"])){
		if (empty ($_POST["kkJanuary"])){
			$kkJanuaryError = "NB! Väli on kohustuslik!";
		} else {
			$kkJanuary = $_POST["kkJanuary"];
		}
	}
	
	if (isset ($_POST["kkFebruary"])){
		if (empty ($_POST["kkFebruary"])){
			$kkFebruaryError = "NB! Väli on kohustuslik!";
		} else {
			$kkFebruary = $_POST["kkFebruary"];
		}
	}
	
	if (isset ($_POST["kkMarch"])){
		if (empty ($_POST["kkMarch"])){
			$kkMarchError = "NB! Väli on kohustuslik!";
		} else {
			$kkMarch = $_POST["kkMarch"];
		}
	}
	
	if (isset ($_POST["kkApril"])){
		if (empty ($_POST["kkApril"])){
			$kkAprilError = "NB! Väli on kohustuslik!";
		} else {
			$kkApril = $_POST["kkApril"];
		}
	}
	
	if (isset ($_POST["kkMay"])){
		if (empty ($_POST["kkMay"])){
			$kkMayError = "NB! Väli on kohustuslik!";
		} else {
			$kkMay = $_POST["kkMay"];
		}
	}
	
	if (isset ($_POST["kkJune"])){
		if (empty ($_POST["kkJune"])){
			$kkJuneError = "NB! Väli on kohustuslik!";
		} else {
			$kkJune = $_POST["kkJune"];
		}
	}
	
	if (isset ($_POST["kkJuly"])){
		if (empty ($_POST["kkJuly"])){
			$kkJulyError = "NB! Väli on kohustuslik!";
		} else {
			$kkJuly = $_POST["kkJuly"];
		}
	}
	
	if (isset ($_POST["kkAugust"])){
		if (empty ($_POST["kkAugust"])){
			$kkAugustError = "NB! Väli on kohustuslik!";
		} else {
			$kkAugust = $_POST["kkAugust"];
		}
	}
	
	if (isset ($_POST["kkSeptember"])){
		if (empty ($_POST["kkSeptember"])){
			$kkSeptemberError = "NB! Väli on kohustuslik!";
		} else {
			$kkSeptember = $_POST["kkSeptember"];
		}
	}
	
	if (isset ($_POST["kkOctober"])){
		if (empty ($_POST["kkOctober"])){
			$kkOctoberError = "NB! Väli on kohustuslik!";
		} else {
			$kkOctober = $_POST["kkOctober"];
		}
	}
	
	if (isset ($_POST["kkNovember"])){
		if (empty ($_POST["kkNovember"])){
			$kkNovemberError = "NB! Väli on kohustuslik!";
		} else {
			$kkNovember = $_POST["kkNovember"];
		}
	}
	
	if (isset ($_POST["kkDecember"])){
		if (empty ($_POST["kkDecember"])){
			$kkDecemberError = "NB! Väli on kohustuslik!";
		} else {
			$kkDecember = $_POST["kkDecember"];
		}
	}
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Andmete sisestamine</title>
</head>
<body>
	<h1>Andmete Sisestamine</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Eesnimi: </label><br>
		<input name="firstName" type="text" value="<?php echo $kkFirstName; ?>">
		<span><?php echo $kkFirstNameError; ?></span>
		<br><br>
		<label>Perekonnanimi: </label><br>
		<input name="lastName" type="text" value="<?php echo $kkFamilyName; ?>">
		<span><?php echo $kkFamilyNameError; ?></span>
		<br><br>
		<label>Keel: </label><br>
		<input name="language" type="text" value="<?php echo $kkLanguage; ?>">
		<span><?php echo $kkLanguageError; ?></span>
		<br><h3>Kirjuta vastavad kuud valitud keeles:</h3>
		<label>Jaanuar: </label><br>
		<input name="language" type="text" value="<?php echo $kkJanuary; ?>">
		<span><?php echo $kkJanuaryError; ?></span><br>
		<label>Veebruar: </label><br>
		<input name="language" type="text" value="<?php echo $kkFebruary; ?>">
		<span><?php echo $kkFebruaryError; ?></span><br>
		<label>Märts: </label><br>
		<input name="language" type="text" value="<?php echo $kkMarch; ?>">
		<span><?php echo $kkMarchError; ?></span><br>
		<label>Aprill: </label><br>
		<input name="language" type="text" value="<?php echo $kkApril; ?>">
		<span><?php echo $kkAprilError; ?></span><br>
		<label>Mai: </label><br>
		<input name="language" type="text" value="<?php echo $kkMay; ?>">
		<span><?php echo $kkMayError; ?></span><br>
		<label>Juuni: </label><br>
		<input name="language" type="text" value="<?php echo $kkJune; ?>">
		<span><?php echo $kkJuneError; ?></span><br>
		<label>Juuli: </label><br>
		<input name="language" type="text" value="<?php echo $kkJuly; ?>">
		<span><?php echo $kkJulyError; ?></span><br>
		<label>August: </label><br>
		<input name="language" type="text" value="<?php echo $kkAugust; ?>">
		<span><?php echo $kkAugustError; ?></span><br>
		<label>September: </label><br>
		<input name="language" type="text" value="<?php echo $kkSeptember; ?>">
		<span><?php echo $kkSeptemberError; ?></span><br>
		<label>Oktoober: </label><br>
		<input name="language" type="text" value="<?php echo $kkOctober; ?>">
		<span><?php echo $kkOctoberError; ?></span><br>
		<label>November: </label><br>
		<input name="language" type="text" value="<?php echo $kkNovember; ?>">
		<span><?php echo $kkNovemberError; ?></span><br>
		<label>Detsember: </label><br>
		<input name="language" type="text" value="<?php echo $kkDecember; ?>">
		<span><?php echo $kkDecemberError; ?></span><br><br>
		<input name="loginButton" type="submit" value="Sisesta">
		<p><a href="sisestatudkuud.php">Sisestatud andmed</a></p>
	</form>
</body>
</html>
