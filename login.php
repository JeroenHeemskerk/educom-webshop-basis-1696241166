<?php










function showLoginForm(){
    echo '
    <form method="POST" action="index.php">

        <label for="email">Email:</label>
        <input type="text" name="email" id="email"></br></br>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd"></br></br>

        <button>Login</button>
    </form>';
}


