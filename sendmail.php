<?php

$from = 'number8pie@gmail.com';
$subject = $_POST['subject'];
$text = $_POST['message'];

$dbc = mysqli_connect('localhost', 'lee', 'lee1', 'mailing_list')
				or die('Error connecting to MySQL server.');

$query = "SELECT * FROM email_list";
$result = mysqli_query($dbc, $query)
				or die('Error querying database.');

$success = "";

while ($row = mysqli_fetch_array($result)) {
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];

	$msg = "Dear $first_name $last_name, \n $text";
	$to = $row['email'];

	mail($to, $subject, $msg, 'From: ' . $from);
	echo 'Email sent to: ' . $to . '<br /> <a href="index.html">Return.</a>' ;
}

mysqli_close($dbc);
?> 