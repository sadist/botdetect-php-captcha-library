<?php session_start(); ?>
<?php require("botdetect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>BotDetect PHP CAPTCHA Customization Sample</title>
  <link type="text/css" rel="Stylesheet" href="stylesheet.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
</head>
<body>
  <form method="post" action="" id="form1">

    <h1>BotDetect PHP CAPTCHA Customization Sample</h1>

    <fieldset>
      <legend>PHP CAPTCHA validation</legend>
      <label for="CaptchaCode">Retype the characters from the picture:</label>

      <?php // Adding BotDetect Captcha to the page
        $CustomizedCaptcha = new Captcha("CustomizedCaptcha");
        $CustomizedCaptcha->UserInputID = "CaptchaCode";
        echo $CustomizedCaptcha->Html();
      ?>

      <div class="validationDiv">
        <input name="CaptchaCode" type="text" id="CaptchaCode" />
        <input type="submit" name="ValidateCaptchaButton" value="Validate" id="ValidateCaptchaButton" />

        <?php // when the form is submitted
          if ($_POST) {
            // validate the Captcha to check we're not dealing with a bot
            $isHuman = $CustomizedCaptcha->Validate();

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
    
    <h4>Custom BotDetect Client-Side Events Debug Log</h4>
    <div id="output"></div>

    <script type="text/javascript">
      function log(text) {
        var output = document.getElementById('output');
        var line = document.createElement('pre');
        line.innerHTML = timestamp() + ' ' + text;
        output.insertBefore(line, output.firstChild);
      }
      
      function timestamp() {
        return new Date().toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
      }
      
      function format(url) {
        return url.replace(/^.*?\?/g, '').replace(/&/g, '\n  &');
      }

      // custom javascript handler executed before Captcha sounds are played
      BotDetect.RegisterCustomHandler('PrePlaySound', function() { 
        log('PrePlaySound: ' + this.Id); 
      });
      
      // custom javascript handler executed before Captcha images are reloaded
      BotDetect.RegisterCustomHandler('PreReloadImage', function() { 
        log('PreReloadImage:\n  ' + format(this.Image.src) + '\n  AutoReload: ' + this.AutoReloading); 
      });
      
      // custom javascript handler executed after Captcha images are reloaded
      BotDetect.RegisterCustomHandler('PostReloadImage', function() { 
        log('PostReloadImage:\n  ' + format(this.Image.src)); 
      });
    </script>

    <div id="notes">
      <div class="note">
        <h3>Description</h3>
        <p>This sample project shows how to customize BotDetect Captcha behavior and appearance.</p>
        <p>BotDetect 3.0 allows user-defined customization of many Captcha options through a special <code>CaptchaConfig.php</code> configuration file; some customizations also require page source changes.</p>
        <p>Shown customizations include: Captcha image color scheme, sound &amp; reload icons and their tooltips, custom client-side handlers for BotDetect actions such as sound playing and Captcha reloading (resulting in simple debug messages on icon clicks in this sample), ...</p>
        <p>The <code>CaptchaConfig.php</code> file used in this sample project contains detailed descriptions and explanations of the many customizable options.</p>
        <p>You can then use chosen customization options to configure BotDetect to precisely match your application requirements.</p>
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