<?php
	//require("../../../config.php");
	require("functions.php");
	//echo $serverHost;
	
	//kui on sisseloginud, siis kohe main.php lehele
	if (isset($_SESSION["userId"])){
		header("Location:main.php");
		exit();
	}
	
	$ideaHTML = "";
	
	$signupFirstName = "";
	$signupFamilyName = "";
	$signupEmail = "";
	$gender = "";
	$signupBirthDay = null;
	$signupBirthMonth = null;
	$signupBirthYear = null;
	$signupBirthDate = "";
	$BirthDate = "";
	
	$loginEmailError = "";
	$loginPasswordError = "";
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupBirthDayError = "";
	$signupBirthMonthError = "";
	$signupBirthYearError = "";
	$signupGenderError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	
	$loginEmail = "";
	$notice = "";
	
	$ideaHTML = latestIdea();
	
	//kas logitakse sisse
	if (isset($_POST["loginButton"])){
		
		//kas on kasutajanimi sisestatud
		if (isset ($_POST["loginEmail"])){
			if (empty ($_POST["loginEmail"])){
				$loginEmailError ="NB! Ilma selleta ei saa sisse logida!";
			} else {
				$loginEmail = $_POST["loginEmail"];
			}
		}
		if(!empty($loginEmail) and !empty($_POST["loginPassword"])){
			//echo "Login sisse!";
			//kutsun sisselogimise funktsiooni
			$notice = signIn($loginEmail, $_POST["loginPassword"]);
		}
	}//if loginButton
	
	
	if (isset ($_POST["loginPassword"])){
		if (empty ($_POST["loginPassword"])){
			$loginPasswordError = "Parool on sisestamata!";
		} else {
			$loginPassword = $_POST["loginPassword"];
		}
	}
	
	//Kõiki kasutaja loomise sisestusi kontrollitakse vaid, kui on vastavat nuppu klikitud
	if(isset($_POST["signUpButton"]) and $_POST["signUpButton"] == "Loo kasutaja"){
	
	//kontrollime, kas kirjutati eesnimi
	if (isset ($_POST["signupFirstName"])){
		if (empty ($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFirstName = test_input($_POST["signupFirstName"]);
		}
	}
	
	//kontrollime, kas kirjutati perekonnanimi
	if (isset ($_POST["signupFamilyName"])){
		if (empty ($_POST["signupFamilyName"])){
			$signupFamilyNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFamilyName = test_input($_POST["signupFamilyName"]);
		}
	}
	
	//kas sünnipäev on sisestatud
	if (isset ($_POST["signupBirthDay"])){
		$signupBirthDay = $_POST["signupBirthDay"];
		//echo $signupBirthDay;
	}
	
	//kas sünnikuu on sisestatud
	if (isset ($_POST["signupBirthMonth"])){
		$signupBirthMonth = intval($_POST["signupBirthMonth"]);
	}
	
	//kas sünniaasta on sisestatud
	if (isset ($_POST["signupBirthYear"])){
		$signupBirthYear = $_POST["signupBirthYear"];
		//echo $signupBirthYear;
	}
	
	//kui sünnikuupäev on sisestatud, siis kontrollime, kas valiidne
	if (isset($_POST["signupBirthDay"]) and isset($_POST["signupBirthMonth"]) and isset($_POST["signupBirthYear"])){
		if (checkdate(intval($_POST["signupBirthMonth"]), intval($_POST["signupBirthDay"]), intval($_POST["signupBirthYear"]))){
			$BirthDate = date_create($_POST["signupBirthMonth"] ."/" .$_POST["signupBirthDay"] ."/" .$_POST["signupBirthYear"]);
			$signupBirthDate = date_format($BirthDate, "Y-m-d");
		} else {
			$signupBirthDayError = "Viga sünnikuupäeva sisestamisel!";
		}
	}
	
	//kontrollime, kas kirjutati kasutajanimeks email
	if (isset ($_POST["signupEmail"])){
		if (empty ($_POST["signupEmail"])){
			$signupEmailError ="NB! Väli on kohustuslik!";
		} else {
			//kutsun välja sisestuse kontrolli funktsiooni
			$signupEmail = test_input($_POST["signupEmail"]);
			$signupEmail = filter_var($signupEmail, FILTER_SANITIZE_EMAIL);
			if(!filter_var($signupEmail, FILTER_VALIDATE_EMAIL)){
				$signupEmailError ="NB! E-posti aadress ei ole nõutud kujul!";
			}
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
	
	//UUE KASUTAJA ANDMEBAASI KIRJUTAMINE, kui kõik on olemas
	if (empty($signupFirstNameError) and empty($signupFamilyNameError) and empty($signupBirthDayError) and empty($signupGenderError) and empty($signupEmailError)
		and empty($signupPasswordError)){
			echo "Hakkan salvestama!";
			//krüpteerin parooli
			$signupPassword = hash("sha512", $_POST["signupPassword"]);
			//echo "\n Parooli " .$_POST["signupPassword"] ." räsi on:". $signupPassword;
			//kutsume välja kasutaja salvestamise funktsiooni
			signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		
	}
	
	}//if kui oli vajutatud nuppu "Loo kasutaja"
	
	//Tekitame sünnipäeva valiku
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
	$signupDaySelectHTML.= '</select>' ."\n";
	
	//Tekitame sünnikuu valiku
	$signupMonthSelectHTML = "";
	$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni",
	"juuli", "august", "september", "oktoober", "november", "detsember"];
	$signupMonthSelectHTML .= '<select name="signupBirthMonth">' ."\n";
	$signupMonthSelectHTML .= '<option value="" selected disabled>Kuu</option>' ."\n";
	foreach ($monthNamesEt as $key=>$month){
		if ($key + 1 === $signupBirthMonth){
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'"selected>' .$month .'</option>' ."\n";
		}
		else {
		}
		$signupMonthSelectHTML .= '<option value="' .($key + 1) .'">' .$month .'</option>' ."\n";
	}
	$signupMonthSelectHTML .= '</select>' ."\n";
	
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
	$signupYearSelectHTML.= '</select>' ."\n";
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Sisselogimine või uue kasutaja loomine</title>
</head>
<body>
	<h1>Heade mõtete veeb</h1>
	<p>Värskeim hea mõte: <span><?php echo $ideaHTML; ?></span></p>
	<h2>Logi sisse!</h2>
	<p>Siin harjutame sisselogimise funktsionaalsust.</p>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Kasutajanimi (E-post): </label><br>
		<input name="loginEmail" type="email" value="<?php echo $loginEmail; ?>">
		<span><?php echo $loginEmailError; ?></span>
		<br><br>
		<input name="loginPassword" placeholder="Salasõna" type="password">
		<span><?php echo $loginPasswordError; ?></span>
		<br><br>
		<input name="loginButton" type="submit" value="Logi sisse"><span><?php echo $notice; ?></span>
	</form>
	
	<h2>Loo kasutaja</h2>
	<p>Kui pole veel kasutajat....</p>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Eesnimi:</label>
		<input name="signupFirstName" type="text" value="<?php echo $signupFirstName; ?>">
		<span><?php echo $signupFirstNameError; ?></span>
		<br>
		<label>Perekonnanimi:</label>
		<input name="signupFamilyName" type="text" value="<?php echo $signupFamilyName; ?>">
		<span><?php echo $signupFamilyNameError; ?></span>
		<br><br>
		<label>Sisesta oma sünnikuupäev:</label>
		<?php
			echo $signupDaySelectHTML;
			echo $signupMonthSelectHTML;
			echo $signupYearSelectHTML;
		?>
		<span><?php echo $signupBirthDayError; ?></span>
		
		<br><br>
		<label>Sugu:</label><span>
		<br>
		<input type="radio" name="gender" value="1" <?php if ($gender == "1") {echo 'checked';} ?>><label>Mees</label> <!-- Kõik läbi POST'i on string!!! -->
		<input type="radio" name="gender" value="2" <?php if ($gender == "2") {echo 'checked';} ?>><label>Naine</label>
		<span><?php echo $signupGenderError; ?></span>
		<br><br>
		
		<label>Kasutajanimi (E-post):</label><br>
		<input name="signupEmail" type="email" value="<?php echo $signupEmail; ?>">
		<span><?php echo $signupEmailError; ?></span>
		<br><br>
		<input name="signupPassword" placeholder="Salasõna" type="password">
		<span><?php echo $signupPasswordError; ?></span>
		<br><br>

		
		<input name="signUpButton" type="submit" value="Loo kasutaja">
	</form>
		
</body>
</html>