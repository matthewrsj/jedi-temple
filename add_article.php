<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add Articles</title>
  </head>
  <body>
    <h3>Add Article</h3>
    <form class="" action="index.html" method="post">
      <label for="title">Title</label>
      <input type="textbox" id="title" name="title" value="" placeholder="Title"><br>
      <label for="link">Link to Article</label>
      <input type="textbox" id="link" name="link" value="" placeholder="url"><br>
      <label for="author">Author</label>
      <select class="author" name="author">
        <option value="Cody">Cody</option>
        <option value="Other...">Other...</option>
      </select><br>
      <label for="category">Category</label>
      <select class="category" name="">
        <option value="network">Network Security</option>
        <option value="physical">Physical Security</option>
        <option value="cryptography">Cryptography</option>
        <option value="misc">Misc</option>
      </select><br>
      <button type="submit" name="submit">Add Article</button>
    </form>
  </body>
</html>
</html>
