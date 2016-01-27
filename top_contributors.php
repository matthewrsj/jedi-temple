<?php include('header.php') ?>
<?php
    
    $dbhost = 'oniddb.cws.oregonstate.edu';
    $dbname = 'steinfek-db';
    $dbuser = 'steinfek-db';
    $dbpass = '0PtDR9x9gpYWLNwZ';
    
    $tableName = 'contributors';
    
    // Create connection
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    echo 'Successfully connected to database!';
    
    $sql = "SELECT * FROM $tableName ORDER BY midi_count DESC LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        //create html table
        echo "<table border=1 style=width:100%><tr><th>user_name</th><th>midi_count</th><th>link_latest</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["user_name"]. "</td><td>" . $row["midi_count"]. "</td><td>" . $row["link_latest"]. "</td></tr>";
        }
    } else {
        echo "0 results!!";
    }
    
    mysql_close($mysql_handle);
    
    ?>
<!--
<div class="container">
<div class="row">
<h3>Top Contributors</h3>
</div>

<div class="row">
<div class="jumbotron">
<table class="table table-bordered" border=1 style=width:100%>
<tr>
<td>Top Contributor 1</td>
<td>Midi-chlorian count</td>
<td>Link to Latest Contribution</td>
</tr>
<tr>
<td>Top Contributor 2</td>
<td>Midi-chlorian count</td>
<td>Link to Latest Contribution</td>
</tr>
<tr>
<td>Top Contributor 3</td>
<td>Midi-chlorian count</td>
<td>Link to Latest Contribution</td>
</tr>
<tr>
<td>Top Contributor 4</td>
<td>Midi-chlorian count</td>
<td>Link to Latest Contribution</td>
</tr>
<tr>
<td>Top Contributor 5</td>
<td>Midi-chlorian count</td>
<td>Link to Latest Contribution</td>
</tr>
</table>
</div>
</div>
</div>
-->
<?php include('footer.php') ?>