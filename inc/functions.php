<?php


  /* ==============================================
  This function prevent sql injection
  ================================================*/
  function p_s($variable) {
    global $conn;
    $variable = mysqli_real_escape_string($conn, trim($variable)); 
    return $variable;  
}

/* ==============================================
This function prevent Cross-Side Scripting (XSS)
================================================*/
function g_s($variable) {
    $variable = strip_tags($variable);
    return $variable; 
}


/* ==============================================
  save user msg at DB
  ================================================*/

function saveMsg($formData)
{
    $name = p_s($formData['username']);
    $email = p_s($formData['useremail']);
    $msg = p_s($formData['usermsg']);
    if(isValidEmail($email)){ 
        if(minMaxLength($name,4,20)&& minMaxLength($msg,10,500)){
   
            global $conn;
            $sql = "INSERT INTO contact (name,email,message) VALUES ('$name', '$email', '$msg')";
            if (mysqli_query($conn, $sql)) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}

/* ==============================================
  beautify the code
  ================================================*/
function pretty($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

// check the validation of the email
function isValidEmail($email){ 
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

//Check min and max values for string
function minMaxLength($string, $minlen, $maxlen){
	if (strlen($string)>$maxlen || strlen($string)<$minlen) {
		return false;
	}else{
		return true;
	}
}


function pred($data){
    echo "<div class='pred'><pre>";
    x("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    die();
    echo "</pre></div>";
  }
  