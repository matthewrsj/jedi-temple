<?php
	// database connection information
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'malickc-db';
	$dbuser = 'malickc-db';
	$dbpass = 'Jz8QJFUt65lTYY16';

	$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    	or die("Error connecting to database server");

	mysql_select_db($dbname, $mysql_handle)
    	or die("Error selecting database: $dbname");

	//echo 'Successfully connected to database!';

	$title = mysql_real_escape_string($_POST['title']);
	$url = mysql_real_escape_string($_POST['url']);
	$user_id = mysql_real_escape_string($_POST['user_id']);
	$category_id = mysql_escape_string($_POST['category_id']);
	$time_submitted = mysql_escape_string($_POST['time_submitted']);


	$query="INSERT INTO articles(id, title, url, user_id, category_id, midichlorians, time_submitted)
	    VALUES (NULL, '$title','$url', 1, '$category_id', 0, CURDATE())";

	$result = mysql_query($query);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}

	mysql_close($mysql_handle);

	echo '<h1>Thank you for submitting your information!</h1> <br>';
	echo $result

?>
