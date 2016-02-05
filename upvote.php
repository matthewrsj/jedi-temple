<?php
		$dbhost = 'oniddb.cws.oregonstate.edu';
		$dbname = 'malickc-db';
		$dbuser = 'malickc-db';
		$dbpass = 'Jz8QJFUt65lTYY16';
		$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
			or die("Error connecting to database server");

		mysql_select_db($dbname, $mysql_handle)
			or die("Error selecting database: $dbname");

		$query = "UPDATE articles
			JOIN users ON articles.user_id = users.id
			SET articles.midichlorians = articles.midichlorians +1,
			users.midichlorians = users.midichlorians + 1
			WHERE articles.id = " . $_GET['id'];
		mysql_query($query);

			$start_from = ($page-1) * $num_rec_per_page;
			$query = "SELECT *, users.midichlorians AS umidichlorians, articles.midichlorians AS amidichlorians
						FROM articles
						JOIN users ON articles.user_id = users.id
						JOIN categories ON articles.category_id = categories.id
						WHERE articles.id = ". $_GET['id'];
            $articles = mysql_query($query);
              while($row = mysql_fetch_array($articles)) {
								//Sanatize outputs from html/javascript injection
								$title = htmlspecialchars($row["title"]);
								$midichlorians = htmlspecialchars($row["amidichlorians"]);
								$username = htmlspecialchars($row["username"]);
								$name = htmlspecialchars($row["name"]);
			   echo "
              <h6 class='list-group-item-heading'><b>" .
              $title . " </b></h6>" .
              "<p class='list-group-item-text'>User: " . $username .
              "<br>Category: " . $name .
              "</p><p class='list-group-item-text'>Midichlorians: <span class='badge'>" . $midichlorians . "</span></p>
              ";
              }
		?>
