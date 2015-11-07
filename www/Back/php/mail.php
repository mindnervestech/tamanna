<?php 
	
	// your email
	$user_email = "";
	$subject = "Mail from CosyOne";

	$mail = array(
		"name" => htmlspecialchars($_POST['cf_name']),
		"email" => htmlspecialchars($_POST['cf_email']),
		"telephone" => htmlspecialchars($_POST['cf_telephone']),
		"message" => htmlspecialchars($_POST['cf_message'])
	);
	
	function validate($arr){

		return !empty($arr['name']) && strlen($arr['message']) > 20 && filter_var($arr['email'],FILTER_VALIDATE_EMAIL);

	}

	if(validate($mail)){

		echo mail($user_email, $subject, 
			"Name : {$mail['name']}\n" 
			."E-mail : {$mail['email']}\n"
			. "Telephone : {$mail['telephone']}\n"
			."Message : {$mail['message']}"
		);

	}


?>