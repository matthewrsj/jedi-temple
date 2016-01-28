<?php include('header.php') ?>
  <div class="container">
    <div class="row">
      <h3>Current Articles</h3>
    </div>
    <div class="row">
      <div class="jumbotron">
        <form class="" action="index.html" method="post">
          <?php
            $dbhost = 'oniddb.cws.oregonstate.edu';
            $dbname = 'malickc-db';
            $dbuser = 'malickc-db';
            $dbpass = 'Jz8QJFUt65lTYY16';

            $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
                or die("Error connecting to database server");

            mysql_select_db($dbname, $mysql_handle)
                or die("Error selecting database: $dbname");

            $query = "SELECT articles.title, articles.url, articles.user_id, articles.category_id,
                articles.midichlorians, users.username, categories.name, articles.time_submitted
                FROM articles, users, categories
                WHERE articles.user_id = users.id AND articles.category_id = categories.id
                ORDER BY articles.time_submitted DESC
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
              ";
              if (checkAuth(false) != "") {
              echo "
              <div class='form-group'>

                <button class='btn btn-default' type='upvote' name='upvote'>Upvote</button>

                <button class='btn btn-default' type='downvote' name='downvote'>Downvote</button>
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

          mysql_close($mysql_handle);
          ?>
        </form>
      </div>
    </div>


  </div>

<?php include('footer.php') ?>
