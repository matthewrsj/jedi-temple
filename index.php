<?php include('header.php') ?>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2>Home</h2>
    </div>
    <div class="col-md-3">

    </div>
  </div>
  <div class="row">
    <div class="jumbotron container-fluid">
      <div class="col-md-3">
        <label for="">Latest Feed</label><br>
        <!-- start feedwind code --><script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "https://threatpost.com/feed",rssmikle_frame_width: "140",rssmikle_frame_height: "400",frame_height_by_article: "3",rssmikle_target: "_blank",rssmikle_font: "Arial, Helvetica, sans-serif",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "on",scrolldirection: "up",scrollstep: "5",mcspeed: "20",sort: "Off",rssmikle_title: "off",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#0066FF",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "55",rssmikle_item_title_color: "#666660",rssmikle_item_border_bottom: "on",rssmikle_item_description: "title_only",item_link: "on",rssmikle_item_description_length: "150",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:140px;"><a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS Feed Widget</a><!--Please display the above link in your web page according to Terms of Service.--></div><!-- end feedwind code --><!--  end  feedwind code -->
    </div>
     <div class="col-md-3">
        <label for="">Latest Articles</label>
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
                    </div>
                </div>
				<hr>
			";
            }
			mysql_close($mysql_handle);
        ?>
      </div>
      <div class="col-md-3">
        <label for="">Most Influencial Articles</label>
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
              articles.midichlorians, users.username, categories.name
              FROM articles, users, categories
              WHERE articles.user_id = users.id AND articles.category_id = categories.id
							GROUP BY articles.title
							ORDER BY articles.midichlorians DESC
							LIMIT 5
							";
        	$articles = mysql_query($query);
            while($row = mysql_fetch_array($articles)) {
        	echo "
				<div class='container'>
					<div class='row'>
						<h5><a href='" . $row["url"] . "'>" . $row['title'] . "</a> - " .
							$row["midichlorians"] . " </h5>
						<p><h6>User: " . $row["username"] . "</h6></p>
						<p><h6>" . $row["name"] . "</h6></p>
                    </div>
                </div>
				<hr>
			";
            }
			mysql_close($mysql_handle);
		?>
      </div>
      <div class="col-md-3">
        <label for="">Most Powerful Contributors</label>
          <?php

            $dbhost = 'oniddb.cws.oregonstate.edu';
            $dbname = 'malickc-db';
            $dbuser = 'malickc-db';
            $dbpass = 'Jz8QJFUt65lTYY16';


            // Create connection
            $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
                or die("Error connecting to database server");

            mysql_select_db($dbname, $mysql_handle)
                or die("Error selecting database: $dbname");

            $query = "SELECT * FROM users ORDER BY midichlorians DESC LIMIT 5";
            $contributors = mysql_query($query);

            // output data of each row
            while($row = mysql_fetch_array($contributors)) {
                echo "
              <div class='container'>
                <div class='row'>
                  <h4>".$row["username"]."</h4>
                  <p><h6>Midichlorians: ".$row["midichlorians"]."</h6></p>
                  </div>
                </div>";
            }

            mysql_close($mysql_handle);

            ?>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php') ?>
