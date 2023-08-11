<!DOCTYPE html>
<html>
<head>
	<style>
		.contaner {
			display: flex;
  			justify-content: center;
  		}

  		.sub {
			width:80px;
			height:50px;	
  		}

  		.add {
			border: 1px solid #000;
			padding:15px;
			margin-right: 5px;
  		}
  		.error {color: #FF0000;}
	</style>
</head>
<body>
<div class="contaner">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
		<h3 style="text-align:center; padding: 3px;">PDF Uploader</h3>
  		<input class="add" type="file" name="fileToUpload" id="fileToUpload">
  		<input class="sub" type="submit" value="Submit" name="submit">

	</form>
</div>
		
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$target_direction = "Upload/";
		$target_file = $target_direction . basename($_FILES["fileToUpload"]["name"]);
		$accept_upload = 1;
		$PDF_FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		echo "<br>";

	// Check if file already exists
	if (file_exists($target_file)) {
	  echo "<CENTER>This file already exist!<br>";
	  $accept_upload = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 2097152) {
	  echo "<CENTER>This file is too large!<br>";
	  $accept_upload = 0;
	}
	// Allow certain file formats
	if($PDF_FileType != "pdf") {
	  echo "<CENTER>This file is not a PDF!<br>";
	  $accept_upload = 0;
	}

	// Unsuccessful Error message
	if ($accept_upload == 0) {
	  echo "<CENTER>Sorry, Unsuccessful uploading!";
	// Successful Uploading message
	} else {
	  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	  	echo "<CENTER>Upload: " . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) . "<br>";
	  	echo "<CENTER>Type: " . strtoupper($PDF_FileType) . "<br>";
	  	echo "<CENTER>Size: " . $_FILES["fileToUpload"]["size"]/1024 . "Kb<br>";
	  	echo "<CENTER>Stored in: " . $target_file . "<br>";

	  }
	}
}
?>
	
</body>
</html>


