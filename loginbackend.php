<?php
    session_start();

    if(!isset($_POST["password"])){
        die("403: Forbidden (Error: 0x004 Manipulation festgestellt)");
    }

    // get configuration
    $config = json_decode(file_get_contents("config/config.json"), true);

    if($_POST["password"] == $config["password"]){
        // success
        $_SESSION["logged_in"] = true;
        header("Location: index.php");

    } else {
        // wrong password
        header("Location: login.php?error=Falsches Passwort.");
    }