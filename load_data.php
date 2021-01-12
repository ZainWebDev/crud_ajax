<?php
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
$query="SELECT * FROM ajax_1";
$statement=$db->prepare($query);
$statement->execute();
$result=$statement->fetchAll();


$output="";
if (count($result)>0){
$output='<table id="table_data" style="text-align:center;margin:10px auto" border="1px" >
	<tr>
    	<th>ID</th>
    	<th>NAME</th>
    	<th>Update</th>
    	<th>Delete</th>
 		</tr>
 ';
 foreach($result as $r)
 {
 	$output.="<tr>
 	<td>{$r['id']}</td>
 	<td>{$r['name']}</td>
 	<td><button data-eid='{$r['id']}' class='edit_btn'>Edit</button></td>
 	<td><button data-id='{$r['id']}' class='delete_btn'>Delete</button></td>
 	</tr>";
 }
 	$output.="</table>";
   echo "$output";
   $statement->closeCursor();
}
else
{
	"<h2>No Record Found</h2>";
}

?>