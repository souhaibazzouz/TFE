<?php
function OpenCon()
 {
	$user = '*******';
	$password = '*******';

	try{
		$db = new PDO ('mysql:host=*******;dbname=*******', $user, $password);
	}catch(PDOException $e){
		print "Erreur:".$e->getMessage()."<br/>";
		die;
	}
	
	return $db;
 }
 
 function CloseCon($conn)
 {
 $conn -> close();
 }
?>