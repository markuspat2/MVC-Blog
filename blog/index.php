<? 
/*

This is the brains of the operation. Our controler. 

*/

require 'blog.php';

//Fetch all posts
//Maybe switch this to get the last three posts
$posts = get('posts', $conn);

//Load the index view 
view('views/index', array(
	//Package up some data to be passed
	'posts' => $posts

));

//We have information about the user stored in the session
//echo 'Hello ' . $_SESSION['fname'];
//echo '<a href="logout.php"><input type="button" value="Logout"></a>';





