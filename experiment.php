<?php

$usersfile = fopen("<users/users.txt", "a") or die("Unable to open file!");
$user = "ramiwohl@hotmail.com|Rami Wohl|hallo\n";
fwrite($usersfile, $user);
$user = "laurabokkers@hotmail.com|Laura Bokkers|hoi\n";
fwrite($usersfile, $user);
fclose($usersfile);

?>