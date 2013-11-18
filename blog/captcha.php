<?
session_start();
$im = imagecreate(100,30);
$bg = imagecolorallocate($im,255,255,255);
$textcolor = imagecolorallocate($im,255,0,0);
$string = mt_rand();
$_SESSION['captcha'] = $string; 
imagestring($im,10,0,0,$string,$textcolor);
header("Content-type: image/png");
imagepng($im);
		 
/*
level 1 simple mt_rand()
level 2 single salt
function makepass() {
$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
srand((double)microtime()* 1000000);
$i=0;
while($i<7)
    {
 $num = rand() % 33;
 $tmp = substr($salt,$num,1);
 $pass = $pass.$tmp;
 $i++;
	}
return $pass;
}
level 3 most secure
function doubleSalt($toHash,$username){
$password = str_split($toHash,(strlen($toHash)/2)+1);
var_dump($password);
$hash = hash('md5', $username.$password[0].'centerSalt'.$password[1]);
return $hash;
}
echo doubleSalt('hamilton','ksecor');
*/
			 
?>
