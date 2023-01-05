<?php 

namespace Validation;


function lenValidator($val, $len, &$msg){
    if(strlen($val) <$len){
        $msg = 'Must Be at least ' . $len . ' characters.';
    }
}

function requiredValidator($val, &$msg){
    if($val == ''){
        $msg = 'Required';
    }
}


function eMailValidator($val, &$msg){
    if(strlen($val) > 0){
        if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
            $msg = "Not a valid email address";
        }
    }
}

function phoneValidator($val, &$msg){
    $regex ="/\([0-9]{3}\)[0-9]{3}\-[0-9]{4}/";
        if(strlen($val) > 0){
            if(preg_match($regex, $val)==0){
                $msg ="Invalid phone number - expected format (111)111-1111";
            }
        }else{
            $msg ="Invalid phone number - expected format (111)111-1111";
        }
}

function maxLenValidator($val, $len, &$msg){
    if(strlen($val) > $len){
        $msg = "Maximum string length is ". $len .  " characters";
    }
}

function passwordValidator($val, &$msg){
    $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$!@*#])[A-Za-z\d$!@*#]{4,20}$/";
    $error = "Password must be 4-20 chars including at least one upper, one lower
    , one digit, and a special character in the set $!@*#";
    if(preg_match($regex, $val)==0){
        $msg = $error;
    }
}

function extensionValidator($val, &$msg){
    $regex ="/^\d{5}$/";
    $error = "Invalid extension - 5 digits only";
    if(preg_match($regex, $val) == 0){
        $msg = $error;
    }
}

?>