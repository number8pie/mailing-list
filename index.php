<?php

$page = "index";

$host = "localhost";
$username = "lee";
$password = "lee1";
$database = "mailing_list";

$error = "";
$success_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $dbc = mysqli_connect("$host", "$username", "$password", "$database")
          or die('Error connecting to MySQL server.');

  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $email = $_POST['email'];

  if (empty($first_name)) {
    $error .= "first name,";
  }

  if (empty($last_name)) {
    $error .= " last name,";
  }

  if (empty($email)) {
    $error .= " email address";
  }

  if (!empty($first_name) && !empty($last_name) && !empty($email)) {
    $query = "INSERT IGNORE INTO email_list (first_name, last_name, email) " .
              "VALUES ('$first_name', '$last_name', '$email')";

    mysqli_query($dbc, $query);

    $success_msg = "Thank you! You have now been added to the mailing list!";
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
        <h1>Mailing List</h1>
      </div>
    </div>

    <div class="row">
      <div class="medium-6 medium-offset-3 columns">
        <p>Enter your first name, last name and email address below to be added to our mailing list.</p>
      </div>
    </div>

    <?php

    $error_msg = "Make sure to fill out the ". $error ." fields to be added to the mailing list.";

    if (!empty($error)) {
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
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php if(!empty($first_name)){echo $first_name;}?>"></input>
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php if(!empty($last_name)){echo $last_name;}?>"></input>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php if(!empty($email)){echo $email;}?>"></input>
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