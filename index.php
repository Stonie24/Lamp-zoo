<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <form action="userinfo.php" method="post" enctype="multipart/form-data"> 

  <label>Name</label>
  <input type="text" name="name">
  <label>Category</label>
  <select name="category">

  <option value="katt">blabla</option>

  </select>
  <label>BirthDay</label>
  <input type="date" name="birthday"/>
  <input type="file" name="file" id="fileToUpload">
  <input type="submit" value="Send"/>
 

 
  </form>
 

</body>
</html>