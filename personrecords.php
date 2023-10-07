<!--personrecords.php-->

<?php
$msg = "";
if(isset($_POST['submit'])){
	$mysqli = mysqli_connect("sql105.epizy.com", "epiz_31874089", "z1dgcBtuQYGA", "epiz_31874089_persondb");

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	} else {
		$firstname = mysqli_real_escape_string($mysqli, $_POST['firstnamefield']);
		$lastname = mysqli_real_escape_string($mysqli, $_POST['lastnamefield']);
		$email = mysqli_real_escape_string($mysqli, $_POST['emailfield']);
		$sql = "INSERT INTO person (last_name, first_name, email) VALUES ('".$lastname."', '".$firstname."', '".$email."')";
		$res = mysqli_query($mysqli, $sql);

		if ($res === TRUE) {
			$msg = "Record successfully inserted.";
		} else {
			printf("Could not insert record: %s\n", mysqli_error($mysqli));
		}

		mysqli_close($mysqli);
	}
}  

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Person Records</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
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
						<li><a class="selected" href="personrecords.php">Person Records</a></li>
						<li><a href="topiclist.php">Forums</a></li>
					</ul>
				</nav>
				<div id="main">
					<form method="POST">
						<p><label for="firstnamefield">First Name:</label>
						<input type="text" id="firstnamefield" name="firstnamefield" size="30"></p>
						<p><label for="lastnamefield">Last Name:</label>
						<input type="text" id="lastnamefield" name="lastnamefield" size="30"></p>
						<p><label for="emailfield">Email Address:</label>
						<input type="email" id="emailfield" name="emailfield" size="30"></p>
						<button type="submit" name="submit" value="insert">Insert Record</button>
						<br>
						<br>
						<?php echo $msg; ?>
					</form>
					<?php
						if(array_key_exists("displayAll", $_POST)) {
							displayAll();
						}
						function displayAll() {
							$mysqli = mysqli_connect("sql105.epizy.com", "epiz_31874089", "z1dgcBtuQYGA", "epiz_31874089_persondb");

							if (mysqli_connect_errno()) {
								printf("Connect failed: %s\n", mysqli_connect_error());
								exit();
							} else {
								$sql = "SELECT * FROM person ORDER BY last_name";
								$res = mysqli_query($mysqli, $sql);

								if (mysqli_num_rows($res) > 0) {
									// output data of each row
									while($row = mysqli_fetch_assoc($res)) {
										echo "Name: " . $row["first_name"]. " " . $row["last_name"]. " - Email: " . $row["email"]."<br>";
									}
								} else {
									printf("Failed to display records: No records");
								}

								mysqli_close($mysqli);
							}
						}
					?>	
					<form method="POST">
						<button type="submit" name="displayAll" id="displayAll">Display All People</button>
					</form>
				</div>
			</div>
			<div id="footer">
				USC Upstate CSCI450 Summer 2022
			</div>
		</div>
	</body>
</html>