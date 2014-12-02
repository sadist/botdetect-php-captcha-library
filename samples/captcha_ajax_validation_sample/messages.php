<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>PHP Built-In Ajax Captcha Validation Code Sample</title>
  <link type="text/css" rel="Stylesheet" href="stylesheet.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

  <h1>PHP Built-In Ajax Captcha Validation Code Sample</h1>
  
  <h2>View Messages</h2>

  <?php
    $count = 0;
    foreach($_SESSION as $key => $val) {
      if (false !== strpos($key, "Message_") && isset($val)) {
        echo "<p class='message'>${val}</p>";
        $count++;
      }
    }
    
    if ($count == 0) {
      echo '<p class="message">No messages yet.</p>';
    }
  ?>
  
  <br />
  
  <p class="navigation"><a href="index.php">Add Message</a></p>
  
  <div id="notes">
    <div class="note">
      <h3>Description</h3>
      <p>This sample project shows how to add BotDetect CAPTCHA protection to a typical PHP form.</p> 
      <p>Captcha validation is integrated with other form fields validation, and only submissions that meet all validation criteria are accepted.</p> 
      <p>This kind of validation could be used on various types of public forms which accept messages, and are at risk of unwanted automated submissions.</p> 
      <p>For example, it could be used to ensure bots can't submit anything to a contact form, add guestbook entries, blog post comments or anonymous message board / forum replies.</p> 
    </div>
  </div>
    
</body>
</html>
