<?php

$dbc = mysqli_connect('localhost', 'lee', 'lee1', 'mailing_list')
				or die('Error connecting to MySQL server.');

$email = $_POST['email'];

$query = "DELETE FROM email_list WHERE email='$email'";

mysqli_query($dbc, $query);

echo "Sorry to see you go! Your email has been removed from the mailing list.<br /><a href='index.html'>Return to main page.</a>";

mysqli_close($dbc);

?>