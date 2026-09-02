<?php

//check method 
function CheachRequestMethod($method)
{
    if ($_SERVER['REQUEST_METHOD'] == $method) {
        return true;
    }
    return false;
}

//checkinput
function chechpostinput($input)
{
    if (isset($_POST[$input])) {
        return true;
    }
    return false;
}

//sentization 

function senitizeInput($input)
{
    return trim(htmlspecialchars(htmlentities($input)));
}



// redirct logout 



function redirect($page){
    header("location:$page");
    exit;
}
?>