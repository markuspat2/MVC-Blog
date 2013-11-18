<?
//connection
error_reporting(E_ALL);

include 'ie6styles.php';

$email = base64_decode($_GET['usiudsi']);
$submit = $_POST['submit'];


if ($submit == 'Change Password'){

    $newpass = $_POST['newpass'];
	$newpass2 = $_POST['newpass2'];

	if ($newpass == $newpass2) {
		$encpass = doubleSalt($newpass);
		$uid = $_POST['id'];
		$uppass = $dbh->prepare("update sp13members set password = ? where id = ?");
		$uppass->execute(array($encpass,$uid));

	}
	
	$hint1 = $_POST['hint1'];
	$solution1 = $_POST['solution1'];
	$uhint1 = $dbh->prepare("insert into sp13hints (hint,solution,uid) values (?,?,?)");
	$uhint1->execute(array($hint1,$solution1,$uid));	

	$hint2 = $_POST['hint2'];
	$solution2 = $_POST['solution2'];
	$uhint2 = $dbh->prepare("insert into sp13hints (hint,solution,uid) values (?,?,?)");
	$uhint2->execute(array($hint2,$solution2,$uid));	

	header ("Location: login.php");

}

/*

update and encrypt password
insert into hints table
redirect to login

*/

if ($submit == 'Activate'){
	$uname = $_POST['uname'];
	$pass = $_POST['oldpass'];
	$email = $_POST['email'];

	$checksql = $dbh->prepare("select id from sp13members where email = ? and uname = ? and password = ?");
	$checksql->execute(array($email,$uname,$pass));

	$nummembers = 0;

	while ($checkrow = $checksql->fetch()){
		$uid = $checkrow[0];
		$nummembers++;	
	}

	if ( $nummembers == 1 ) {
		$upsql = $dbh->prepare("update sp13members active set   active = '1' where email  = ? and uname = ? and password = ?");
		$upsql->execute(array($email,$uname,$pass));

?>
Set your new password! 
<form action = "<?=$_SERVER['PHP_SELF'];?>" method = "post">
    <input type = "hidden" name = "id" value =  "<?= $uid;?>"/>
	New Password: <input type = "text" name = "newpass" required/><br/>
	New Password Repeat:<input type = "text" name = "newpass2" required/><br/>
	Hint 1:<input type = "text" name = "hint1" required/><br/>
	Solution1:<textarea name = "solution1"></textarea><br/>
	Hint 2:<input type = "text" name = "hint2" required/><br/>
	Solution2:<textarea name = "solution2"></textarea><br/>

	<img src = "captcha.php"/>

	<br/>

	Please enter the code in the above image:
	<input type = "text" name = "captcha" required/>
	<input type = "submit" name = "submit" value ="Change Password"/>
</form>
<?
    	exit();

		//update level

		//show new pass fields

		//hints will be on profile page

		//redirect to a login page


	} else {
	//contact there is a problem  
		

   	}

}
?>

<form action = "<?=$_SERVER['PHP_SELF'];?>" method = "post">
Username:<input type = "text" name = "uname" required/><br/>
<input type="hidden" name="email" value = "<?= $email;?>"/>
Activation Password:<input type = "password" name = "oldpass" required/><br/>
<input type = "submit" name = "submit" value="Activate"/>
</form>
