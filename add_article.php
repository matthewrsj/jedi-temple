<?php include('header.php') ?>
    <div class="container">
      <div class="row">
        <h3>Add Article</h3>
      </div>
      <div class="row">
        <div class="jumbotron">
          <form class="" action="article_post.php" method="POST">
            <div class="form-group">
              <label for="title">Title</label>
              <input class="form-control" type="textbox" id="title" name="title" value="" placeholder="Title">
            </div>
            <div class="form-group">
              <label for="url">Link to Article</label>
              <input class="form-control" type="textbox" id="url" name="url" value="" placeholder="url">
            </div>
            <div class="form-group">
              <label for="category_id">Category</label>
              <select class="form-control" name="category_id">
                <?php
                    $dbhost = 'oniddb.cws.oregonstate.edu';
                    $dbname = 'malickc-db';
                    $dbuser = 'malickc-db';
                    $dbpass = 'Jz8QJFUt65lTYY16';

                    $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
                        or die("Error connecting to database server");

                    mysql_select_db($dbname, $mysql_handle)
                        or die("Error selecting database: $dbname");

                    $query = "SELECT categories.id, categories.name
                        FROM categories";

                    $categories = mysql_query($query);
                      while($row = mysql_fetch_array($categories)) {
                        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                      }
                      mysql_close($mysql_handle);
                  ?>
              </select>
            </div>
            <?php if (checkAuth(false) != "") { ?>
              <div class="form-group">
                <button type="submit" class="btn btn-default" name="submit">Add Article</button>
              </div>
            <?php } else { ?>
              <div class="form-group">
                <p>You must log in first!</p>
              </div>
            <?php } ?>
          </form>
        </div>

      </div>
    </div>
<?php include('footer.php') ?>
