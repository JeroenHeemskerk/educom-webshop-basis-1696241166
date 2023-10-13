<?php
include('common-functions.php');


function  showRegisterContent(){
    $registrationData = validateRegistration();
    if (!$registrationData['valid']) { 
        showRegisterForm($registrationData);
    } else{
        registerUser($registrationData);
        // showLoginForm(); deze gebruiken? Dan moet ik de login file importeren
        
        // showRegisterThanks($registrationData);?
        // Hier moet ik de registratie informatie opslaan in users.txt (bijvoorbeeld registerUser();
        // Daarna navigeren naar de login page
    }
}

function showRegisterForm($registrationData){
    echo '
    <form method="POST" action="index.php?page=login">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="'. $registrationData['name'] . '"></br>
        <span class="error">' . $registrationData['nameErr'] . '</span>
        </br></br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="'. $registrationData['email'] . '"></br>
        <span class="error">' . $registrationData['emailErr'] . '</span>
        </br></br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="'. $registrationData['password'] . '"></br>
        <span class="error">' . $registrationData['passwordErr'] . '</span>
        </br></br>

        <label for="repeatedPassword">Repeat password:</label>
        <input type="password" id="repeatedPassword" name="repeatedPassword" value="'. $registrationData['repeatedPassword'] . '"></br>
        <span class="error">' . $registrationData['repeatedPasswordErr'] . '</span>
        </br></br>

        <input hidden name="page" value="register"></input>

        <button type= "submit">Submit</button>
    </form>';
}


function validateRegistration(){

    //initiate variables
    $name = $email = $password = $repeatedPassword = "";
    $nameErr = $emailErr = $passwordErr = $repeatedPasswordErr = "";
    $valid = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // validate for the 'POST' data
        if (empty($_POST["name"])) {
            $nameErr = "*Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
             if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "*Only letters and white space allowed";
                }
        }

        if (empty($_POST["email"])) {
            $emailErr = "*Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "*Invalid email format";
            }
        }

        if (empty($_POST["password"])) {
            $passwordErr = "*Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }

        if (empty($_POST["repeatedPassword"])) {
            $repeatedPasswordErr = "*Password is required";
        } else {
            $repeatedPassword = test_input($_POST["repeatedPassword"]);
            if ($password != $repeatedPassword){
                $passwordErr = $repeatedPasswordErr = "*Passwords do not match";
            }
        }
        if (checkIfEmailExists($email)){
            $emailErr = "*This emailadress is already registered";
        }

        $valid = empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($repeatedPasswordErr); 
    }
    
    return ["name"=>$name, "nameErr"=>$nameErr, "email"=>$email, "emailErr"=>$emailErr, "password"=>$password, "passwordErr"=>$passwordErr, "repeatedPassword"=>$repeatedPassword, "repeatedPasswordErr"=>$repeatedPasswordErr, "valid"=>$valid];
}



function checkIfEmailExists($email){
    $usersfile = file_get_contents("users/users.txt");
    return str_contains($usersfile, $email);
}

function registerUser($registrationData){

$usersfile = fopen("<users/users.txt", "a") or die("Unable to open file!");
$user = "$registrationData[email]|$registrationData[name]|$registrationData[password]";
fwrite($usersfile, $user);
fclose($usersfile);
}