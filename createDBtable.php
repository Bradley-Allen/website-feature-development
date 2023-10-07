<?php
$mysqli = mysqli_connect("sql105.epizy.com", "epiz_31874089", "z1dgcBtuQYGA", "epiz_31874089_persondb");

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
} else {
	$sql = "CREATE TABLE person 
		(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		last_name VARCHAR(255) NOT NULL,
		first_name VARCHAR(255) NOT NULL,
		email VARCHAR(255) NOT NULL
		);";
	$res = mysqli_query($mysqli, $sql);

	if ($res === TRUE) {
	   	echo "Table person successfully created.";
	} else {
		printf("Could not create table: %s\n", mysqli_error($mysqli));
	}

	mysqli_close($mysqli);
}
?>