<?php
include("home.php");

function logout(){
    session_unset();
    showHomeContent();
}

//homepage tonen
// session uitloggen
