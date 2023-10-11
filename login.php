<?php
include('common-functions.php');


function  showLoginContent(){
    $loginData = validatelogin();
    if (!$loginData['valid']) { 
        showLoginForm($loginData);
    } else{
        // ?
    }
}

function showLoginForm($loginData){
    echo '
    <form method="POST" action="index.php">

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="'. $loginData['email'] . '"></br>
        <span class="error">' . $loginData['emailErr'] . '</span>
        </br></br>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" value="'. $loginData['password'] . '"></br>
        <span class="error">' . $loginData['passwordErr'] . '</span>
        </br></br>

        <input hidden name="page" value="login"></input>

        <button type="submit">Submit</button>
    </form>';
}


function validateLogin(){

    //initiate variables
    $email = $password = "";
    $emailErr = $passwordErr = "";
    $valid = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // validate for the 'POST' data

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

        if (checkIfEmailExists($email)){
            $emailErr = "*This emailadress is already registered";
        }

        $valid = empty($emailErr) && empty($passwordErr); 
    }
    
    return ["email"=>$email, "emailErr"=>$emailErr, "password"=>$password, "passwordErr"=>$passwordErr, "valid"=>$valid];
}



function checkIfEmailExists($email){
    $usersfile = file_get_contents("users/users.txt");
    return str_contains($usersfile, $email);
}

