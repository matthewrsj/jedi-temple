<?php include('header.php') ?>
    <div class="container">
      <div class="row">
        <h3>Add Article</h3>
      </div>
      <div class="row">
        <div class="jumbotron">
          <form class="" action="index.html" method="post">
            <div class="form-group">
              <label for="title">Title</label>
              <input class="form-control" type="textbox" id="title" name="title" value="" placeholder="Title">
            </div>
            <div class="form-group">
              <label for="link">Link to Article</label>
              <input class="form-control" type="textbox" id="link" name="link" value="" placeholder="url">
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control" name="">
                <option value="network">Network Security</option>
                <option value="physical">Physical Security</option>
                <option value="cryptography">Cryptography</option>
                <option value="misc">Misc</option>
              </select>
            </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default" name="submit">Add Article</button>
              </div>
          </form>
        </div>

      </div>
    </div>
<?php include('footer.php') ?>
