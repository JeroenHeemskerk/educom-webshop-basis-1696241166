<?php

// Hier komen alle validaties

function validateLogin($loginData)
{
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

    if ($loginData['valid'] == true) {
        $loginData['page'] = 'home';
    }

    return $loginData;
}




function validateRegister($registerData)
{
    if (empty($_POST["name"])) {
        $registerData['nameErr'] = "*Name is required";
    } else {
        $registerData['name']= test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $registerData['name'])) {
            $registerData['nameErr'] = "*Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $registerData['emailErr'] = "*Email is required";
    } else {
        $registerData['email'] = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($registerData['email'], FILTER_VALIDATE_EMAIL)) {
            $registerData['emailErr'] = "*Invalid email format";
        } else if (doesEmailExist($registerData['email'])) {
            $registerData['emailErr'] = "*This emailadress is already registered";
        }
    }

    if (empty($_POST["password"])) {
        $registerData['passwordErr'] = "*Password is required";
    } else {
        $registerData['password'] = test_input($_POST["password"]);
    }

    if (empty($_POST["repeatedPassword"])) {
        $registerData['repeatedPasswordErr'] = "*Password is required";
    } else {
        $registerData['repeatedPassword'] = test_input($_POST["repeatedPassword"]);
        if ($registerData['password'] != $registerData['repeatedPassword']) {
            $registerData['passwordErr'] = $registerData['repeatedPasswordErr'] = "*Passwords do not match";
        }
    }

    $registerData['valid'] = empty($registerData['nameErr']) && empty($registerData['emailErr']) && empty($registerData['passwordErr']) && empty($registerData['repeatedPasswordErr']);

    return $registerData;
}



// function validateContact(){

// }