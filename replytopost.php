<?php
include 'db_include.php';
doDB();

//check to see if we're showing the form or adding the post
if (!$_POST) {
   // showing the form; check for required item in query string
   if (!isset($_GET['post_id'])) {
      header("Location: topiclist.php");
      exit;
   }

   //create safe values for use
   $safe_post_id = mysqli_real_escape_string($mysqli, $_GET['post_id']);

   //still have to verify topic and post
   $verify_sql = "SELECT ft.topic_id, ft.topic_title FROM forum_posts
                  AS fp LEFT JOIN forum_topics AS ft ON fp.topic_id =
                  ft.topic_id WHERE fp.post_id = '".$safe_post_id."'";

   $verify_res = mysqli_query($mysqli, $verify_sql)
                 or die(mysqli_error($mysqli));

   if (mysqli_num_rows($verify_res) < 1) {
      //this post or topic does not exist
      header("Location: topiclist.php");
      exit;
   } else {
      //get the topic id and title
      while($topic_info = mysqli_fetch_array($verify_res)) {
         $topic_id = $topic_info['topic_id'];
         $topic_title = stripslashes($topic_info['topic_title']);
      }
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $topic_title; ?></title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1>Bradley's CSCI 450 Website</h1>
			</div>
			<div id="content">
				<nav>
					<h3>Navigation</h3>
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="Paper.html">Tech Trends Paper</a></li>
						<li><a href="Contact.html">Contact</a></li>
						<li><a href="layout.html">Layout Practice</a></li>
						<li><a href="chapter04.html">Color Buttons</a></li>
						<li><a href="helloworld.php">Hello World</a></li>
						<li><a href="ButtonMove.html">Moving Buttons</a></li>
						<li><a href="sort.html">Sort Demo</a></li>
						<li><a href="businesscard.html">Card Demo</a></li>
						<li><a href="dynamiccarddemo.html">Dynamic Card Demo</a></li>
						<li><a href="keypress.html">KeyPress Demo</a></li>
						<li><a href="jquerydemo.html">JQuery Demo</a></li>
						<li><a href="audiochanger.html">Audio Demo</a></li>
						<li><a href="prime.html">Prime Numbers</a></li>
						<li><a href="livesearch.html">Live Searching</a></li>
						<li><a href="vowelsort.php">Vowel Sort</a></li>
						<li><a href="personrecords.php">Person Records</a></li>
						<li><a class="selected" href="topiclist.php">Forums</a></li>
					</ul>
				</nav>
				<div id="main">
					<h1>Posting To: <?php echo $topic_title; ?></h1>
					<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<h3><label for="post_owner">Username:</label>
						<input type="text" id="post_owner" name="post_owner" size="40" maxlength="150" required="required"></h3>
						<h3><label for="post_text">Post Text:</label></h3>
						<textarea id="post_text" name="post_text" rows="14" cols="80" required="required"></textarea><br>
						<input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
						<button type="submit" name="submit" value="submit">Add Post</button>
					</form>
				</div>
			</div>
			<div id="footer">
				USC Upstate CSCI450 Summer 2022
			</div>
		</div>
	</body>
	<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/xhtml.min.js"></script>
	<script>
		var textarea = document.getElementById('post_text');
		sceditor.create(textarea, {
			format: 'xhtml',
			style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css'
		});
	</script>
</html>
<?php
    //free result
    mysqli_free_result($verify_res);

    //close connection to MySQL
    mysqli_close($mysqli);
   }

} else if ($_POST) {
    //check for required items from form
    if ((!$_POST['topic_id']) || (!$_POST['post_text']) ||
        (!$_POST['post_owner'])) {
        header("Location: topiclist.php");
        exit;
    }

    //create safe values for use
    $safe_topic_id = mysqli_real_escape_string($mysqli, $_POST['topic_id']);
    $safe_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);
    $safe_post_owner = mysqli_real_escape_string($mysqli, $_POST['post_owner']);

    //add the post
    $add_post_sql = "INSERT INTO forum_posts (topic_id,post_text,
                    post_create_time,post_owner) VALUES
                    ('".$safe_topic_id."', '".$safe_post_text."',
                    now(),'".$safe_post_owner."')";
    $add_post_res = mysqli_query($mysqli, $add_post_sql)
                    or die(mysqli_error($mysqli));

    //close connection to MySQL
    mysqli_close($mysqli);

    //redirect user to topic
    header("Location: showtopic.php?topic_id=".$_POST['topic_id']);
    exit;
}
?>