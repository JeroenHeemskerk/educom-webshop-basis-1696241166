<?php

function getInitialLoginFormData()
{
    return  ["page" => "login", "email" => "", "emailErr" => "", "password" => "", "passwordErr" => "", "valid" => false];
}

function getLoginData()
{
    //initiate variables
    $loginData = getInitialLoginFormData();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $loginData = validateLogin($loginData);
    }
    return $loginData;
}

function showLoginForm($loginData)
{
    echo '
    <form method="POST" action="index.php">

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="' . $loginData['email'] . '"></br>
        <span class="error">' . $loginData['emailErr'] . '</span>
        </br></br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="' . $loginData['password'] . '"></br>
        <span class="error">' . $loginData['passwordErr'] . '</span>
        </br></br>

        <input hidden name="page" value="login"></input>

        <button type="submit">Login</button>
    </form>';
}

function validateLoginAttempt($loginData)
{
    $usersfile = fopen("users/users.txt", "r") or die("Unable to open file!");
    fgets($usersfile); // Ik pak hier de eerste 'line' en sla hem niet op, zodat hij hierna bij line 2 begint. 
    $userFound = false;
    // Hieronder staat: Zolang je niet aan het einde van het document bent, lees en output steeds 1 line.
    while (!feof($usersfile)) {
        $line = fgets($usersfile);
        // var_dump($line);
        $parts = explode("|", $line, 3); // Elke losse regel is nu een array met 3 elementen (element 0 = email)

        if ($parts[0] == $loginData['email']) {
            $userFound = true;
            // DAN ook checken of de passwords correct zijn ingevoerd (ww = element 2)
            if (trim($parts[2]) == $loginData['password']) {
                // Ik stop hier de naam in de session
                doLoginUser($parts[1]);
                // Login (start sessie)
                // start session staat helemaal aan het begin in de index.php
                break;
            } else {
                $loginData['passwordErr'] = "Wrong password";
                $loginData['valid'] = false;
            }
        }
    }
    fclose($usersfile);

    if (!$userFound) {
        $loginData['emailErr'] = "Email address is not registered.";
        $loginData['valid'] = false;
    }

    return $loginData;
}
