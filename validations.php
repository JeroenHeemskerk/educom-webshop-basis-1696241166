<?php

// Hier komen alle validaties

function validateLogin($loginData){
    if (empty($_POST["email"])) {
        $loginData['emailErr'] = "*Email is required";
    } else {
        $loginData['email'] = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($loginData['email'], FILTER_VALIDATE_EMAIL)) {
            $loginData['emailErr'] = "*Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $loginData['passwordErr'] = "*Password is required";
    } else {
        $loginData['password'] = test_input($_POST["password"]);
    }

    $loginData['valid'] = empty($loginData['emailErr']) && empty($loginData['passwordErr']);

    if ($loginData['valid'] == true) {
        $loginData = validateLoginAttempt($loginData);
    }

    if($loginData['valid'] == true) {
        $loginData['page'] = 'home';
    }

    return $loginData;
}


function validateRegister(){

}


// function validateContact(){

// }