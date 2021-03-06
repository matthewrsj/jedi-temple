<?php include('header.php') ?>
<?php include('connectdb.php') ?>
    <div class="container">
      <div class="row">
        <h3>Add Article</h3>
      </div>
      <div class="row">
        <div class="jumbotron">
          <form class="" action="article_post.php" method="POST">
            <div class="form-group">
              <label for="title">Title</label>
              <input class="form-control" type="textbox" id="title" name="title" value="" placeholder="Title" required autofocus>
            </div>
            <div class="form-group">
              <label for="url">Link to Article</label>
              <input class="form-control" type="url" id="url" name="url" value="" placeholder="http://example.com/sweet-article" required>
            </div>
            <div class="form-group">
              <label for="category_id">Category</label>
              <select class="form-control" name="category_id">
                <?php
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
            <input type="hidden" id="username" name="username" value="<?php $_SESSION["onidid"] ?>">
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
