<?php

function authenticateUser($user, $password)
{
    if (trim($user[2]) == $password) {
        $result = RESULT_OK;
    } else {
        $result = RESULT_WRONG_PASSWORD;
    }

    return $result;
}

function doesEmailExist($email)
{
    $result = findUserByEmail($email);

    return $result["message"] == RESULT_USER_FOUND;
}

function storeUser($email, $name, $password)
{
    // dit is register user?
}
