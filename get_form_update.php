<?php
//connection
$id=$_POST['id'];
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
$query="SELECT * FROM ajax_1 WHERE id=:id";
$statement=$db->prepare($query);
$statement->bindValue(":id",$id);
$statement->execute();
$result=$statement->fetchAll();

$output="<form>";
foreach ($result as $r)
{
	$output.="
        <label>Name</label><br>
        <input type='text' id='ename' value='{$r['name']}'> <br> 
        <input type='submit' id='btn_update' data-uid='{$r['id']}' value='Update'>"; 
}
$output.="</form>";
echo $output;
?>