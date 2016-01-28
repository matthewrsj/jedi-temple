<?php include('header.php') ?>
<div class="container">
  <div class="row">
    <h1>Logging in to Jedi Temple...</h1>
  </div>
  <?php if (checkAuth(true) != ""){ ?>
    <p>Success!</p>
    <a href="index.php">Back to Home Page</a>
  <?php } else { ?>
    <p>Login Failure...</p>
    <a href="login_handler.php">Try Again</a>
  <?php } ?>
</div>
