<?php

$dbc = mysqli_connect('localhost', 'lee', 'lee1', 'mailing_list')
				or die('Error connecting to MySQL server.');

$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];

$query = "INSERT INTO email_list (first_name, last_name, email) " .
					"VALUES ('$first_name', '$last_name', '$email')";

mysqli_query($dbc, $query);

echo "Success! You've been added to the mailing list! <a href='index.html'>Return to main page.</a>";

mysqli_close($dbc);

?>