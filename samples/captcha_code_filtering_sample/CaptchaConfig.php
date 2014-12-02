<?php

// override lib settings
$LBD_CaptchaConfig = CaptchaConfiguration::GetSettings();

$LBD_CaptchaConfig->CustomCharset = 'A,B,C,D';
$LBD_CaptchaConfig->BannedSequences = 'd,aa,bb,cc,abc,bca,cab';

$LBD_CaptchaConfig->HelpLinkMode = HelpLinkMode::Image;

?>