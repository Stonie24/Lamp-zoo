<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uploaded</title>
  <link rel="stylesheet" href="css/uploaded.css">
</head>
<body>
  <div class="uploadContainer">

 

<?php
// Sparar filen i Bilder
$target_dir = "Bilder/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Kollar om bilden är äkta eller fake
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "<p>Upload Check: <span class='succes'>File is an image - " . $check["mime"] .  ".</span></p> ";
    $uploadOk = 1;
  } else {
    echo "<p>Upload Check:<span class='danger'>File is not an image.</span></p>";
    $uploadOk = 0;
  }
}

// Kollar om filen redan existerar i mappen
if (file_exists($target_file)) {
  echo " Sorry, file already exists.";
  $uploadOk = 0;
}

// Kollat att filen är inte större än 500000
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Tillåter endast jpg och png
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
  $uploadOk = 0;
}

// kollar om $uploadOk är satt till 0 av en error
if ($uploadOk == 0) {
  echo " <p>Your file was not uploaded.</p> <a href='index.php'>Go back to main page</a>";
// Om allting är okej ladda upp filen
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo " The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.<br> <a href='index.php'>Go back to main page</a>'";
  } else {
    echo "<p>Sorry, there was an error uploading your file.</p>";
  }
}
?>


 </div>
</body>
</html>






