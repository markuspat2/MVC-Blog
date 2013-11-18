<?
error_reporting(E_ALL);

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$submit = $_POST['submit'];

	if ($submit == 'Submit'){
	  $dbh = new PDO("mysql:host=localhost; dbname=mmaaaco_mpatterson", "mmaaaco_mpatter", "295182mpatt");

	  echo 'working';
	  $fname = $_POST['fname'];
	  $email = $_POST['email'];
	  $message = $_POST['message'];

	  $insertsql = $dbh->prepare("insert into contacts (fullname,email,message) values (?,?,?)");
	  $insertsql->execute(array($fname,$email,$message));;
	  
	  header("Location: contact.html");
	} else {
		echo 'broken';
	}
}

?>