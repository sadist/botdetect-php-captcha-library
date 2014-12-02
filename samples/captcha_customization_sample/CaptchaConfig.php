<?php

// override lib settings
$LBD_CaptchaConfig = CaptchaConfiguration::GetSettings();


// Captcha code configuration
// ---------------------------------------------------------------------------

// Captcha code length, in characters
$LBD_CaptchaConfig->CodeLength = 4;

// Captcha code style (alphanumeric, alpha, or numeric)
$LBD_CaptchaConfig->CodeStyle = CodeStyle::Alpha;

// Captcha code timeout in seconds - the Captcha can only be successfully
// solved within the specified time after generation. This is an optional
// security improvement that narrows the window of opportunity for attacks
// based on re-using the Captcha image on another site controlled by the
// attacker, or similar human-solver-based attacks on Captcha-protected
// forms.
$LBD_CaptchaConfig->CodeTimeout = 600;

// Captcha locale string, affecting the charset used for Captcha code
// generation, and the pronunciation language used for sound Captchas
$LBD_CaptchaConfig->Locale = 'en-US';

// Defines a custom character set for Captcha code generation, specifying
// the alphanumeric characters which will be used for all Captcha codes
// regardless of the codeStyle value set
$LBD_CaptchaConfig->CustomCharset = 'A,B,C,D,E,1,2,3,4';

// Defines rules about character sequences you want to avoid using in
// randomly generated Captcha codes. Must be a CSV string. 
// NOTE: see Captcha Code Filtering Sample for an example.
$LBD_CaptchaConfig->BannedSequences = '';


// Captcha image configuration
// ---------------------------------------------------------------------------

// Captcha image style - can be a fixed or a randomized value selected from
// the 60 BotDetect image drawing algorithms
$LBD_CaptchaConfig->ImageStyle = CaptchaRandomization::GetRandomImageStyle();

// Captcha image width, in pixels
$LBD_CaptchaConfig->ImageWidth = 250;

// Captcha image height, in pixels
$LBD_CaptchaConfig->ImageHeight = 50;

// Captcha image output format (JPG, GIF, PNG or BMP)
$LBD_CaptchaConfig->ImageFormat = ImageFormat::Png;

// Used to override the default Captcha image color scheme.
// Html named or hex color value of the dark color used in Captcha images.
$LBD_CaptchaConfig->CustomDarkColor = '#483D8B';

// Used to override the default Captcha image color scheme.
// Html named or hex color value of the light color used in Captcha images
$LBD_CaptchaConfig->CustomLightColor = '#87CEFA';

// Custom Captcha image alt text
$LBD_CaptchaConfig->ImageTooltip = 'CAPTCHA Image Custom Tooltip';



// Captcha sound configuration
// ---------------------------------------------------------------------------

// Is Captcha sound enabled
$LBD_CaptchaConfig->SoundEnabled = true;

// Captcha sound style - can be a fixed or a randomized value selected from
// the 10 BotDetect sound generation algorithms
$LBD_CaptchaConfig->SoundStyle = CaptchaRandomization::GetRandomSoundStyle();

// Captcha sound output format (WavPcm16bit8KhzMono or WavPcm8bit8KhzMono)
$LBD_CaptchaConfig->SoundFormat = SoundFormat::WavPcm16bit8kHzMono;

// Custom sound Captcha icon alt text / title
$LBD_CaptchaConfig->SoundTooltip = 'Sound Icon Custom English Tooltip';

// If the required SoundPackage in not deployed, the sound icon is not
// clickable and displays a warning tooltip by default. If you want to disable
// this warning and simply not display the sound Captcha icon at all for
// locales whose pronunciations are not deployed with the application,
// set this property to "false".
$LBD_CaptchaConfig->WarnAboutMissingSoundPackages = true;

// Starting delay of sound JavaScript playback, in miliseconds.
// Useful for improving usability of the Captcha sound for blind people using
// JAWS or similar readers, which will read the label associated with the Captcha
// code textbox and start sound playback simultaneously when the sound icon
// is activated. Setting this delay to e.g. 2000 (2 seconds) will give the user time
// to hear both the pronounced label and the Captcha sound clearly.
$LBD_CaptchaConfig->SoundStartDelay = 1000;

