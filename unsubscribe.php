<?php

$page = "unsubscribe";

$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $dbc = mysqli_connect('localhost', 'lee', 'lee1', 'mailing_list')
          or die('Error connecting to MySQL server.');

  $email = $_POST['email'];

  if (empty($email)) {
    $error_msg = "You must enter your email address to be taken off the mailing list.";
  }

  if (!empty($email)) {
    $query = "DELETE FROM email_list WHERE email='$email'";

    mysqli_query($dbc, $query);

    $success_msg = "Sorry to see you go! Your email has been removed from the mailing list.";
  }

  mysqli_close($dbc);
}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>number8pie's mailing list</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>

    <div class="row">
      <div class="medium-6 medium-offset-3 columns">
        <h1>Unsubscribe</h1>
      </div>
    </div>

    <div class="row">
      <div class="medium-6 medium-offset-3 columns">
        <p>Enter your email address below hit submit and, you will no longer be on the mailing list.</p>
      </div>
    </div>

    <?php

    if (!empty($error_msg)) {
      echo
        "<div class='row'>
          <div class='medium-6 medium-offset-3 columns'>
            <p class='error-msg'>" . $error_msg ."</p>
          </div>
        </div>"
      ;
    }

    if (!empty($success_msg)) {
      echo
        "<div class='row'>
          <div class='medium-6 medium-offset-3 columns'>
            <p class='success-msg'>" . $success_msg ."</p>
          </div>
        </div>"
      ;
    } else {
    ?>

    <div class="row">
      <div class="medium-6 medium-offset-3 columns">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label for="email">Email:</label>
          <input type="text" id="email" name="email"></input>
          <input class="button" type="submit"></input>
        </form>
      </div>
    </div>

    <?php
    }
    ?>

<?php include_once("inc/nav.php"); ?>

    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>