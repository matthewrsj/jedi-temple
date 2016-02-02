<?php include('header.php') ?>
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
  <div class="container">
    <div class="row">
      <h3>Top Articles</h3>
    </div>
    <div class="row">
      <div class="jumbotron">
        <div>
          <?php
            $dbhost = 'oniddb.cws.oregonstate.edu';
            $dbname = 'malickc-db';
            $dbuser = 'malickc-db';
            $dbpass = 'Jz8QJFUt65lTYY16';
            $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
                or die("Error connecting to database server");

            mysql_select_db($dbname, $mysql_handle)
                or die("Error selecting database: $dbname");
            $query = "SELECT articles.title, articles.url, articles.user_id, articles.id, articles.category_id,
                articles.midichlorians, users.username, categories.name, articles.time_submitted
                FROM articles, users, categories
                WHERE articles.user_id = users.id AND articles.category_id = categories.id
                ORDER BY articles.midichlorians DESC
                LIMIT 10";
            $articles = mysql_query($query);
              while($row = mysql_fetch_array($articles)) {
            echo "
          <div class='container'>
			<div class='row'>
            <div class='row' id='article" . $row['id'] . "'>
              <h5><a href='" . $row["url"] . "'>" . $row['title'] . "</a>  " .
                $row["midichlorians"] . " </h5>
              <p><h6>Submitted by: " . $row["username"] . "</h6></p>
              <p><h6>" . $row["name"] . "</h6></p>
              </div>";
              if (checkAuth(false) != "") {
              echo "
              <div class='form-group'>

                <button class='btn btn-default' type='upvote' onclick='upvote(" . $row["id"] .");' name='upvote'>Upvote</button>

                <button class='btn btn-default' type='downvote' onclick='downvote(" . $row["id"] . ");' name='downvote'>Downvote</button>
                  </div>
                  </div>
                  </div>
                  <hr>
                ";
                }
              else {
                echo "Log in to vote on this article.<hr>";
                }
              }

          ?>
		</div>
      </div>
    </div>


  </div>

<?php include('footer.php') ?>
