<?php 
$con=mysqli_connect("localhost","zookeeper","lampzoo");

if($con){
  echo "Connection successful";
}
mysqli_select_db($con,'zoo');
$name=$_POST['name'];
$category=$_POST['category'];
$birthday= $_POST['birthday'];
$File=$_POST['File'];


$query="insert into animals(name,category,birthday,File)
values('$name','$category','$birthday','$File')";
echo "$query";
mysqli_query($con,$query);
header('location:index.php');