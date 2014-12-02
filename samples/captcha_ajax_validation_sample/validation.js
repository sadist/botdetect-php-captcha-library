function validateForm() {
  var isNameValid = validateName();
  var isEmailValid = validateEmail();
  var isMessageValid = validateMessage();
  var isCaptchaValid = validateCaptcha();
  
  return isNameValid && isEmailValid && isMessageValid && isCaptchaValid;
}

function validateName() {
  var result = false;
  
  var input = document.getElementById("Name");
  if (input && 'text' == input.type) {
    var value = input.value.replace(/^\s+|\s+$/g,""); // trim leading and trailing whitespace
    if (value && value.length > 2 && value.length < 30) {
      result = true;
    }
  }
  
  var validator = document.getElementById("NameValidator");
  updateValidatorDisplay(validator, result);
  
  return result;
}

function validateEmail() {
  var result = false;
  
  var input = document.getElementById("Email");
  if (input && 'text' == input.type) {
    var value = input.value.replace(/^\s+|\s+$/g,""); // trim leading and trailing whitespace
    if (value && value.length > 5 && value.length < 100 && value.match(
    /^(.+)@(.+)\.(.+)$/)) {
      result = true;
    }
  }
  
  var validator = document.getElementById("EmailValidator");
  updateValidatorDisplay(validator, result);
  
  return result;
}

function validateMessage() {
  var result = false;
  
  var input = document.getElementById("Message");
  if (input && 'textarea' == input.type) {
    var value = input.value.replace(/^\s+|\s+$/g,""); // trim leading and trailing whitespace
    if (value && value.length > 2 && value.length < 255) {
      result = true;
    }
  }
  
  var validator = document.getElementById("MessageValidator");
  updateValidatorDisplay(validator, result);
  
  return result;
}

function validateCaptcha() {
  var result = false;
  
  var input = document.getElementById("CaptchaCode");
  if (input && 'text' == input.type) {
    var value = input.value.replace(/^\s+|\s+$/g,""); // trim leading and trailing whitespace
    if (value && value.length > 0 && value.length < 10) {
      result = input.Captcha.Validate(); // call the BotDetect built-in client-side validation function
      // this function must be called after the Captcha is displayed on the page, otherwise the
      // client-side object won't be initialized
    }
  }
  
  var validator = document.getElementById("CaptchaValidator");
  updateValidatorDisplay(validator, result);
  
  return result;
}


// register handlers for the four steps of the BotDetect Ajax validation workflow
BotDetect.RegisterCustomHandler('PreAjaxValidate', OnCaptchaValidate);
BotDetect.RegisterCustomHandler('AjaxValidationFailed', OnCaptchaIncorrect);
BotDetect.RegisterCustomHandler('AjaxValidationPassed', OnCaptchaCorrect);
BotDetect.RegisterCustomHandler('AjaxValidationError', OnAjaxError);

function OnCaptchaValidate() {
  // hide validator
  var captchaValidator = document.getElementById("CaptchaValidator");
  updateValidatorDisplay(captchaValidator, true);
  
  // disable multiple clicks while waiting for server response
  var submitButton = document.getElementById("SubmitButton");
  submitButton.disabled = true;
  submitButton.value = 'Validating...';
}

function OnCaptchaCorrect() {
  // hide validator
  var captchaValidator = document.getElementById("CaptchaValidator");
  updateValidatorDisplay(captchaValidator, true);
  
  // automatically proceed to server-side validation
  var submitButton = document.getElementById("SubmitButton");
  submitButton.disabled = false;
  submitButton.value = 'Submit';
  submitButton.focus();
  submitButton.click();
}

function OnCaptchaIncorrect() {
  // show validator
  var captchaValidator = document.getElementById("CaptchaValidator");
  updateValidatorDisplay(captchaValidator, false);
  
  // allow the users to re-try the new Captcha 
  var submitButton = document.getElementById("SubmitButton");
  submitButton.disabled = false;
  submitButton.value = 'Submit';
}
      
function OnAjaxError() {
  // fall back to server-side validation
  var submitButton = document.getElementById("SubmitButton");
  submitButton.disabled = false;
  submitButton.value = 'Submit';
  submitButton.focus();
  submitButton.click();
}

function updateValidatorDisplay(validator, result) {
  if (validator) {
    if (result) { 
      validator.style.display = 'none'; 
    } else {
      validator.style.display = 'inline'; 
    }
  }
}