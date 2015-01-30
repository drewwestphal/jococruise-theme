<?php 
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
?>