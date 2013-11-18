<!doctype html>
<html>
<head>
	<title>Adventures in PHP - Admin Section</title>
	<link href="css/main.css" rel="stylesheet" type="text/css"/>

</head>
<body>
	<header>
	
		<div id="logo">
	    	<a href="../index.html" ><img src="images/logo.png"/></a>
	    </div>
	    
		<ul id="nav" class="topnav">
		    
		    <li><a href="../about.html" >about me</a></li>
		    <li><a href="../contact.html" >contact</a></li>
		    <li><a href="../work.html" >work</a></li>
		    <li><a href="index.php" >blog</a></li>
	    </ul>
    
	</header>


	<!--

	Display pages dynamically
	
	The Path is provided by the view function in functions.php. Go check that out. 

	As the view function executes the following php will be parsed and the correct 
	view will be loaded. 

	Magic...

	-->
	
	<!--Load the view-->
	<? include "$path"; ?>


	<footer>
	</footer>
</body>
</html>