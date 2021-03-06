<?php include('connectdb.php') ?>
<?php
session_start();

function checkAuth($doRedirect) {
  if (isset($_SESSION["onidid"]) && $_SESSION["onidid"] != "") return $_SESSION["onidid"];

   $pageURL = 'http';
   if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
   $pageURL .= "://";
   if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
   } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
   }

  $ticket = isset($_REQUEST["ticket"]) ? $_REQUEST["ticket"] : "";

  if ($ticket != "") {
    $url = "https://login.oregonstate.edu/cas/serviceValidate?ticket=".$ticket."&service=".$pageURL;
    $html = file_get_contents($url);
    $pattern = '/\\<cas\\:user\\>([a-zA-Z0-9]+)\\<\\/cas\\:user\\>/';
    preg_match($pattern, $html, $matches);
    if ($matches && count($matches) > 1) {
      $onidid = $matches[1];
      $_SESSION["onidid"] = $onidid;

      $checkUserID = mysql_query("SELECT * FROM users WHERE users.username = '$onidid'");

    if (!$checkUserID) {
        die('Query failed to execute for some reason');
    }

    if (mysql_num_rows($checkUserID) == false) {
        $email = $onidid."@oregonstate.edu";
        $insert_query = "INSERT INTO users(id, username, email, midichlorians)
                         VALUES (NULL, '$onidid', '$email', 0 )";
        $result = mysql_query($insert_query);
        if (!$result) {
          die('Invalid query: ' . mysql_error());
        }
    }
      return $onidid;
    }
  } else if ($doRedirect) {
    $url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
    echo "<script>location.replace('" . $url . "');</script>";
  }
  return "";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Jedi Temple</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  </head>

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Jedi Temple</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <li class="Articles">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Articles<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-inverse">
            <li><a href="top_articles.php">Top Articles</a></li>
            <li><a href="display_articles.php">All Articles</a></li>
            <li><a href="categorize_articles.php">By Category</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="add_article.php">Submit Article</a></li>
          </ul>
        </li>
        <li class=""><a href="rss_feed.php">RSS Feed<span class="sr-only">(current)</span></a></li>
        <li><a href="top_contributors.php">Top Contributors</a></li>
      </ul>
      <?php if (checkAuth(false) == "") {
      echo "<ul class='nav navbar-nav navbar-right'>
        <li><a href='login_handler.php'>Login</a></li>
        </ul>";
      } else {
      echo "
      <ul class='nav navbar-nav navbar-right'>";
      $onidid = $_SESSION['onidid'];
      $midicount = mysql_query("SELECT midichlorians, username FROM users WHERE users.username = '$onidid'");
      if (!$midicount) {
          die('Query failed to execute for some reason');
      }
      while ($row = mysql_fetch_array($midicount)){
        echo "<li><a>" . $row['username'] . "</a></li>
          <li><a><span class='badge'>" . $row["midichlorians"] . "</span></a></li>
          <li><a href='profile.php'>User Profile</a></li>";
      }
      echo "</ul>";
      mysql_close($mysql_handle);
  } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  <body>
    <!-- start body -->
