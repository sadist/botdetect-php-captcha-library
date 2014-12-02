<?php session_start(); ?>
<?php require("botdetect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>PHP Built-In Ajax Captcha Validation Code Sample</title>
  <link type="text/css" rel="Stylesheet" href="stylesheet.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
</head>
<body>
  <form method="post" action="process_form.php" id="form1">

    <h1>PHP Built-In Ajax Captcha Validation Code Sample</h1>

    <fieldset>
      <legend>CAPTCHA included in PHP form validation</legend>

      <div class="input">
        <label for="Name">Name:</label>
        <input type="text" name="Name" id="Name" class="textbox" value="<?php echo getValue('Name');?>" />
        <?php echo getValidationStatus("NameValidator"); ?>
      </div>

      <div class="input">
        <label for="Email">Email:</label>
        <input type="text" name="Email" id="Email" class="textbox" value="<?php echo getValue('Email');?>" />
        <?php echo getValidationStatus("EmailValidator"); ?>
      </div>

      <div class="input">
        <label for="Message">Short message:</label>
        <textarea class="inputbox" id="Message" name="Message" rows="5" cols="40"><?php echo getValue('Message');?></textarea>
        <?php echo getValidationStatus("MessageValidator"); ?>
      </div>


      <div class="input">
      <?php // Adding BotDetect Captcha to the page

      $AjaxValidationCaptcha = new Captcha("AjaxValidationCaptcha");
      $AjaxValidationCaptcha->UserInputID = "CaptchaCode";
      $AjaxValidationCaptcha->CodeLength = 3;
      $AjaxValidationCaptcha->ImageWidth = 150;
      $AjaxValidationCaptcha->ImageStyle = ImageStyle::Graffiti2;

      // only show the Captcha if it hasn't been already solved for the current message
      if(!$AjaxValidationCaptcha->IsSolved) { ?>
        <label for="CaptchaCode">Retype the characters from the picture:</label>

        <?php echo $AjaxValidationCaptcha->Html(); ?>
        <input type="text" name="CaptchaCode" id="CaptchaCode" class="textbox" />

        <?php echo getValidationStatus("CaptchaValidator");
      } ?>
      </div>

      <input type="submit" name="SubmitButton" id="SubmitButton" value="Submit" onclick="return validateForm();"/>

    </fieldset>
    
    <?php
      // remember user input if validation fails
      function getValue($fieldName) {
        $value = '';
        if (isset($_REQUEST[$fieldName])) { 
          $value = $_REQUEST[$fieldName];
        }
        return $value;
      }

      // server-side validation message helper function
      function getValidationStatus($validator) {
        $requestParam = substr($validator, 0, -4);
        $messageHtml = '<span class="incorrect" id="' . $validator . '" style="display:';

        if ((isset($_REQUEST[$requestParam]) && $_REQUEST[$requestParam] == 0)) {
          // server-side field validation failed, show validator
          $messageHtml .= 'inline';
        } else {
          // server-side field validation passed, hide validator
          $messageHtml .= 'none';
        }

        $messageHtml .= ';">*</span>';

        return $messageHtml;
      }
    ?>

  <script type="text/javascript" src="validation.js"></script>

    <div id="notes">
      <div class="note">
        <h3>Description</h3>
        <p>This sample project shows how to properly perform Ajax CAPTCHA validation using built-in BotDetect client-side functionality, which doesn't require any 3rd party Ajax frameworks.</p>
        <p>It uses the Captcha Form Sample as a starting point, and adds client-side validation of all form fields.</p>
        <p>Ajax CAPTCHA validation improves the user experience by reducing CAPTCHA validation response time, giving users much faster feedback about the validation result.</p>
        <p>Client-side validation is not secure by itself (it can be bypassed trivially), so the sample also shows how the protected form action must always be secured by server-side CAPTCHA validation as well.</p>
        <p>In case of any Ajax errors or timeouts, the sample simply falls back to full form posting and server-side CAPTCHA validation.</p>
      </div>

      <?php if (Captcha::IsFree()) { ?>
      <div class="note warning">
        <h3>Free Version Limitations</h3>
        <ul>
          <li>The free version of BotDetect includes a randomized <code>BotDetect™</code> trademark in the background of 50% of all Captcha images generated.</li>
          <li>It also has limited sound functionality, replacing the CAPTCHA sound with "SOUND DEMO" for randomly selected 50% of all CAPTCHA codes.</li>
          <li>Lastly, the bottom 10 px of the CAPTCHA image are reserved for a link to the BotDetect website.</li>
        </ul>
        <p>These limitations are removed if you <a href="http://captcha.com/shop.html?utm_source=installation&amp;utm_medium=php&amp;utm_campaign=3.0.0" title="BotDetect CAPTCHA online store, pricing information, payment options, licensing &amp; upgrading">upgrade</a> your BotDetect license.</p>
      </div>
      <?php } ?>
    </div>
  </form>
</body>
</html>
