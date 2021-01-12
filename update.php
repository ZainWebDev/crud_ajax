<?php
//connection
$userid=$_POST['userid'];
$username=$_POST['username'];
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
$query="UPDATE ajax_1 SET name=:name WHERE id=:id";
$statement=$db->prepare($query);
$statement->bindValue(":id",$userid);
$statement->bindValue(":name",$username);
$result=$statement->execute();
$statement->closeCursor();
if(isset($result)){
echo 1;
}
else
{
	echo 0;
}
?>