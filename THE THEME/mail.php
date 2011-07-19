<html>
<head><title>PHP Mail Sender</title></head>
<body>
<?php

/* All form fields are automatically passed to the PHP script through the array $HTTP_POST_VARS. */
$email = 'youremail@gmail.com';
$subject = 'New email subscriber!';
$message = $HTTP_POST_VARS['email'];

/* PHP form validation: the script checks that the Email field contains a valid email address and the Subject field isn't empty. preg_match performs a regular expression match. It's a very powerful PHP function to validate form fields and other strings - see PHP manual for details. */
if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $message)) {
  echo "<h4>Invalid email address</h4>";
  echo "<a href='javascript:history.back(1);'>Back</a>";
}

/* Sends the mail and outputs the "Thank you" string if the mail is successfully sent, or the error string otherwise. */
elseif (mail($email,$subject,$message)) {
  echo "<h4>Thank you for sending email</h4>";
  echo "<a href='javascript:history.back(1);'>Back</a>";
} else {
  echo "<h4>Can't send email to $email</h4>";
}
?>
</body>
</html> 