<?
/*

This is the controler for single page view

*/

require 'blog.php';

//Pass the id as an interger and the connection in
//Out comes a post. 
$post = get_by_id( (int)$_GET['id'], $conn );

//print_r($posts); What's inside this post? I gots ta know!

//If the post doesn't exsist go back to the home page. 
//You can see this in action by typing in an id the doesn't exsist. 
if( $post ){
	$post = $post[0];

	//Load the view for the page specified by the user 
	view('single', array(
		//Package up some data to be passed
		'post' => $post

	));

} else {
	header("Location: index.php");
}



?>