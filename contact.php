<?php 
//var_dump($_REQUEST);
$captcha = $_REQUEST['g-recaptcha-response'];
 
/* Check if captcha is filled */
if (!$captcha || strlen($captcha)==0) {
    echo "Missing Captcha!"; // Return error if there is no captcha
} else {
	$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdDyQUTAAAAAKpjbTvOXQuB0lyN9mYmqjFvPXg4&response=".$captcha));
	//var_dump($response);
	if ($response->success=="false") {
	    echo "We don't believe that you're not a robot.";
	    http_response_code(401); // It's SPAM! RETURN SOME KIND OF ERROR
	} else {
	   // Everything is ok and you can proceed by executing your login, signup, update etc scripts
	   if (isset($_REQUEST['email']) && isset($_REQUEST['name']) && isset($_REQUEST['comments']) && (strlen($_REQUEST['honeypot'])==0)) {
		  
		  $name = $_REQUEST['name'] ;
		  $email = $_REQUEST['email'] ;
		  $email = preg_replace("/[^A-Za-z0-9 ]/", '', $name) . ' <' . $email . '>' ;
		  $comments = $_REQUEST['comments'] ;
		  $support = "JoCo Cruise Info <info@jococruisecrazy.com>" ;
		    
		  mail($email, "Website Inquiry: JoCo Cruise",//
		  "Hi, thanks for writing. A real person will read this message and get back to you.
		  \nName: $name
		  \nComments: $comments\n", //
		  "From: $support\r\nCC: $support\r\nX-Mailer: PHP/" . phpversion()."\r\n\r\n");
		
		  echo "Thank you for getting in touch!";
		}
	}
}

?>