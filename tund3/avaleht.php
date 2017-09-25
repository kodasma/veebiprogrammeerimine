<?php
	//Muutujad
	$myName = "Kevin";
	$myFamilyName = "Kodasma";
	$practiceStarted = date("d.m.Y") ." " ."8.15";
	$myAge = 0;
	$myBirthYear;
	$loginEmail = "";
	$signupFirstName = "";
	$signupFamilyName = "";
	$signupEmail = "";
	
	$signupBirthDay = "";
	$signupBirthMonth = "";
	$signupBirthYear = "";
	
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupBirthDayError = "";
	$signupBirthMonthError = "";
	$signupBirthYearError = "";
	$signupGenderError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	
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
	
	if (isset ($_POST["signupBirthDay"])){
		$signupBirthDay = $_POST["signupBirthDay"];
		//echo $signupBirthDay;
	}
	
	if (isset ($_POST["signupBirthMonth"])){
		$signupBirthMonth = $_POST["signupBirthMonth"];
		//echo $signupBirthMonth;
	}
	
	if (isset ($_POST["signupBirthYear"])){
		$signupBirthYear = $_POST["signupBirthYear"];
		//echo $signupBirthYear;
	}
	
	if (isset ($_POST["signupBirthDay"]) and isset ($_POST["signupBirthMonth"]) and isset ($_POST["signupBirthYear"])){
		if(checkdate (intval($_POST["signupBirthMonth"]), intval($_POST["signupBirthDay"]) , intval($_POST["signupBirthYear"]) )){
			$test = date_create($_POST["signupBirthMonth"] ."/" .$_POST["signupBirthDay"] ."/" .$_POST["signupBirthYear"]);
			//var_dump($test);
			//echo date_format($test, "Y-m-d"); //sellise stringi saadame andmebaasi
			$signupBirthDate = date_format($test, "Y-m-d");
		}
		
	}
	
//kas on kasutajanimi sisestatud
	if (isset ($_POST["loginEmail"])){
		if (empty ($_POST["loginEmail"])){
			$loginEmailError ="NB! Ilma selleta ei saa sisse logida!";
		} else {
			$loginEmail = $_POST["loginEmail"];
		}
	}
	
	//kontrollime, kas kirjutati eesnimi
	if (isset ($_POST["signupFirstName"])){
		if (empty ($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFirstName = $_POST["signupFirstName"];
		}
	}
	
	//kontrollime, kas kirjutati perekonnanimi
	if (isset ($_POST["signupFamilyName"])){
		if (empty ($_POST["signupFamilyName"])){
			$signupFamilyNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFamilyName = $_POST["signupFamilyName"];
		}
	}
	
	//loome kuupäeva valiku
	$signupDaySelectHTML = "";
	$signupDaySelectHTML .= '<select name="signupBirthDay">' ."\n";
	$signupDaySelectHTML .= '<option value="" selected disabled>Päev</option>' ."\n";
	for ($i = 1; $i < 32; $i ++){
		if($i == $signupBirthDay){
			$signupDaySelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupDaySelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ."\n";
		}
		
	}
	$signupDaySelectHTML.= "</select> \n";
	
	
	$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	
	//loon kuu valiku kasutaja loomiseks
	$signupMonthSelectHTML = "";
	$signupMonthSelectHTML .= '<select name="signupBirthMonth">' ."\n";
	$signupMonthSelectHTML .= '<option value="" selected disabled>Kuu</option>' ."\n";
	foreach ($monthNamesEt as $key=>$month){
		if ($key +1 === intval($signupBirthMonth)){ //Kuna oleme ülal algväärtuseks andnud "null", siis kontrollime võrdust koos tüübi kontrolliga
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'" selected>' .$month .'</option>' ."\n";
		} else {
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'">' .$month .'</option>' ."\n";
		}
	}
	$signupMonthSelectHTML .= "</select> \n";
	
	
	
	//echo$signupMonthSelectHTML;
	
	//loome aasta valiku
	$signupYearSelectHTML = "";
	$signupYearSelectHTML .= '<select name="signupBirthYear">' ."\n";
	$signupYearSelectHTML .= '<option value="" selected disabled>Aasta</option>' ."\n";
	$yearNow = date("Y");
	for ($i = $yearNow; $i > 1900; $i --){
		if($i == $signupBirthYear){
			$signupYearSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupYearSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ."\n";
		}
		
	}
	$signupYearSelectHTML.= "</select> \n";
	
	//kontrollime, kas kirjutati kasutajanimeks email
	if (isset ($_POST["signupEmail"])){
		if (empty ($_POST["signupEmail"])){
			$signupEmailError ="NB! Väli on kohustuslik!";
		} else {
			$signupEmail = $_POST["signupEmail"];
		}
	}
	
	if (isset ($_POST["signupPassword"])){
		if (empty ($_POST["signupPassword"])){
			$signupPasswordError = "NB! Väli on kohustuslik!";
		} else {
			//polnud tühi
			if (strlen($_POST["signupPassword"]) < 8){
				$signupPasswordError = "NB! Liiga lühike salasõna, vaja vähemalt 8 tähemärki!";
			}
		}
	}
	
	if (isset($_POST["gender"]) && !empty($_POST["gender"])){ //kui on määratud ja pole tühi
			$gender = intval($_POST["gender"]);
		} else {
			$signupGenderError = " (Palun vali sobiv!) Määramata!";
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
		<label>Teie kasutajanimi või e-mail:</label><br>
		<input name="loginEmail" type="email" value="<?php echo $loginEmail; ?>"><br><br>
		<label>Teie parool:</label><br>
		<input name="loginPassword" type="password"><br>
		<input id="submitLoginInfo" name="submitLoginInfo" type="submit" value="Kinnita">
	</form>
	<h2>Konto loomine</h2>
	<p>Konto loomiseks sisestage järgnevad andmed</p>
	<form method="POST">
		<label>Teie eesnimi:</label><br>
		<input name="signupFirstName" type="text" value="<?php echo $signupFirstName; ?>"><br><br>
		<label>Teie perenimi:</label><br>
		<input name="signupFamilyName" type="text" value="<?php echo $signupFamilyName; ?>"><br><br>
		<label>Sisesta oma sünnikuupäev:</label>
		<?php
			echo $signupDaySelectHTML;
			echo $signupMonthSelectHTML;
			echo $signupYearSelectHTML;
		?><br><br>
		<label>Teie sugu:</label><br>
		<input type="radio" name="gender" value="1"><label>Mees</label><br>
		<input type="radio" name="gender" value="2"><label>Naine</label><br><br>
		<label>Teie e-mail:</label><br>
		<input name="signupEmail" tyle="email" value="<?php echo $signupEmail; ?>"><br><br>
		<label>Teie parool:</label><br>
		<input name="signupPassword" type="password"><br><br>
		<input id="submitSignInInfo" name="submitSignInInfo" type="submit" value="Kinnita">
	</form>

	<h2>Paar linki</h2>
	<p>Õpime <a href="http://www.tlu.ee" target="_blank">Tallinna Ülikoolis</a></p>
	<p>Minu esimene php leht on <a href="../esimene.php">siin</a></p>
	<p>Minu sõber Kertu teeb veebi <a href="../../../~kippkert/veebiprogrammeerimine">siin</a></p>
	<p>Pilti ülikoolist näeb <a href="photo.php">siin</a></p>
</body>
</html>