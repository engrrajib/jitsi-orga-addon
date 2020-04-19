<?php
    session_start();

    if(!isset($_POST["password"])){
        die("403: Forbidden (Error: 0x004 Manipulation festgestellt)");
    }

    // get configuration
    $config = json_decode(file_get_contents("config/config.json"), true);

    if($_POST["password"] == $config["leader_password"]){
        // success
        $_SESSION["leiter_logged_in"] = true;
        header("Location: leiter.php");

    } else {
        // wrong password
        header("Location: leiterlogin.php?error=Falsches Passwort.");
    }