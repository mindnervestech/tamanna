<?php
	
/* Email Address */	
$to = '';

/* Subject */
$subject = 'CosyOne Newsletter Form';

/* Headers */
$headers = 'From: CosyOne' . "\r\n" .
    'Reply-To: cosyone@cosyone.com' . "\r\n";

$email = $_POST['newsletter-email'];
$name = $_POST['newsletter-name'];

if(isset($email) && !empty($email)){
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

		$message = !empty($name) ? 'Name: '.$name.', Email: '.$email : 'Email: '.$email;
		echo mail($to, $subject, $message, $headers);
	}else{
		echo 2;
	}
	
}

?>