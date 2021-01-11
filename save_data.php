<?php
$name=$_POST['username'];

//connection

try 
{
$db=new PDO ("mysql:host=localhost;dbname=ajax_1","root","");
}
catch(PDOException $e)
{
	echo $e->getMessage();
	exit();
}



//get data fron db

$query="INSERT INTO ajax_1 (name) VALUES (:name)";
$statement=$db->prepare($query);
$statement->bindValue(":name",$name);
$result=$statement->execute();
$statement->closeCursor();
if (isset ($result))
{
 	echo 1;
}
else
{
	echo 0;
}



?>