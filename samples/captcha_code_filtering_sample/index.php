<?php session_start(); ?>
<?php require("botdetect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>BotDetect PHP CAPTCHA Code Filtering Sample</title>
  <link type="text/css" rel="Stylesheet" href="stylesheet.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
</head>
<body>
  <form method="post" action="" id="form1">

    <h1>BotDetect PHP CAPTCHA Code Filtering Sample</h1>

    <fieldset>
      <legend>PHP CAPTCHA validation</legend>
      <label for="CaptchaCode">Retype the characters from the picture:</label>

      <?php // Adding BotDetect Captcha to the page
        $CodeFilteredCaptcha = new Captcha("CodeFilteredCaptcha");
        $CodeFilteredCaptcha->UserInputID = "CaptchaCode";
        echo $CodeFilteredCaptcha->Html();
      ?>

      <div class="validationDiv">
        <input name="CaptchaCode" type="text" id="CaptchaCode" />
        <input type="submit" name="ValidateCaptchaButton" value="Validate" id="ValidateCaptchaButton" />

        <?php // when the form is submitted
          if ($_POST) {
            // validate the Captcha to check we're not dealing with a bot
            $isHuman = $CodeFilteredCaptcha->Validate();

            if (!$isHuman) {
              // Captcha validation failed, show error message
              echo "<span class=\"incorrect\">Incorrect code</span>";
            } else {
              // Captcha validation passed, perform protected action
              echo "<span class=\"correct\">Correct code</span>";
            }
          }
        ?>
      </div>

    </fieldset>

    <div id="notes">
      <div class="note">
        <h3>Description</h3>
        <p>This sample project shows how to use the new CAPTCHA code filtering functionality added in BotDetect 3.0.</p>
        <p>You can define rules about character sequences you want to avoid using in randomly generated CAPTCHA codes and simply pass them to the Captcha library.</p>
        <p>The <code>CaptchaConfig.php</code> file defines a simplified custom character set (using only <code>'A'</code>, <code>'B'</code>, <code>'C'</code> and <code>'D'</code>), which helps make the code filtering easier to track in action.</p>
        <p>The <code>$LBD_CaptchaConfig->BannedSequences</code> setting in the same file shows how to create your own banned sequence definitions to suit your application needs. The following sequences will never appear in Captcha codes generated in the sample: <code>D</code>, <code>AA</code>, <code>BB</code>, <code>CC</code>, <code>ABC</code>, <code>BCA</code>, <code>CAB</code>.</p>
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