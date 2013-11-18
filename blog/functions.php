<? 
/*
	View Function
	This function takes in a two parameters. 
		A path which is the current page name. We add .view onto it and store that in a variable
		We then include the correct layout file

*/


function view($path, $data = null){
	
	//If data was provided, unpack the create new variables
	if ( $data ){
		//create variable for all data provided
		extract($data);
	}
	
	//take the current page and add .view 
	$path = $path . '.view.php';

	//Load the layout and then load the view
	include "views/layout.php";

}

//Code Abstracted from the controller

// //Filter through and display on the page
// $view_path = 'views/index.view.php';
// include 'views/layout.php';

?>