<?php
$id=$_POST['id'];

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



//delete data from db

$query="DELETE FROM ajax_1 WHERE id=:id";
$statement=$db->prepare($query);
$statement->bindValue(":id",$id);
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