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

  $query1="SELECT users.id
           FROM users
           WHERE users.username = ".$_POST['username'];

  echo "post username = ".$_POST['username'];

  $userids = mysql_query($query1);
  while($row = mysql_fetch_array($userids)) {
    $userid = $row['id'];
  }

  echo "userid = ".$userid;

	//echo 'Successfully connected to database!';

	$title = mysql_real_escape_string($_POST['title']);
	$url = mysql_real_escape_string($_POST['url']);
	$user_id = mysql_real_escape_string($userid);
	$category_id = mysql_escape_string($_POST['category_id']);
	$time_submitted = mysql_escape_string($_POST['time_submitted']);


	$query="INSERT INTO articles(id, title, url, user_id, category_id, midichlorians, time_submitted)
	    VALUES (NULL, '$title','$url', '$user_id', '$category_id', 0, NOW())";

	$result = mysql_query($query);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}

	mysql_close($mysql_handle);

	header('Location: http://web.engr.oregonstate.edu/~malickc/latest_articles.php');
	die();
	echo '<h1>Thank you for submitting your information!</h1> <br> <a href="index.php">Home Page</a>';
	echo $result

?>
