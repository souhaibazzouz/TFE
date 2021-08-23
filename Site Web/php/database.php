<?php
function OpenCon()
 {
	$user = 'root';
	$password = '';

	try{
		$db = new PDO ('mysql:host=localhost;dbname=c1641721c_2par', $user, $password);
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