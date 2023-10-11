<?php
include('common-functions.php');

$registrationdata = validateRegistration();



function showRegisterForm(){
    echo '
    <form method="POST" action="index.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"></br></br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email"></br></br>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd"></br></br>

        <label for="repeat_pwd">Repeat password:</label>
        <input type="password" id="repeat_pwd" name="pwd"></br></br>

        <button>Submit</button>
    </form>';
}


function validateRegistration(){

    //initiate variables
    $name = $email = $password = $repeatedpassword = "";
    $nameErr = $emailErr = $passwordErr = $repeatedpasswordErr = "";
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

        if (empty($_POST["repeatedpassword"])) {
            $repeatedpasswordErr = "*Password is required";
        } else {
            $repeatedpassword = test_input($_POST["repeatedpassword"]);
            if ($password != $repeatedpassword){
                $passwordErr = $repeatedpasswordErr = "*Passwords do not match";
            }
        }
        if (checkIfEmailExists()){
            $emailErr = "*This emailadress is already registered";
        }
    }
    return  $valid = empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($repeatedpasswordErr); ;

}

function checkIfEmailExists(){

}