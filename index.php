<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h1> <strong>Lamp Zoo</strong> </h1>
  <form action="index.php" method="POST" enctype="multipart/form-data"> 

  <label>Name</label>
  <input type="text" name="name">
  <label>Category</label>
  <select name="category">

  <option value="Fisk">Fisk</option>
  <option value="Däggdjur">Däggdjur</option>
  <option value="Fågel">Fågel</option>
  <option value="Insekt">Insekt</option>



  </select>
  <label>BirthDay</label>
  <input type="date" name="birthday"/>
  <input type="submit" value="Submit"/>
 

 
  </form>

  <form action="userinfo.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>


<?php
// try{
//    $dbh = new PDO('mysql:host=localhost;dbname=zoo;charset=UTF8;port=3306', 'zookeeper', 'lampzoo');
//     $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $sth = $dbh-> query("select * from animals where category like '%Fisk'");
//     while($row = $sth-> fetch(PDO::FETCH_ASSOC)){
//       printf("%-40s %-20s\n", $row["name"],$row["birthday"]);
//     }
// }
// catch (PDOException $e){
//   printf("Du har gjort fel: %s\n", $e->getMessage());
// }
// exit();



$name = trim($_POST['name']);

$category = trim($_POST['category']);

$birthday = trim($_POST['birthday']);




if ( !$category && !$name ){
  echo ("You must specify either a name, category or a birthday");
  exit();
}
try{
  $dbh = new PDO('mysql:host=localhost;dbname=zoo;charset=UTF8;port=3306', 'zookeeper', 'lampzoo');
  $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOExepction $e){
  printf("Unable to open the database: %s\n",$e->getMessage());
}
$query = "select * from animals ";
if ($name && !$category ){ //name search only
  $query =  $query . "Where name like '%" . $name . "%'";
}
if (!$name && $category ){ //gategory search only
  $query =  $query . "Where category like '%" . $category . "%'";
}
if ($name && $category ){// name and gategory search
  $query =  $query . "Where name like '%" . $name . "%' and category like '%". $category . "%' ";
}
try{
$sth = $dbh->query($query);
$animalcount = $sth->rowCount();
if($animalcount==0){
  printf("No animals with that name found");
  exit;
};
printf('<table bgcolor="#bdc0ff" cellpadding="6"');
printf('<tr><b><td>Name</td><td>Category</td><td>Birthday</td></b></tr>');
while ($row = $sth-> fetch(PDO::FETCH_ASSOC)){
  printf("<tr> <td> %s </td> <td> %s </td><td> %s </td> </tr>", $row["name"],$row["category"],$row["birthday"]);
}
}
catch (PDOExepction $e) {
printf("We had a problem");
}



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
 

</body>
</html>