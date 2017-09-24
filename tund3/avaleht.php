<?php
	//Muutujad
	$myName = "Kevin";
	$myFamilyName = "Kodasma";
	$practiceStarted = date("d.m.Y") ." " ."8.15";
	$myAge = 0;
	$myBirthYear;
	$myLoginEmail;
	$mySignupFirstName;
	$mySignupFamilyName;
	$mySignupEmail;
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
	
	if(isset($_POST["loginEmail"])){
		$myLoginEmail = $_POST["loginEmail"];
	}
	
	if(isset($_POST["signupFirstName"])){
		$mySignupFirstName = $_POST["signupFirstName"];
	}
	
	if(isset($_POST["signupLastName"])){
		$mySignupLastName = $_POST["signupLastName"];
	}
	
	if(isset($_POST["signupEmail;"])){
		$mySignupEmail; = $_POST["signupEmail;"];
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
	
	<h2>Sisse logimine</h2>
	<p>Sisselogimiseks sisestage oma kasutajanimi ja parool</p>
	<form method="POST">
		<label>Teie kasutajanimi või e-mail:</label>
		<input name="loginEmail" type="email" value="<?php echo $myLoginEmail; ?>">
		<label>Teie parool:</label>
		<input name="loginPassword" type="password">
		<input id="submitLoginInfo" name="submitLoginInfo" type="submit" value="Kinnita">
	</form>
	<h2>Konto loomine</h2>
	<p>Konto loomiseks sisestage järgnevad andmed</p>
	<form method="POST">
		<label>Teie eesnimi:</label>
		<input name="signupFirstName" type="text" value="<?php echo $mySignupFirstName; ?>">
		<label>Teie perenimi:</label>
		<input name="signupFamilyName" type="text" value="<?php echo $mySignupFamilyName; ?>">
		<label>Teie sugu:</label>
		<input type="radio" name="gender" value="1">
		<input type="radio" name="gender" value="2">
		<label>Teie e-mail:</label>
		<input name="signupEmail" tyle="email" value="<?php echo $mySignupEmail; ?>">
		<label>Teie parool:</label>
		<input name="signupPassword" type="password">
		<input id="submitSignInInfo" name="submitSignInInfo" type="submit" value="Kinnita">
	</form>

	<h2>Paar linki</h2>
	<p>Õpime <a href="http://www.tlu.ee" target="_blank">Tallinna Ülikoolis</a></p>
	<p>Minu esimene php leht on <a href="../esimene.php">siin</a></p>
	<p>Minu sõber Kertu teeb veebi <a href="../../../~kippkert/veebiprogrammeerimine">siin</a></p>
	<p>Pilti ülikoolist näeb <a href="photo.php">siin</a></p>
</body>
</html>