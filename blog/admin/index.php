<?
require '../blog.php';

//Check the user credentials If they are logged in...Connect to the DB
//If they are not logged in redirect to login script
if( !is_logged_in() ){

	//Not logged in, redirect to login.php
	header('Location: ../login.php');
	die();

} else {

//Data hold any values that pass between views
$data = array();

//If the Server super globals has a request method of POST then we must have some data
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){

	//Grab the values
	$title = $_POST['title'];
	$body = $_POST['body'];

	//if either field is blank display status asking the user to try again
	if( empty($title) || empty($body) ){
		$data['status'] = 'Please fill out both inputs.';
	}	else {
		//create new row in the db
		query(
			"INSERT INTO posts(title, body) VALUES (:title, :body)",
			array('title' => $title, 'body' => $body),
			$conn);
		//Give the user feedback that their post made it into the db
		$data['status'] = 'Posted';

	}

} else {
	//initialize status if this is the first time through
	$status = '';
}

//Load the Create Post page and pass through any data you may have
view('admin/create', $data);

}

