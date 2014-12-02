<?php 
  session_start(); 
  require("botdetect.php"); 


  $form_page = "index.php";
  $view_page = "Messages.php";
  
  // directly accessing this script is an error
  if (!$_SERVER['REQUEST_METHOD'] == "POST") {
    header("Location: ${form_page}");
    exit;
  }

  // sumbitted data
  $name = $_REQUEST['Name'];
  $email = $_REQUEST['Email'];
  $message = $_REQUEST['Message'];
  $form_page = $form_page . "?Name=" . urlencode($name) . "&Email=" . urlencode($email) . "&Message=" . urlencode($message);

  // total form validation result
  $isPageValid = true;

  
  // Captcha validation 
  $AjaxValidationCaptcha = new Captcha("AjaxValidationCaptcha");
  $AjaxValidationCaptcha->UserInputID = "CaptchaCode";
  if (!$AjaxValidationCaptcha->IsSolved) {
    $isHuman = $AjaxValidationCaptcha->Validate();
    $isPageValid = $isPageValid && $isHuman;
    $form_page = $form_page . "&CaptchaCodeValid=" . $isHuman;
  }
  
  // name validation
  $isNameValid = ValidateName($name);
  $isPageValid = $isPageValid && $isNameValid;
  $form_page = $form_page . "&NameValid=" . $isNameValid;
  
  // email validation
  $isEmailValid = ValidateEmail($email);
  $isPageValid = $isPageValid && $isEmailValid;
  $form_page = $form_page . "&EmailValid=" . $isEmailValid;
  
  // message validation
  $isMessageValid = ValidateMessage($message);
  $isPageValid = $isPageValid && $isMessageValid;
  $form_page = $form_page . "&MessageValid=" . $isMessageValid;
  
  if (!$isPageValid) { 
    // form validation failed, show error message
    header("Location: ${form_page}");
    exit;
  }
  
  // keep a collection of submitted valid messages in Session state
  SaveMessage($name, $email, $message);
  $AjaxValidationCaptcha->Reset(); // each message requires a new Captcha challenge
  header("Location: ${view_page}");
  exit;
  
  
  // name validation
  function ValidateName($name) {
    $result = false;
    if (strlen($name) > 2 && strlen($name) < 30) {
      $result = true;
    }
    return $result;
  }
  
  // email validaton
  function ValidateEmail($email) {
    $result = false;
    if (strlen($email) < 5 || strlen($email) > 100) {
      $result = false;
    } else {
      $result = (1 == preg_match('/^(.+)@(.+)\.(.+)$/', $email));
    }
    return $result;
  }
  
  // message validation
  function ValidateMessage($message) {
    $result = false;
    if (strlen($message) > 2 && strlen($message) < 255) {
      $result = true;
    }
    return $result;
  }
  
  // data storage
  function SaveMessage($name, $email, $message) {
    // we want to keep the sample code simple, so we'll store the messages in Session state despite it being unfit for real-world use in such scenarios;
    // using a database or another appropriate persistence medium would complicate the sample code
    $_SESSION['Message_' . strtolower(md5(uniqid(mt_rand(), true)))] = htmlentities($name) . ' (' . htmlentities($email) . ') says: ' . htmlentities($message);
  }
  
?>