<?


session_start();
include 'ie6styles.php';

$submit = $_POST['submit'];

if ($submit == 'Log In'){
	$uname = $_POST['uname'];
	$password = $_POST['password'];
	$encpass = doubleSalt($password);
	$checksql = $dbh->prepare("select id,fname from sp13members where uname = ? and password = ? and active = '1' and numtries < 4");
	$checksql->execute(array($uname,$encpass));
	$nummembers = 0;

	while ($checkrow = $checksql->fetch()){
		$id = $checkrow[0];
		$fname = $checkrow[1];
	    $nummembers++;	
	}

	if ($nummembers == 1) {
		$_SESSION['userid'] = $id;
		$_SESSION['fname'] = $fname;
		$_SESSION['ekfwkefergjergu84t98q'] = 'nkearjnglkjgblkj';
		$log = $dbh->prepare("update sp13members set lastlogin = now(),numtries = '0' where id = ? ");
		$log->bindValue(1,$id);
		$log->execute();
		header ("Location: admin/index.php");
	} else {
		$update = $dbh->prepare("update sp13members set numtries = numtries + 1 where uname = ?");	 
		$update->bindValue(1,$uname);
		$update->execute();
		$warn = $dbh->prepare("select numtries from sp13members where uname = ?");
		$warn->bindValue(1,$uname);
		$warn->execute();
		$warnrow = $warn->fetch();
		$numwrong = $warnrow[0];

		if ($numwrong > 2) {
			echo 'Your  account is locked!';
		} else {
	   		$remain = 3 - $numwrong;
			echo ' You have tried to log in '.$numwrong.' times. You have  '.$remain.' left before your account is locked';      
   		}
 	}

}

?>

<form action = "login.php" method = "post">
Username: <input type = "text" name = "uname" required/><br/>
Password:<input type = "password" name = "password" required/><br/>
<input type = "submit" name = "submit" value = "Log In">
<a href="register.php"><input type = "button" name = "register" value = "Register"></a>
</form>