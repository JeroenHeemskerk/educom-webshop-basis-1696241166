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
    $usersfile = fopen("users/users.txt", "r") or die("Unable to open file!");
    fgets($usersfile); // Ik pak hier de eerste 'line' en sla hem niet op, zodat hij hierna bij line 2 begint. 
    // Hieronder staat: Zolang je niet aan het einde van het document bent, lees en output steeds 1 line.
     while(!feof($usersfile)) {
        $line = fgets($usersfile);
        // var_dump($line);
        $parts = explode("|", $line); // Elke losse regel is nu een array met 3 elementen (element 0 = email)
        var_dump($parts);
            while (!feof($parts)){
                
            }
      }
        fclose($usersfile);

        //in parts zitten nu alle arrays (1 per user). Ik wil nu loopen over alle arrays, element 0, om te kijken of 
        // de gebruikte email hierin voorkomt. Parts bestaat alleen in bovenstaande loop!


    // if (str_contains($parts, "$loginData[email]")){
    //     echo "true";
    // } else {
    //     echo "false";
    // }


}