<?php session_start(); ?>
<?php require("botdetect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>BotDetect PHP CAPTCHA Features Demo</title>
  <link type="text/css" rel="Stylesheet" href="stylesheet.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
</head>
<body>
  <form method="post" action="" id="form1">

    <h1>BotDetect PHP CAPTCHA Features Demo</h1>

    <fieldset>
      <legend>PHP CAPTCHA validation</legend>
      <label for="CaptchaCode">Retype the characters from the picture:</label>
      
      <?php // Adding BotDetect Captcha to the page
        $FeaturesDemoCaptcha = new Captcha("FeaturesDemoCaptcha");
        $FeaturesDemoCaptcha->UserInputID = "CaptchaCode";

        if ($_POST && isset($_POST['ApplyCaptchaSettings'])) {
          if (isset($_POST['Locale'])) {
            $FeaturesDemoCaptcha->Locale = $_POST['Locale'];
          }
          if (isset($_POST['CodeLength']) && 0 != strcmp($_POST['CodeLength'], 'default')) {
            $FeaturesDemoCaptcha->CodeLength = $_POST['CodeLength'];
          } else {
            $FeaturesDemoCaptcha->CodeLength = null;
          }
          if (isset($_POST['CodeStyle'])) {
            $FeaturesDemoCaptcha->CodeStyle = $_POST['CodeStyle'];
          }
          if (isset($_POST['ImageStyle']) && 0 != strcmp($_POST['ImageStyle'], 'default')) {
            $FeaturesDemoCaptcha->ImageStyle = $_POST['ImageStyle'];
          } else {
            $FeaturesDemoCaptcha->ImageStyle = null;
          }
          if (isset($_POST['CustomLightColor'])) {
            $FeaturesDemoCaptcha->CustomLightColor = $_POST['CustomLightColor'];
          }
          if (isset($_POST['CustomDarkColor'])) {
            $FeaturesDemoCaptcha->CustomDarkColor = $_POST['CustomDarkColor'];
          }
          if (isset($_POST['ImageFormat'])) {
            $FeaturesDemoCaptcha->ImageFormat = $_POST['ImageFormat'];
          }
          if (isset($_POST['ImageWidth'])) {
            $FeaturesDemoCaptcha->ImageWidth = $_POST['ImageWidth'];
          }
          if (isset($_POST['ImageHeight'])) {
            $FeaturesDemoCaptcha->ImageHeight = $_POST['ImageHeight'];
          }
          if (isset($_POST['SoundStyle']) && 0 != strcmp($_POST['SoundStyle'], 'default')) {
            $FeaturesDemoCaptcha->SoundStyle = $_POST['SoundStyle'];
          } else {
            $FeaturesDemoCaptcha->SoundStyle = null;
          }
          if (isset($_POST['SoundFormat'])) {
            $FeaturesDemoCaptcha->SoundFormat = $_POST['SoundFormat'];
          }
        }
        
        echo $FeaturesDemoCaptcha->Html(); ?>

      <div class="validationDiv">
          <input name="CaptchaCode" type="text" id="CaptchaCode" />
          <input type="submit" name="ValidateCaptchaButton" value="Validate" id="ValidateCaptchaButton" />

          <?php // Captcha user input validation (only if the form was sumbitted)
            if ($_POST && isset($_POST['ValidateCaptchaButton'])) {
              $isHuman = $FeaturesDemoCaptcha->Validate();
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

    <fieldset id="CodeProperties">
      <legend>CAPTCHA Code Properties</legend>
      <table cellpadding="5" cellspacing="0" summary="CAPTCHA Properties layout table">
        <tr>
          <td class="left">
            <label for="Locale"><span>Locale:</span></label>
          </td>
          <td>
            <select name="Locale" id="Locale">
              <option <?php if ($FeaturesDemoCaptcha->Locale == 'en-Latn-US') { echo 'selected="selected" '; } ?> value="en-US">en-US</option>
              <option <?php if ($FeaturesDemoCaptcha->Locale == 'en-Latn-CA') { echo 'selected="selected" '; } ?> value="en-CA">en-CA</option>
              <option <?php if ($FeaturesDemoCaptcha->Locale == 'fr-Latn-CA') { echo 'selected="selected" '; } ?> value="fr-CA">fr-CA</option>
              <option <?php if ($FeaturesDemoCaptcha->Locale == 'es-Latn-MX') { echo 'selected="selected" '; } ?> value="es-MX">es-MX</option>
            </select>
          </td>
          <td></td>
        </tr>
        <tr>
          <td class="left">
            <label for="CodeLength"><span>Code Length:</span></label>
          </td>
          <td>
            <select name="CodeLength" id="CodeLength">
              <option value="default">[Default (4-6)]</option>
              <?php
                for($i=1; $i<=15; $i++) { ?>
                  <option <?php if (isset($_POST['CodeLength']) && 0 == strcmp($_POST['CodeLength'], $i)) { echo 'selected="selected"'; }?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                  <?php
                }
              ?>
            </select>
          </td>
          <td></td>
        </tr>
        <tr>
          <td class="left">
            <label for="CodeStyle"><span>Code Style:</span></label>
          </td>
          <td>
            <select name="CodeStyle" id="CodeStyle">
              <?php
                foreach (CodeStyle::$Names as $value => $name) { ?>
                  <option <?php if ($FeaturesDemoCaptcha->CodeStyle == $value) { echo 'selected="selected"'; }?> value="<?php echo $value; ?>"><?php echo $name; ?></option>
                  <?php
                }
              ?>
            </select>
          </td>
          <td></td>
        </tr>
      </table>
    </fieldset>
    <fieldset id="ImageProperties">
        <legend>CAPTCHA Image Properties</legend>
        <table cellpadding="5" cellspacing="0" summary="CAPTCHA Properties layout table">
          <tr>
            <td class="left">
              <label for="ImageStyle"><span>Image Style:</span></label>
            </td>
            <td>
              <select name="ImageStyle" id="ImageStyle">
                <option value="default">[Default]</option>
                <?php
                $names = ImageStyle::$Names;
                asort($names);
                foreach ($names as $value => $name) { ?>
                  <option <?php if (isset($_POST['ImageStyle']) && 0 == strcmp($_POST['ImageStyle'], $value)) { echo 'selected="selected"'; }?> value="<?php echo $value; ?>"><?php echo $name; ?></option>
                  <?php
                }
              ?>
              </select>
            </td>
            <td></td>
          </tr>
          <tr>
            <td class="left">
              <label for="CustomLightColor"><span>Custom Light Color:</span></label>
            </td>
            <td>
              <select name="CustomLightColor" id="CustomLightColor">
                <option value="">[Default]</option>
                <?php
                foreach (LBD_HtmlColor::$Names as $value => $name) { ?>
                  <option <?php if (!is_null($FeaturesDemoCaptcha->CustomLightColor) && 0 == strcmp($FeaturesDemoCaptcha->CustomLightColor->ToHexString(), $value)) { echo 'selected="selected"'; }?> value="<?php echo $value; ?>"><?php echo $name; ?></option>
                  <?php
                }
              ?>
              </select>
            </td>
            <td></td>
          </tr>
          <tr>
            <td class="left">
              <label for="CustomDarkColor"><span>Custom Dark Color:</span></label>
            </td>
            <td>
              <select name="CustomDarkColor" id="CustomDarkColor">
                <option value="">[Default]</option>
                <?php
                foreach (LBD_HtmlColor::$Names as $value => $name) { ?>
                  <option <?php if (!is_null($FeaturesDemoCaptcha->CustomDarkColor) && 0 == strcmp($FeaturesDemoCaptcha->CustomDarkColor->ToHexString(), $value)) { echo 'selected="selected"'; }?> value="<?php echo $value; ?>"><?php echo $name; ?></option>
                  <?php
                }
              ?>
              </select>
            </td>
            <td></td>
          </tr>
          <tr>
            <td class="left">
            <label for="ImageFormat"><span>Image Format:</span></label>
          </td>
          <td>
            <select name="ImageFormat" id="ImageFormat">
              <?php
                foreach (ImageFormat::$Names as $value => $name) { ?>
                  <option <?php if ($FeaturesDemoCaptcha->ImageFormat == $value) { echo 'selected="selected"'; }?> value="<?php echo $value; ?>"><?php echo $name[0]; ?></option>
                  <?php
                }
              ?>
            </select>
          </td>
          <td></td>
          </tr>
          <tr>
            <td class="left">
              <label for="ImageWidth">Image Width:</label>
            </td>
            <td>
              <input name="ImageWidth" id="ImageWidth" type="text" class="textboxSmall" value="<?php echo $FeaturesDemoCaptcha->ImageWidth ?>" />&nbsp;px
            </td>
            <td></td>
          </tr>
          <tr>
            <td class="left">
              <label for="ImageHeight">Image Height:</label>
            </td>
            <td>
              <input name="ImageHeight" id="ImageHeight" type="text" class="textboxSmall" value="<?php echo $FeaturesDemoCaptcha->ImageHeight ?>" />&nbsp;px
            </td>
            <td></td>
          </tr>
          </table>
        </fieldset>
        <fieldset id="AudioProperties">
        <legend>CAPTCHA Audio Properties</legend>
        <table cellpadding="5" cellspacing="0" summary="CAPTCHA Properties layout table">
          <tr>
            <td class="left">
            <label for="SoundStyle"><span>Sound Style:</span></label>
          </td>
          <td>
            <select name="SoundStyle" id="SoundStyle">
              <option value="">[Default]</option>
              <?php
                foreach (SoundStyle::$Names as $value => $name) { ?>
                  <option <?php if (isset($_POST['SoundStyle']) && 0 == strcmp($_POST['SoundStyle'], $value)) { echo 'selected="selected"'; }?> value="<?php echo $value; ?>"><?php echo $name; ?></option>
                  <?php
                }
              ?>
            </select>
          </td>
          <td></td>
          </tr>
          <tr>
            <td class="left">
            <label for="SoundFormat"><span>Sound Format:</span></label>
          </td>
          <td>
            <select name="SoundFormat" id="SoundFormat">
              <?php
                foreach (SoundFormat::$Names as $value => $name) { ?>
                  <option <?php if ($FeaturesDemoCaptcha->SoundFormat == $value) { echo 'selected="selected"'; }?> value="<?php echo $value; ?>"><?php echo $name; ?></option>
                  <?php
                }
              ?>
            </select>
          </td>
          <td></td>
          </tr>
        </table>
    </fieldset>


    <input type="submit" name="ApplyCaptchaSettings" value="Apply" id="ApplyButton" />


    <div id="notes">
      <div class="note">
        <h3>Description</h3>
        <p>This demo allows you to easily experiment with various BotDetect parameters and their combinations, so you can see how powerful and customizable BotDetect Captcha is.</p>
        <p>Please note that values in brackets (such as <code>[Default]</code> and <code>[Random]</code>) are not actual parameter values you can use directly in your code.</p>
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
