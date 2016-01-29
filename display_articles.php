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
      <div class="jumbotron">
        <div>
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
          <div class='container'>
			<div class='row'>
            <div class='row' id='article" . $row['id'] . "'>
              <h5><a href='" . $row["url"] . "'>" . $row['title'] . "</a>  " .
                $row["midichlorians"] . " </h5>
              <p><h6>Submitted by: " . $row["username"] . "</h6></p>
              <p><h6>" . $row["name"] . "</h6></p>
              </div>";
              if (checkAuth(false) == "") {
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
			<nav>
				<ul class = "pagination">
			<?php 
				$sql = "SELECT * FROM articles";
				$rs_result = mysql_query($sql); //run the query
				$total_records = mysql_num_rows($rs_result);  //count number of records
				$total_pages = floor($total_records / $num_rec_per_page);

				echo "<li><a href='display_articles.php?page=1'>".'|<'."</a></li> "; // Goto 1st page  

				for ($i=1; $i<=$total_pages; $i++) { 
								echo "<li><a href='display_articles.php?page=".$i."'>".$i."</a><li> "; 
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
