<?php session_start(); ?>
<?php require("botdetect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>Multiple BotDetect CAPTCHAs PHP Sample</title>
  <link type="text/css" rel="Stylesheet" href="stylesheet.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
</head>
<body>
  <form method="post" action="" id="form1">

    <h1>Multiple BotDetect CAPTCHAs PHP Sample</h1>

    <h2>Page 1</h2>

    <fieldset>
      <legend>PHP CAPTCHA validation</legend>
      <label for="CaptchaCode">Retype the characters from the picture:</label>

      <?php // Adding BotDetect Captcha to the page
        $Page1Captcha = new Captcha("Page1Captcha");
        $Page1Captcha->UserInputID = "CaptchaCode1";
        $Page1Captcha->ImageStyle = ImageStyle::Bullets2;
        $Page1Captcha->CodeStyle = CodeStyle::Numeric;
        $Page1Captcha->CodeLength = 6;
        echo $Page1Captcha->Html();
      ?>

      <div class="validationDiv">
        <input type="text" name="CaptchaCode1" id="CaptchaCode1" />
        <input type="submit" name="ValidateCaptchaButton" value="Validate" id="ValidateCaptchaButton" />

        <?php // when the form is submitted
          if ($_POST) {
            // validate the Captcha to check we're not dealing with a bot
            $isHuman = $Page1Captcha->Validate();

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

    <p class="navigation">&bull;&nbsp;<span>Page 1</span>&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;<a href="page2.php">Page 2</a></p>

    <div id="notes">
      <div class="note">
        <h3>Description</h3>
        <p>This sample project shows how to have multiple Captcha-protected pages within the same PHP website.</p>
        <p>As long as the Captcha instances have different names (<code>Page1Captcha</code> and <code>Page2Captcha</code> in the sample), they can have completely separate settings and won't interfere with each other's validation.</p>
        <p>Even if a user opens the same page in multiple browser tabs, each tab will properly validate the shown Captcha code. </p>
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