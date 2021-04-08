<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div class="file">
<a href="https://fontmeme.com/star-wars-font/"><img src="https://fontmeme.com/permalink/210408/64c5d5dd97147fd2c6ec2133e2d51c78.png" alt="star-wars-font" border="0"></a>
  <form class="fileUpload" action="uploaded.php" method="post" enctype="multipart/form-data">
  <label>Select image to upload:</label>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
  </form>
</div>

  <div class="container">

  <!-- Sökform -->
  <form class="searchForm" action="index.php" method="POST" enctype="multipart/form-data"> 
    <label>Name</label>
    <input type="text" name="name">
    <label>Category</label>
    <select name="category">
    <option value=""></option>
    <option value="Fisk">Fisk</option>
    <option value="Däggdjur">Däggdjur</option>
    <option value="Fågel">Fågel</option>
    <option value="Insekt">Insekt</option>
    </select>
   <div class="btndiv"> <input type="submit" value="Submit" class="btn"/></div>
   
  </form>

  <!-- Filuppladnings form -->



<?php

// Hämtar och sparar informationen i variabler från forumuläret
$name = trim($_POST['name']);
$category = trim($_POST['category']);


// Kollar om man har fyllt i något i formuläret, visar ett fel meddelande annars
if ( !$category && !$name ){
  echo ("You must specify either a name, category or a birthday");
  exit();
}

// Connectar till databasen med våran användare
try{
  $dbh = new PDO('mysql:host=localhost;dbname=zoo;charset=UTF8;port=3306', 'zookeeper', 'lampzoo');
  $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
// Om anslutningen misslyckas visas ett felmeddelande
catch (PDOExepction $e){
  printf("Unable to open the database: %s\n",$e->getMessage());
}

// Början av våran query
$query = "select * from animals ";

// Olika strängsammansättningar beroende på vad man har fyllt i formuläret
if ($name && !$category ){ //name search only
  $query =  $query . "Where name like '%" . $name . "%'";
}
if (!$name && $category ){ //category search only
  $query =  $query . "Where category like '%" . $category . "%'";
}
if ($name && $category ){// name and category search
  $query =  $query . "Where name like '%" . $name . "%' and category like '%". $category . "%' ";
}

try{
  // Kör våran query
$sth = $dbh->query($query);

// Räknar resultat och visar ett felmeddelande om inget djur hittades
$animalcount = $sth->rowCount();
if($animalcount==0){
  printf("No animals with that name found");
  exit;
};

// Skapar en tabell
printf('<table bgcolor="#bdc0ff" cellpadding="6"');
printf('<tr><b><td>Name</td><td>Category</td><td>Birthday</td></b></tr>');
// Loopar igenom hela resultatet och lägger in det i tabellen
while ($row = $sth-> fetch(PDO::FETCH_ASSOC)){
  printf("<tr> <td> %s </td> <td> %s </td><td> %s </td> </tr>", $row["name"],$row["category"],$row["birthday"]);
}
}
// Visar ett felmeddelande om något gick snett
catch (PDOException $e) {
printf("We had a problem");
}

//Väljer en bild som är samma som $name
switch ($name) {
  case "Gädda":
    echo "<img src='djurbilder/gädda.bmp'>";
    break;
  case "Älg":
     echo "<img src='djurbilder/älg.bmp'>";
    break;
  case "Mört":
   echo "<img src='djurbilder/mört.bmp'>";
    break;
    case "Grå Jako":
   echo "<img src='djurbilder/grå.bmp'>";
    break;
    case "Tordyvel":
   echo "<img src='djurbilder/tård.bmp'>";
    break;
  default: 
  echo "Tomt";
}
?>

</div>

</body>
</html>