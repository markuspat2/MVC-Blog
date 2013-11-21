<? 

/*
	Functions.php houses our abstracted logic. AKA our legos, puzzle pieces...

	The functions here are written in a way that allows us
	to easily use and re-use specific pieces of code. 

	This is the blackbox. 
	Andrew would say, "insert pig output sausage. "

	Write it once. Use it again and again. 
*/



/*
	Quick check to see whether or not the user is logged in. 
	returning false here triggers the controler to send the user
	to a login script.

	When the login script finishes a session is set. 

	We can test to see whether or not a session exsists by using 
	isset(); and returning a boolean value. 

*/

function is_logged_in() {
	//If there is a value then return TRUE if not FALSE
	return isset($_SESSION['fname']);
} 


/*

	Setting up and making the connection

*/

//The config array holds the information we need for the connect function
$config = array(
	//Hold DB info for use in connect function
	'username' => 'mmaaaco_mpatter',
	'password' => '295182mpatt'
);


/*

Connect to the DB, if you can return the results as a variable
Otherwise return false. 

*/

function connect($config){
	try{
		//Connect to the DB using the values stored in the config array
		$conn = new PDO("mysql:host=localhost;dbname=mmaaaco_mpatterson", $config['username'], $config['password']);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Pass the connection back to wherever it was called from.
		return $conn;
	}	catch(Exception $e){
		//returning false is going to trigger our controler to print out an error.
		return false;
	}
}


/*
	Simple DB query function. 
	Takes in the query, the bindings and the connection:
		The query will be typed in as a string
		The bindings will be an array 
		and the connection will have been previously defined and currently held in the $conn

*/

function query($query, $bindings, $conn){
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);
	return $stmt;
}

/*
	Simple DB get function. 
	This takes in a table name, the connection. A limit is optional.
	if a limit isn't provided it will default to 3.
		The table name will be a string 
		The connection is already defined :)
		The limit is optional and will default to 3.

*/

function get($tableName, $conn, $limit = 3){

	try{
		$result = $conn->query("SELECT * FROM $tableName ORDER BY id DESC LIMIT $limit");

		return ( $result->rowCount() > 0 )
			? $result
			: false;
	} catch(Exception $e) {
		return false;
	}
}



function get_by_id($id, $conn){
	//Fetch a single post using the query helper function. 
	//Give it the query, an array of bindings and the connection
	//Presto! we have an array of posts.
	$query = query(
		'SELECT * FROM posts WHERE id = :id LIMIT 1', 
		array('id' => $id), 
		$conn);

	return $query->fetchAll();

}

?>
