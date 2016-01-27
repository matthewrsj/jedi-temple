<?php include('header.php') ?>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2>Home</h2>
    </div>
    <div class="col-md-3">

    </div>
    <div class="col-md-3">
      <div class="jumbotron">
       <a href="https://login.oregonstate.edu/cas/login?service=http://http://web.engr.oregonstate.edu/~malickc/"> Login Here</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="jumbotron container-fluid">
      <div class="col-md-3">
        <label for="">Latest Feed</label>
		<div class="form-group">
     
		</div>
	  </div>
      <div class="col-md-3">
        <label for="">Latest Articles</label>
        <?php
        	$dbhost = 'oniddb.cws.oregonstate.edu';
        	$dbname = 'malickc-db';
        	$dbuser = 'malickc-db';
        	$dbpass = 'Jz8QJFUt65lTYY16';

        	$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
        	    or die("Error connecting to database server");

        	mysql_select_db($dbname, $mysql_handle)
        	    or die("Error selecting database: $dbname");

        	$query = "SELECT Articles.title, Articles.url, Articles.author, Articles.category, 
							Articles.midichlorians, Users.username, Categories.name
							FROM Articles, Users, Categories
							WHERE Articles.author = Users.id AND Articles.category = Categories.id
							LIMIT 5";
        	$articles = mysql_query($query);
            while($row = mysql_fetch_array($articles)) {
        	echo "
				<div class='container'>
					<div class='row'>
						<h5><a href='" . $row["url"] . "'>" . $row['title'] . "</a> - " .
							$row["midichlorians"] . " </h5>
						<p><h6>Users:" . $row["username"] . "</h6></p>
						<p><h6>" . $row["name"] . "</h6></p>
                    </div>
                </div>
				<hr>
			";
            }
			mysql_close($mysql_handle);
        ?>
      </div>
      <div class="col-md-3">
        <label for="">Most Influencial Articles</label>
		<?php
			$dbhost = 'oniddb.cws.oregonstate.edu';
        	$dbname = 'malickc-db';
        	$dbuser = 'malickc-db';
        	$dbpass = 'Jz8QJFUt65lTYY16';

        	$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
        	    or die("Error connecting to database server");

        	mysql_select_db($dbname, $mysql_handle)
        	    or die("Error selecting database: $dbname");

			$query = "SELECT Articles.title, Articles.url, Articles.author, Articles.category, 
							Articles.midichlorians, Users.username, Categories.name
							FROM Articles, Users, Categories
							WHERE Articles.author = Users.id AND Articles.category = Categories.id
							GROUP BY Articles.title
							ORDER BY Articles.midichlorians DESC
							LIMIT 5
							";
        	$articles = mysql_query($query);
            while($row = mysql_fetch_array($articles)) {
        	echo "
				<div class='container'>
					<div class='row'>
						<h5><a href='" . $row["url"] . "'>" . $row['title'] . "</a> - " .
							$row["midichlorians"] . " </h5>
						<p><h6>User: " . $row["username"] . "</h6></p>
						<p><h6>" . $row["name"] . "</h6></p>
                    </div>
                </div>
				<hr>
			";
            }
			mysql_close($mysql_handle);
		?>
      </div>
      <div class="col-md-3">
        <label for="">Most Powerful Contributors</label>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php') ?>
