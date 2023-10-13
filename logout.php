<?php
include("home.php");
include('session-manager.php');

function logout(){
    doLogOut();
    showHomeContent();
}

//homepage tonen
// session uitloggen
