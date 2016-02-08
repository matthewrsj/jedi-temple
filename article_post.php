<?php
  // start session
  session_start();

  //grab session information we want
  $session_id = $_SESSION['onidid'];

	// database connection information
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'malickc-db';
	$dbuser = 'malickc-db';
	$dbpass = 'Jz8QJFUt65lTYY16';

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	//used for getting userid
	$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    	or die("Error connecting to database server");
	mysql_select_db($dbname, $mysql_handle)
    	or die("Error selecting database: $dbname");

	$query1="SELECT users.id
           FROM users
           WHERE users.username = '$session_id'";

    $userid = mysql_query($query1);
    while($row = mysql_fetch_array($userid)) {
    	$userid = $row['id'];
  	}


	// prepare and bind
	$stmt = $conn->prepare("INSERT INTO articles (id, title, url, user_id, category_id, midichlorians, time_submitted)
		VALUES (NULL, ?, ?, ?, ?, 0, NOW())");

	$stmt->bind_param("ssii", $title, $url, $user_id, $category_id);
	
	//Set params and execute
	$title = $_POST['title'];
 	$url = $_POST['url'];
	$user_id = $userid;
	$category_id = $_POST['category_id'];

	$stmt->execute();
	$stmt->close();
	$conn->close();
	header('Location: http://web.engr.oregonstate.edu/~johnsma8/jedi-temple/display_articles.php');
	die();

?>
