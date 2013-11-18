<?
/*

Simple MVC Blog -- Mark Patterson

Sources:
PHP fundamentals Course. 
http://www.youtube.com/watch?v=ksMFioOxFlk&list=PL20XMsrG9BmqmM8-ftQ44vI2dfZQKxCKU

I strongly recommend this tutorial. Great pace and he teaches abstraction really well. 
*/

include 'functions.php';
require 'db.php';

session_start();
//print_r($_SESSION);


//They are logged in connect to db
$conn = connect($config);
if( !$conn ) die('Problem connecting to the Database.');

