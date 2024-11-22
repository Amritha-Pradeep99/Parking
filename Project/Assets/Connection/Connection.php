<?php
$servername="localhost";
$username="root";
$password="";
$db="db_parking";

$Con=mysqli_connect($servername,$username,$password,$db);
if(!$Con)
{
	echo "connection failed";
}
?>