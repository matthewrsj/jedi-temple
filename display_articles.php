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
      <h3>Current Articles</h3>
    </div>
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
                WHERE articles.user_id = users.id AND articles.category_id = categories.id
                ORDER BY articles.time_submitted DESC
                LIMIT $start_from, $num_rec_per_page";
            $articles = mysql_query($query);
              while($row = mysql_fetch_array($articles)) {
            echo "
            <a class='list-group-item' id='article" . $row["id"] . "' href='" . $row["url"] . "'>
              <h6 class='list-group-item-heading'><b>" . 
              $row['title'] . " </b><span class='badge'>" . $row["midichlorians"] . "</span></h6>" .
              "<p class='list-group-item-text'>User: <span class='badge'>" . $row["username"] . 
              "</span><br>Category: <span class='badge'>" . $row["name"] .
              "</span></p></a>
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
			<nav>
				<ul class = "pagination">
			<?php 
            $query1 = "SELECT articles.title, articles.url, articles.user_id, articles.id, articles.category_id,
                articles.midichlorians, users.username, categories.name, articles.time_submitted
                FROM articles, users, categories
                WHERE articles.user_id = users.id AND articles.category_id = categories.id";
             $res = mysql_query($query1);
            $total_records = mysql_num_rows($res);
				$total_pages = floor($total_records / $num_rec_per_page);
        echo "total_records ".$total_records;

				echo "<li><a href='display_articles.php?page=1'>".'|<'."</a></li> "; // Goto 1st page  

        echo "<li><a href='display_articles.php?page=1'>1</a></li> ";

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
								echo "<li><a href='display_articles.php?page=".$i."'>".$i."</a></li> "; 
				}; 
				echo "<li><a href='display_articles.php?page=$total_pages'>".'>|'."</a></li> "; // Goto last page
			  mysql_close($mysql_handle);
			?>
				</ul>
			</nav>
      </div>
    </div>


  </div>

<?php include('footer.php') ?>
