<?php
	require("../../config.php");
	$database = "if17_kodakevi";

	session_start();
	
	$mysqli = "";
	$stmt = "";
	
	//kasutaja info salvestamise funktsioon
	function saveInfo($kkFirstName, $kkFamilyName, $kkLanguage, $kkJanuary, $kkFebruary, $kkMarch, $kkApril, $kkMay, $kkJune, $kkJuly, $kkAugust, $kkSeptember, $kkOctober, $kkNovember, $kkDecember){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO vptestmonths (firstname, lastname, language, january, february, march, april, may, june, july, august, september, october, november, december) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("sssssssssssssss", $kkFirstName, $kkFamilyName, $kkLanguage, $kkJanuary, $kkFebruary, $kkMarch, $kkApril, $kkMay, $kkJune, $kkJuly, $kkAugust, $kkSeptember, $kkOctober, $kkNovember, $kkDecember);
		if($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga:" .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	
	function readInfo(){
		$kkInfo = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT firstname, lastname, language, january, february, march, april, may, june, july, august, september, october, november, december FROM vptestmonths");
		$stmt->bind_result($kkFirstName, $kkFamilyName, $kkLanguage, $kkJanuary, $kkFebruary, $kkMarch, $kkApril, $kkMay, $kkJune, $kkJuly, $kkAugust, $kkSeptember, $kkOctober, $kkNovember, $kkDecember);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		$mysqli->close();
		return $kkInfo;
	}
	
?>