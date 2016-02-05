<?php include('header.php') ?>
<div class="container">
<div class="row">
  <h3>Top Contributors</h3>
</div>
<div class="row">
  <div class="">
<?php

    $dbhost = 'oniddb.cws.oregonstate.edu';
    $dbname = 'malickc-db';
    $dbuser = 'malickc-db';
    $dbpass = 'Jz8QJFUt65lTYY16';


    // Create connection
    $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
        or die("Error connecting to database server");

    mysql_select_db($dbname, $mysql_handle)
        or die("Error selecting database: $dbname");

    $query = "SELECT * FROM users ORDER BY midichlorians DESC LIMIT 5";
    $contributors = mysql_query($query);

    // output data of each row
    while($row = mysql_fetch_array($contributors)) {

      $midichlorians = htmlspecialchars($row["midichlorians"]);
      $username = htmlspecialchars($row["username"]);

        echo "
            <a class='list-group-item' href='#'>
            <h5 class='list-group-item-heading'>" . $username . "</h5>
            <p><h6>Midichlorians: <span class='badge'>".$midichlorians . "</span></h6></p></a>";
    }

    mysql_close($mysql_handle);

    ?>
  </div>
</div>
</div>
<?php include('footer.php') ?>