// How will multiple consecutive requests for audio Captcha with the same 
// Captcha code ("sound regeneration") be handled by BotDetect - a trade-off 
// of security, usability, and storage requirements:
//   -> SoundRegenerationMode::None - generate only one sound response per 
//     Captcha code, cache it on the server, and serve it for all consecutive 
//     sound requests.
//       * Highest security: comparative analysis of multiple sounds is impossible
//          since only one sound response exists per Captcha code.
//       * High usability: works consistently across all browsers, regardless of 
//          their Html5 audio support and without depending on JavaScript 
//          functionality.
//       * High storage requirements: the generated sound bytes must be stored 
//          in Session state, consuming server memory or other storage medium 
//          for each Captcha code requested as Captcha audio.
//   -> SoundRegenerationMode::Limited - allow generation of a limited number  
//     of different sound responses (the minimum required to make Captcha 
//     audio work in all supported client browsers and devices), and 
//     automatically change the Captcha code on the client for consecutive sound 
//     requests if needed and possible. 
//       * Decent security: comparative analysis of multiple sounds is severely 
//          hampered, since the small number of sound responses available does
//          not provide enough information to seriously undermine Captcha 
//          security. 
//       * Decent usability: Since Captcha sound will only be served a small 
//          number of times for the same Captcha code (returning an error after
//          the limit has been hit), observed behavior depends on client browser 
//          capabilities: 
//            - Modern Html5 Wav audio compatible browsers will always replay 
//              the same sound on consecutive sound icon clicks, without 
//              requesting a regenerated sound from the server.
//            - Older browsers without support for client-side audio replay must
//              detect consecutive sound icon clicks that might trigger the sound 
//              regeneration limit on the server and automatically change the 
//              Captcha code (by reloading the Captcha image) to ensure sound 
//              will play properly. For each sound icon click after the first one, the
//              Captcha image will be changed before audio is played.
//            - Browsers without JavaScript capability (and bots) will have to 
//              reload the form to get a new Captcha code to make the sound work 
//              again after the regeneration limit had been hit.
//       * Low storage requirements: generated sound responses don't need to
//          be stored on the server. 
//   -> SoundRegenerationMode::Unlimited - each audio request will generate a  
//     new Captcha sound response (previous BotDetect version behavior).
//       * Low security: comparative analysis of multiple sounds for the same
//          Captcha code allows for higher accuracy of automated recognition.
//       * High usability: works consistently across all browsers, regardless of 
//          their Html5 audio support and without depending on JavaScript 
//          functionality.
//       * Low storage requirements: generated sound responses don't need to 
//          be  stored on the server. 
// BotDetect defaults to limited sound regeneration as the most reasonable 
// overall trade-off. At user discretion, higher security and usability can be 
// achieved at the cost of significant amounts of server-side storage space. 
// Unlimited sound regeneration is not recommended due to low security, but is
// left as an option for backwards-compatibility.
$LBD_CaptchaConfig->SoundRegenerationMode = SoundRegenerationMode::Limited;


// Captcha reload configuration
// ---------------------------------------------------------------------------

// Is Captcha reloading enabled
$LBD_CaptchaConfig->ReloadEnabled = true;

// Custom reload Captcha icon alt text / title
$LBD_CaptchaConfig->ReloadTooltip = 'Reload Icon Custom Tooltip';

// Captcha images are automatically reloaded when the Captcha code expires
// (as set in the $LBD_CaptchaConfig->CodeTimeout element), but only within 
// a certain interval from their first generation. 
// This allows you to have a short Captcha code timeout (e.g. 2 minutes) 
// to narrow the window of opportunity for Captcha reusing on other sites 
// or human-solver-powered bots, and actual visitors can still fill out 
// your form at their own pace and without rushing (since the Captcha image 
// will be automatically reloaded when it is no longer valid).
$LBD_CaptchaConfig->AutoReloadExpiredCaptchas = true;

// Since we don't want infinite sessions when the user leaves the form open
// in a background browser tab over the weekend (for example), we set a
// reasonable upper limit on the auto-reload period (e.g. 2 hours = 7200
// seconds).
$LBD_CaptchaConfig->AutoReloadTimeout = 7200;


// Captcha help link configuration
// ---------------------------------------------------------------------------

// Is the Captcha help link enabled or not
$LBD_CaptchaConfig->HelpLinkEnabled = true;

// Controls how the Captcha help link is displayed; supported modes are "Image" and "Text"
$LBD_CaptchaConfig->HelpLinkMode = HelpLinkMode::Text;

// Url (absolute or relative) to which the Captcha help link points to
$LBD_CaptchaConfig->HelpLinkUrl = 'captcha.html';

// Text used in the Captcha help link; leave empty for default image width-dependent text
$LBD_CaptchaConfig->HelpLinkText = '';


// Captcha user input configuration
// ---------------------------------------------------------------------------

// The input textbox will be assigned focus on all Captcha Sound and
// Captcha Reload icon clicks, allowing the users to more easily type
// in the code as they hear it or as the new image loads. This does not
// apply to auto-reloading of expired Captchas, since the user might
// be filling out another field on the form when the auto-reload
// starts and shouldn't be distracted.
$LBD_CaptchaConfig->AutoFocusInput = true;

// The input textbox will be cleared on all Reload icon clicks and auto-
// reloads, since any previous input in the textbox will be invalidated
// by Captcha reloading. This is a small usability improvement that
// helps users avoid having to delete the previous input themselves.
$LBD_CaptchaConfig->AutoClearInput = true;

// Anything the users type in the input textbox will be uppercased
// on the fly, since Captcha validation is not and should not be case-
// sensitive. This is a small usability improvement that helps
// communicate that fact to the users clearly.
$LBD_CaptchaConfig->AutoUppercaseInput = true;


// Captcha remote script configuration
// ---------------------------------------------------------------------------

// Should BotDetect also add the remote JavaScript include loaded from the 
// captcha.com server. Currently used only for stats, but planned to develop
// into additional Captcha functionality.
$LBD_CaptchaConfig->RemoteScriptEnabled = true;


// Captcha URL configuration
// ---------------------------------------------------------------------------

// Custom Captcha sound icon, relative or absolute Url
$LBD_CaptchaConfig->SoundIconUrl = 'custom_sound_icon.gif';

// Custom Captcha reload icon, relative or absolute Url
//$LBD_CaptchaConfig->ReloadIconUrl = 'http://captcha.com/images/refresh.png';

// For custom integrations into 3rd party frameworks, it might be necessary to modify
// the base Url of Captcha image and sound requests, as well as the fixed BotDetect 
// resources (stylesheet and client-side include)
$LBD_CaptchaConfig->HandlerUrl = 'botdetect.php';
$LBD_CaptchaConfig->LayoutStylesheetUrl = LBD_URL_ROOT . 'lbd_layout.css';
$LBD_CaptchaConfig->ScriptIncludeUrl = LBD_URL_ROOT. 'lbd_scripts.js';

?>