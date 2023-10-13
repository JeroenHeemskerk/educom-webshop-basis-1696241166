<?php

function authenticateUser($email, $password){

}

function doesEmailExist($email){
    $usersfile = file_get_contents("users/users.txt");
    return str_contains($usersfile, $email);
}

function storeUser($email, $name, $password){
    // dit is register user
}