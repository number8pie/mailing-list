<?php

$page = "sendmail";

$host = "localhost";
$username = "lee";
$password = "lee1";
$database = "mailing_list";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$from = 'number8pie@gmail.com';
	$subject = $_POST['subject'];
	$text = $_POST['message'];

	if (empty($subject) && empty($text)) {
		$error = "You forgot to write your subject and message.";
	}

	if (empty($subject) && !empty($text)) {
		$error = "You forgot to write your subject.";
	}

	if (!empty($subject) && empty($text)) {
		$error = "You forgot to write your message.";
	}

	if (!empty($subject) && !empty($text)) {
		$dbc = mysqli_connect("$host", "$username", "$password", "$database")
						or die('Error connecting to MySQL server.');

		$query = "SELECT * FROM email_list";
		$result = mysqli_query($dbc, $query)
						or die('Error querying database.');

		while ($row = mysqli_fetch_array($result)) {
			
			require 'inc/class.phpmailer.php';
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = 'smtp';
			$mail->SMTPAuth = true;
			$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
			$mail->Port = 465;
			$mail->SMTPSecure = 'ssl';
			// or try these settings (worked on XAMPP and WAMP):
			// $mail->Port = 587;
			// $mail->SMTPSecure = 'tls';


			$mail->Username = "number8pie@gmail.com";
			$mail->Password = "sinbinwin290909";

			$mail->IsHTML(true); // if you are going to send HTML formatted emails

			$mail->From = $from;
			$mail->FromName = "Lee Thomas";

			$mail->Subject = $subject;
			$mail->Body = "Dear $first_name $last_name, \n $text";

			if(!$mail->Send())
			    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
			else
			    echo 'Email sent to: ' . $to . '<br />';

			$mail->ClearAllRecipients();

		}

		mysqli_close($dbc);
	}
}

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>number8pie's mass mailer</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>

    <div class="row">
      <div class="medium-6 medium-offset-3 columns">
        <h1>Send an Email</h1>
      </div>
    </div>

    <div class="row">
      <div class="medium-6 medium-offset-3 columns">
        <p>Enter the subject and the email message and it will be sent out to everyone in the database.</p>
      </div>
    </div>

    <?php 
    if (!empty($error)) {
    	echo
		    "<div class='row'>
		      <div class='medium-6 medium-offset-3 columns'>
		        <p class='error-msg'>" . $error ."</p>
		      </div>
		    </div>"
		  ;
    }
    ?>

    <div class="row">
      <div class="medium-6 medium-offset-3 columns">
        <p></p>
      </div>
    </div>

    <div class="row">
      <div class="medium-6 medium-offset-3 columns">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label for="subject">Subject:</label>
          <input type="text" id="subject" name="subject" value="<?php if(!empty($subject)){echo $subject;}?>"></input>
          <label for="message">Message:</label>
          <textarea id="message" name="message" rows="5"><?php if (!empty($text)) {echo $text;}?></textarea>
          <input class="button" type="submit"></input>
        </form>
      </div>
    </div>

<?php include_once("inc/nav.php"); ?>

    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>