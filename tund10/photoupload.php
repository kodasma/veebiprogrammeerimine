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
	
	//liidan klassi
	require("classes/Photoupload.class.php");
	//loome objekti
	/*$myPhoto = new Photoupload("peidus");
	echo $myPhoto->publicTest;
	echo $myPhoto->privateTest;*/
	//loome objekti(ajutine fail)
	//$myPhoto = new Photoupload($_FILES["fileToUpload"]["tmp_name"], $imageFileType);
	
	
	//algab foto laadimise osa
	$target_dir = "../../pics/";
	$target_file;
	$uploadOk = 1;
	$imageFileType;
	$notice = "";
	$maxWidth = 600;
	$maxHeight = 400;
	$marginBottom = 10;
	$marginRight = 10;

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		
		//kas mingi fail valiti
		if(!empty($_FILES["fileToUpload"]["name"])){
			
			$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]))["extension"]);
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			//tekitame faili nime koos ajatempliga
			//$target_file = $target_dir .pathinfo(basename($_FILES["fileToUpload"]["name"]))["filename"] ."_" .(microtime(1) * 10000) ."." .$imageFileType;
			$target_file = "hmv_" .(microtime(1) * 10000) ."." .$imageFileType;
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Fail on pilt - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				$notice .= "Fail ei ole pilt.";
				$uploadOk = 0;
			}
		
		
			// Check if file already exists
			if (file_exists($target_file)) {
				$notice .= "Vabandame, fail on juba olemas!";
				$uploadOk = 0;
			}
			
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 2000000) {
				$notice .= "Vabandame, fail on liiga suur!";
				$uploadOk = 0;
			}
			
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$notice .= "Vabandame, ainult jpg, jpeg, png & gif failid on lubatud!";
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			/*if ($uploadOk == 0) {
				$notice .= "Vabandame, su faili ei laetud üles!";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$notice .= "Fail nimega ". basename( $_FILES["fileToUpload"]["name"]). " on üles laetud!";
				} else {
					$notice .= "Vabandame, faili üles laadimisega tekkis probleem!";
				}
			}*/
			
			if ($uploadOk == 0) {
				$notice .= "Vabandame, su faili ei laetud üles!";
			} else {
				
				//loeme EXIF infot, millal pilt tehti
				/*@$exif = exif_read_data($_FILES["fileToUpload"]["tmp_name"], "ANY_TAG", 0, true);
				//var_dump($exif);
				if(!empty($exif["DateTimeOriginal"])){
					$textToImage = "Pilt tehti: " .$exif["DateTimeOriginal"];
				} else {
					$textToImage = "Pildistamise aeg teadmata!";
				}*/
				
				//lähtudes failitüübist, loon sobiva pildiobjekti
				/*if($imageFileType == "jpg" or $imageFileType == "jpeg"){
					$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
				}
				if($imageFileType == "png"){
					$myTempImage = imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
				}
				if($imageFileType == "gif"){
					$myTempImage = imagecreatefromgif($_FILES["fileToUpload"]["tmp_name"]);	
				}*/
				
				//suuruse muutmine
				//küsime originaalsuurust
				/*$imageWidth = imagesx($myTempImage);
				$imageHeight = imagesy($myTempImage);
				$sizeRatio = 1;
				if($imageWidth > $imageHeight){
					$sizeRatio = $imageWidth / $maxWidth;
				} else {
					$sizeRatio = $imageHeight / $maxHeight;
				}
				$myImage = resize_image($myTempImage, $imageWidth, $imageHeight, round($imageWidth / $sizeRatio), round($imageHeight / $sizeRatio));*/
				
				//vesimärgi lisamine
				/*$stamp = imagecreatefrompng("../../graphics/hmv_logo.png");
				$stampWidth = imagesx($stamp);
				$stampHeight = imagesy($stamp);
				$stampPosX = round($imageWidth / $sizeRatio) - $stampWidth - $marginRight;
				$stampPosY = round($imageHeight / $sizeRatio) - $stampHeight - $marginBottom;
				imageCopy($myImage, $stamp, $stampPosX, $stampPosY, 0, 0, $stampWidth, $stampHeight);*/
				
				//lisame ka teskti vesimärgina
				/*$textColor = imagecolorallocatealpha($myImage, 150, 150, 150, 50);
				//RGBA alpha 0-127
				imagettftext($myImage, 20, 0, 10, 25, $textColor, "../../graphics/ARIAL.TTF", $textToImage);*/
				
				//salvestame pildi
				/*if($imageFileType == "jpg" or $imageFileType == "jpeg"){
					if(imagejpeg($myImage, $target_file, 95)){
						$notice = "Fail: " .basename( $_FILES["fileToUpload"]["name"]). " on üles laetud!";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge!";
					}
				}
				if($imageFileType == "png"){
					if(imagepng($myImage, $target_file, 95)){
						$notice = "Fail: " .basename( $_FILES["fileToUpload"]["name"]). " on üles laetud!";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge!";
					}
				}
				if($imageFileType == "gif"){
					if(imagegif($myImage, $target_file, 95)){
						$notice = "Fail: " .basename( $_FILES["fileToUpload"]["name"]). " on üles laetud!";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge!";
					}
				}*/
				//mälu vabastamine
				/*imagedestroy($myImage);
				imagedestroy($myTempImage);
				imagedestroy($stamp);*/
				
				//kasutan klassi
				$myPhoto = new Photoupload($_FILES["fileToUpload"]["tmp_name"], $imageFileType);
				$myPhoto->readExif();
				$myPhoto->resizeImage($maxWidth, $maxHeight);
				$myPhoto->addWatermark();
				//$myPhoto->addTextWatermark($myPhoto->exifToImage);
				$myPhoto->addTextWatermark("hmv_foto");
				$myPhoto->savePhoto($target_dir, $target_file);
				$myPhoto->clearImages();
				unset($myPhoto);
			}
		} else {
			$notice = "Palun valige kõigepealt pildifail!";
		}
	}
	
	/*function resize_image($image, $origW, $origH, $w, $h){
		$dst = imagecreatetruecolor($w, $h);
		imagecopyresampled($dst, $image, 0, 0, 0, 0, $w, $h, $origW, $origH);
		return $dst;
	}*/
?>

<?php
	require("header.php");
?>
	<h1>Piltide üles laadimine</h1>
	<p><a href="main.php">Pealeht</a></p>
	<p><a href="?logout=1">Logi välja!</a></p>
<form action="photoupload.php" method="post" enctype="multipart/form-data">
    Vali pilt (Max 2MB):<br><br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    <input type="submit" value="Lae Üles" name="submit"><br><br>
	<span><?php echo $notice ?></span>
</form>	
<?php
	require("footer.php");
?>