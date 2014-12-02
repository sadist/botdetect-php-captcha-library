<?php

// override lib settings
$LBD_CaptchaConfig = CaptchaConfiguration::GetSettings();


// Captcha code length randomization
$LBD_CaptchaConfig->CodeLength = CaptchaRandomization::GetRandomCodeLength(3, 5);


// Captcha code style randomization, option 1: randomly use all possible code styles
//$LBD_CaptchaConfig->CodeStyle = CaptchaRandomization::GetRandomCodeStyle();

// Captcha code style randomization, option 2: randomly choose from the given set of code styles
//$LBD_CaptchaConfig->CodeStyle = CaptchaRandomization::GetRandomCodeStyle(array(CodeStyle::Numeric, CodeStyle::Alpha));

// Captcha code style randomization, option 3: dependent on code length
switch($LBD_CaptchaConfig->CodeLength) {
  case 3:
    $LBD_CaptchaConfig->CodeStyle = CodeStyle::Alphanumeric;
    break;
  case 4:
    $LBD_CaptchaConfig->CodeStyle = CodeStyle::Alpha;
    break;
  case 5:
    $LBD_CaptchaConfig->CodeStyle = CodeStyle::Numeric;
    break;
}


// Captcha image style randomization, randomly choose from the given set of image styles
$imageStyles = array(
  ImageStyle::Chipped, 
  ImageStyle::Negative, 
  ImageStyle::Radar, 
  ImageStyle::Fingerprints, 
  ImageStyle::Graffiti2, 
  ImageStyle::Bullets, 
  ImageStyle::Collage
);
$LBD_CaptchaConfig->ImageStyle = CaptchaRandomization::GetRandomImageStyle($imageStyles);


// Captcha sound style randomization, randomly choose from the given set of sound styles
$soundStyles = array(
  SoundStyle::Dispatch, 
  SoundStyle::RedAlert, 
  SoundStyle::Synth
);
$LBD_CaptchaConfig->SoundStyle = CaptchaRandomization::GetRandomSoundStyle($soundStyles);


$LBD_CaptchaConfig->HelpLinkMode = HelpLinkMode::Image;

?>