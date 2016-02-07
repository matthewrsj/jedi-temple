<script>
function downvote(id){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
	if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
		document.getElementById( "article" + id ).innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET", "downvote.php?id=" + id, true);
	xmlhttp.send();
}
function upvote(id){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
	if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
		document.getElementById( "article" + id ).innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET", "upvote.php?id=" + id, true);
	xmlhttp.send();
}
</script>
<?php include('header.php') ?>
  <div class="container">
    <div class="row">
    <h2><?php echo $onidid; ?></h2>
<?php
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'malickc-db';
$dbuser = 'malickc-db';
$dbpass = 'Jz8QJFUt65lTYY16';
$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
  or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)
  or die("Error selecting database: $dbname");
$query = "SELECT midichlorians FROM users WHERE users.username = '$onidid'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)){
  echo "<h5>Your Midichlorian Count: <span class='badge'>" . $row['midichlorians'] . "</span></h5>";
}
?>
    </div>
    <div class="row">
    <h4>Contributed Articles</h4>
    <nav>
        <ul class = "pagination">
<?php
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'malickc-db';
$dbuser = 'malickc-db';
$dbpass = 'Jz8QJFUt65lTYY16';
$num_rec_per_page = 5;
$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
  or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)
  or die("Error selecting database: $dbname");
if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page = 1; };

$start_from = ($page-1) * $num_rec_per_page;
$query1 = "SELECT articles.title, articles.url, articles.user_id, articles.id, articles.category_id,
           articles.midichlorians, users.username, categories.name, articles.time_submitted
           FROM articles, users, categories
           WHERE articles.user_id = users.id AND articles.category_id = categories.id AND users.username = '$onidid'";
$res = mysql_query($query1);
$total_records = mysql_num_rows($res);
  $total_pages = floor($total_records / $num_rec_per_page);

echo "<li><a href='profile.php?page=1'>".'|<'."</a></li> "; // Goto 1st page

echo "<li><a href='profile.php?page=1&category=$category'>1</a></li> ";

if ($page < 4) {
    $istart = 2;
} else {
    $istart = $page - 2;
}

if ($page > $total_pages - 2) {
    $iend = $total_pages;
} else {
    $iend = $page + 2;
}

for ($i=$istart; $i<$iend + 1; $i++) {
   echo "<li><a href='profile.php?page=".$i."'>".$i."</a></li> ";
};
echo "<li><a href='profile.php?page=$total_pages'>".'>|'."</a></li> "; // Goto last page
mysql_close($mysql_handle);
?>
</ul></nav></div>
    <div class="row">
      <div class="list-group">
          <?php
            $dbhost = 'oniddb.cws.oregonstate.edu';
            $dbname = 'malickc-db';
            $dbuser = 'malickc-db';
            $dbpass = 'Jz8QJFUt65lTYY16';
			$num_rec_per_page = 5;
            $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
                or die("Error connecting to database server");

            mysql_select_db($dbname, $mysql_handle)
                or die("Error selecting database: $dbname");
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
			$start_from = ($page-1) * $num_rec_per_page;
            $query = "SELECT articles.title, articles.url, articles.user_id, articles.id, articles.category_id,
                articles.midichlorians, users.username, categories.name, articles.time_submitted
                FROM articles, users, categories
                WHERE articles.user_id = users.id AND articles.category_id = categories.id AND users.username = '$onidid'
                ORDER BY articles.time_submitted DESC
                LIMIT $start_from, $num_rec_per_page";
            $articles = mysql_query($query);
              while($row = mysql_fetch_array($articles)) {

								//Sanatize outputs from html/javascript injection
								$id = htmlspecialchars($row["id"]);
								$url = htmlspecialchars($row["url"]);
								$title = htmlspecialchars($row["title"]);
								$midichlorians = htmlspecialchars($row["midichlorians"]);
								$username = htmlspecialchars($row["username"]);
								$name = htmlspecialchars($row["name"]);

								echo "
           <a class='list-group-item' id='article" . $id . "' href='" . $url . "'>
              <h6 class='list-group-item-heading'><b>" .
              $title . " </b></h6>" .
              "<p class='list-group-item-text'>User: " . $username .
              "<br>Category: " . $name .
              "</p><p class='list-group-item-text'>Midichlorians: <span class='badge'>" . $midichlorians . "</span></p></a>
              ";
              if (checkAuth(false) != "") {
              echo "
              <div class='form-group'>
                <button class='btn btn-default' type='upvote' onclick='upvote(" . $id .");' name='upvote' style='color:green; font-weight:bold'> + </button>
                <button class='btn btn-default' type='downvote' onclick='downvote(" . $id . ");' name='downvote' style='color:red; font-weight:bold'> - </button>
              </div>
                ";
                }
              else {
                echo "Log in to vote on this article.
                ";
                }
              }

          ?>
		</div>
</div><!-- / main list group -->
    <div class="row">
    <nav>
        <ul class = "pagination">
<?php
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'malickc-db';
$dbuser = 'malickc-db';
$dbpass = 'Jz8QJFUt65lTYY16';
$num_rec_per_page = 5;
$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
  or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)
  or die("Error selecting database: $dbname");
if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page = 1; };

$start_from = ($page-1) * $num_rec_per_page;
$query1 = "SELECT articles.title, articles.url, articles.user_id, articles.id, articles.category_id,
           articles.midichlorians, users.username, categories.name, articles.time_submitted
           FROM articles, users, categories
           WHERE articles.user_id = users.id AND articles.category_id = categories.id AND users.username = '$onidid'";
$res = mysql_query($query1);
$total_records = mysql_num_rows($res);
  $total_pages = floor($total_records / $num_rec_per_page);

echo "<li><a href='profile.php?page=1'>".'|<'."</a></li> "; // Goto 1st page

echo "<li><a href='profile.php?page=1&category=$category'>1</a></li> ";

if ($page < 4) {
    $istart = 2;
} else {
    $istart = $page - 2;
}

if ($page > $total_pages - 2) {
    $iend = $total_pages;
} else {
    $iend = $page + 2;
}

for ($i=$istart; $i<$iend + 1; $i++) {
   echo "<li><a href='profile.php?page=".$i."'>".$i."</a></li> ";
};
echo "<li><a href='profile.php?page=$total_pages'>".'>|'."</a></li> "; // Goto last page
mysql_close($mysql_handle);
?>
</ul></nav></div>
</div>
