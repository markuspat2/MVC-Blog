<?

require_once ('ie6styles.php');

function makepass(){ 
	//All alphabetical charaters in a string
 	$salt = "abcdefghijklmnopqrstuvwxyz0123456789";
 	//Crazy large random number
  	srand( (double)microtime() * 1000000); 
  	//iterator
	$i=0;

	while($i<7) { 
		$num = rand() % 33;
		$tmp = substr($salt,$num,1); 
		$pass = $pass.$tmp; 
		$i++;	 
	}

   	return $pass;
}

if ($_POST['submit'] == 'Register'){

	$fullname = $_POST['fullname']; 
	$email = $_POST['email']; 
	$uname = $_POST['uname'];
	$pass = makepass();
	
	if ($_SESSION['captcha']  != $_POST['captcha']) {
		//cleans out bad captcha entries and shows form and exits
		showform('');	
		exit();	
	}

	//Is the there a user in the database that matches this username or email address?
	$checksql = $dbh->prepare("select id from sp13members where email = ? or uname = ?");
	$checksql->execute(array($email,uname));
	$nummembers = 0;

	//If the return is empty numembers will not increment. 
	while ($checkrow = $checksql->fetch()){
		$nummembers++;	
	}

	//If numembers incemented then we must have a memeber in the database that matches that username or that email address. 
	//In this instance it doesn't matter but we could write a condition that looked for which the user need to change. 
	//Most likely it will be email. But I assume with a much larger system you would encounter username duplication as well...
	if ($nummembers == 1) {
		echo 'It appears you are already a member. <br/>Please go <a href="resetpw.php">here</a> to reset your password';  
		exit();
	}

	//Take what the user entered for full name and break it into an array of words
	$namearr = explode(' ', $fullname);

	//$fname = the first word in that array
	$fname = $namearr[0];

	//All other words are pressed into one variable called $lname
	for ($i=1;$i<count($namearr);$i++){
		$lname .= $namearr[$i].' ';
	}

	//Pack it all up and send it to the db
	$ins = $dbh->prepare("insert into sp13members (fname,lname,email,uname,password,signupdate) values (?,?,?,?,?,now())");
	$ins->execute(array( $fname,$lname,$email,$uname,$pass));

	//Take $email and make it a base64 encoded string
	$enc = base64_encode($email);

	//dynamic link -- use the get method to grab $enc
	$link = ' <a href = "http://mm214.com/mpatterson/MYSQL/members/activate.php?usiudsi='.$enc.'">Activate</a>'; 
	echo $link;

	//Register email with dynamic link and generated password
	$content = 'Welcome to PicShare.com.<br/>Please click on the following link to activate your account: '.$link.'<br/>
	Your initial password is '.$pass.'<br/>';
	echo $content;

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To: '. $fullname .' <'.$email.'>,' . "\r\n";
	$headers .= 'From: Web Guru <webguru@example.com>' . "\r\n";
	//not needed here
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	$bool = mail($email,"Your membership at PicShare.com",$content,"Content-type: text/html");

	if($bool){
		echo 'Thank you, please check '.$email.' for instructions to activate your account<br/>';
	} else {
		echo 'iz broke';
	}

}
?>

<!doctype html>
<html>
<header>
	<title>Register</title>
</header>

<body>

<form action = "register.php" method = "post">
	Fullname: <input type = "text" name = "fullname" required/><br/>
	Username:<input type = "text" name = "uname" required/><br/>

	Email:<input type = "email" name = "email" required/><br/>
	
	<img src = "captcha.php"/><br/>
	Please enter the code in the above image:
	<input type = "text" name = "captcha" required/>
	<input type = "submit" name = "submit" value ="Register"/>
</form>

</body>
</html>
