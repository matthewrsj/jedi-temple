<!DOCTYPE html>
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

			return $onidid;

		} 

	} else if ($doRedirect) {

		$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;

		echo "<script>location.replace('" . $url . "');</script>";

	} 

	return "";

}


?>
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
  </head>

  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Jedi Temple</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <!-- <li><a href="#">Link</a></li> -->
        <li class="Articles">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Articles<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="display_articles.php">Latest Articles</a></li>
            <li><a href="display_articles.php">All Articles</a></li>
            <!--<li><a href="add_article.php">Submit an Article</a></li> -->
            <!-- <li><a href="#">Something else here</a></li> -->
            <li role="separator" class="divider"></li>
            <li><a href="add_article.php">Submit Article</a></li>
            <!-- <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li> -->
          </ul>
        </li>
        <li class=""><a href="rss_feed.php">RSS Feed<span class="sr-only">(current)</span></a></li>
        <li><a href="top_contributors.php">Top Contributors</a></li>
      </ul>
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  <body>
    <!-- start body -->
<?php checkAuth(true) ?>
