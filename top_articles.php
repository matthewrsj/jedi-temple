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
      <div class="list-group">
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
           <a class='list-group-item' id='article" . $row["id"] . "' href='" . $row["url"] . "'>
              <h6 class='list-group-item-heading'><b>" . 
              $row['title'] . " </b><span class='badge'>" . $row["midichlorians"] . "</span></h6>" .
              "<p class='list-group-item-text'>User: " . $row["username"] . 
              "<br>Category: " . $row["name"] .
              "</p></a>
              ";              
              if (checkAuth(false) != "") {
              echo "
              <div class='form-group'>
                <button class='btn btn-default' type='upvote' onclick='upvote(" . $row["id"] .");' name='upvote'>Upvote</button>
                <button class='btn btn-default' type='downvote' onclick='downvote(" . $row["id"] . ");' name='downvote'>Downvote</button>
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
      </div>
    </div>


  </div>

<?php include('footer.php') ?>
