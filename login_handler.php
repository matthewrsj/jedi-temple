<?php include('header.php') ?>
<div class="container">
  <div class="row">
    <h1>Logging in to Jedi Temple...</h1>
  </div>
  <?php checkAuth(true) ?>
    <p>Success!</p>
    <a href="index.php">Back to Home Page</a>
</div>
