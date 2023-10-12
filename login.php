<?php
include('common-functions.php');


function  showLoginContent(){
    $loginData = validatelogin();
    if (!$loginData['valid']) { 
        showLoginForm($loginData);
    } else{
        // Hier wil ik nagaan of het emailadres en het ww matchen/bestaan
        checkIfLoginExists($loginData);
    }
}

function showLoginForm($loginData){
    echo '
    <form method="POST" action="index.php">

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="'. $loginData['email'] . '"></br>
        <span class="error">' . $loginData['emailErr'] . '</span>
        </br></br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="'. $loginData['password'] . '"></br>
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

        $valid = empty($emailErr) && empty($passwordErr); 
    }
    
    return ["email"=>$email, "emailErr"=>$emailErr, "password"=>$password, "passwordErr"=>$passwordErr, "valid"=>$valid];
}

function isLoggedIn(){
    return false;
     //Voor nu even op false gezet / hier moet nog logica in
 }
 

function checkIfLoginExists($loginData){
    $usersfile = file_get_contents("users/users.txt");
    $usersfileArray = explode($usersfile, "/n"); // Nu zou elke losse regel een array moeten vormen
    var_dump("hallo");
    var_dump($usersfileArray);


    // if (str_contains($usersfile, "$loginData[email]")){
    //     echo "true";
    // } else {
    //     echo "false";
    // }


}