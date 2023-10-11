<?php

$usersfile = file_get_contents("users/users.txt");
echo $usersfile;

if (str_contains($usersfile, "halt")){
    echo "true";
} else {
    echo "false";
}

// $usersfile = fopen("<users/users.txt", "a") or die("Unable to open file!");
// $user = "ramiwohl@hotmail.com|Rami Wohl|hallo\n";
// fwrite($usersfile, $user);
// $user = "laurabokkers@hotmail.com|Laura Bokkers|hoi\n";
// fwrite($usersfile, $user);
// fclose($usersfile);

?>