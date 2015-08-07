<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="color:#fff !important;">
<?php
if(isset($_POST['email'])) {
	
	// EDIT THE 2 LINES BELOW AS REQUIRED //info@parkplace.tv
	$email_to = "jassim.talat@gmail.com, mahrukh.jassim@gmail.com";  
	$email_subject = "Park Place Studio - Feedback";
	
	
	function died($error) {
		// your error code can go here
		echo "<p style='color:#F4CABD !important; font-family: Arial;'>We are very sorry, but there were error(s) found with the form your submitted.</p> ";
		echo "<p style='color:#F4CABD !important; font-family: Arial;'>These errors appear below.</p><br /><br />";
		echo $error."<br /><br />";
		echo "<p style='font: color:#aaa !important; font-family: Arial;'>Please go back and fix these errors.</p><br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['full_name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['telephone']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form your submitted.');		
	}
	
	$full_name = $_POST['full_name']; // required
	$email_from = $_POST['email']; // required
	$telephone = $_POST['telephone']; // not required
	$comments = $_POST['comments']; // required
	
	$error_message = "";
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
  if(!eregi($email_exp,$email_from)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
	$string_exp = "^[a-z .'-]+$";
  if(!eregi($string_exp,$full_name)) {
  	$error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
  	$error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  $string_exp = "^[0-9 .-]+$";
  if(!eregi($string_exp,$telephone)) {
  	$error_message .= 'The Telphone Number you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Form details below.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Name: ".clean_string($full_name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Telephone: ".clean_string($telephone)."\n";
	$email_message .= "Comments: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>


<!-- include your own success html here -->
<iframe frameborder="0" class="frame" src="thankyou.html" style="width:470px;"></iframe>

<?

}
?>

</body>
</html>