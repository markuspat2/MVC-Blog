<?
session_start();

function doubleSalt($password){ 
	$password = str_split($toHash,(strlen($toHash)/2)+1);
	$hash = hash('md5', $password.'centerSalt'.$password); 
	return $hash; 
}

$dbh = new PDO("mysql:host=localhost;dbname=mmaaaco_mpatterson", "mmaaaco_mpatter", "295182mpatt");

?>