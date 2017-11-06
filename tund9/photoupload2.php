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
	
	//algab foto laadimise osa
	$target_dir = "../../pics/";
	$target_file;
	$uploadOk = 1;
	$imageFileType;

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		
		//kas mingi fail valiti
		if(!empty($_FILES["fileToUpload"]["name"])){
			
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			//tekitame faili nime koos ajatempliga
			$target_file = $target_dir .pathinfo(basename($_FILES["fileToUpload"]["name"]))["filename"] ."_" .(microtime(1) * 10000) ."." .pathinfo(basename($_FILES["fileToUpload"]["name"]))["extension"];
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Fail on pilt - " . $check["mime"] . ".";
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
				$notice .= "Vabandame, ainult JPG, JPEG, PNG & GIF failid on lubatud!";
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$notice .= "Vabandame, su faili ei laetud üles!";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$notice .= "Fail nimega ". basename( $_FILES["fileToUpload"]["name"]). " on üles laetud!";
				} else {
					$notice .= "Vabandame, faili üles laadimisega tekkis probleem!";
				}
			}
		}
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
	<p><a href="main.php">Pealeht</a></p>
	<p><a href="?logout=1">Logi välja!</a></p>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Vali pilt (Max 2MB):<br><br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br><br>
    <input type="submit" value="Lae Üles" name="submit">
	<?php echo $notice; ?>
</form>	
</body>

</html>