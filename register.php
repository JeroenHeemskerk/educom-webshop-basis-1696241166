<?php

function showRegisterContent(){
    showRegisterForm();
}



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

