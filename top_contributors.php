<?php include('header.php') ?>
<?php include('connectdb.php') ?>
<div class="container">
<div class="row">
  <h3>Top Contributors</h3>
</div>
<div class="row">
  <div class="">
<?php
    $query = "SELECT * FROM users ORDER BY midichlorians DESC LIMIT 5";
    $contributors = mysql_query($query);

    // output data of each row
    while($row = mysql_fetch_array($contributors)) {

      $midichlorians = htmlspecialchars($row["midichlorians"]);
      $username = htmlspecialchars($row["username"]);

        echo "
            <a class='list-group-item'>
            <h5 class='list-group-item-heading'>" . $username . "</h5>
            <p><h6>Midichlorians: <span class='badge'>".$midichlorians . "</span></h6></p></a>";
    }

    mysql_close($mysql_handle);

    ?>
  </div>
</div>
</div>
<?php include('footer.php') ?>
