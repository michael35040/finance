<?php

//attempting to stop header errors
ob_start();


// enable sessions
session_start();

// requirements
require("db.php");
require("constants.php");
require("functions.php"); //standard website functions
require("functions_exchange.php"); //market exchange functions
require("functions_testing.php"); //functions for testing

    /***********************************************************************
     * config.php
     *
     *
     * Configures pages.
     **********************************************************************/

//FOR TESTING ENVIRONMENT
	// display errors, warnings, and notices
	ini_set("display_errors", 1);
	error_reporting(E_ALL); //when testing site
//FOR LIVE ENVIRONMENT
	// show nothing
	error_reporting(0); 
	//@ini_set("display_errors", 0);//won't display or even put in log file


    // require authentication for most pages
    if (!preg_match("{(?:login|logout|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (!isset($_SESSION["id"]))
        {
            redirect("login.php");
            exit();
        }
        else
        {
	        $users = query("SELECT active FROM users WHERE id = ?", $_SESSION["id"]);
	    	@$active = $users[0]["active"];
	    	if($active != 1){ apologize("Account requires activation!"); exit();}
        }
    }

    // require admin authentication; user id 1  /^def/
    if (preg_match("{(?:withdraw|deposit|users|ipo:?)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if ((isset($_SESSION["id"])) && ($_SESSION["id"] !== $adminid)) 
	{ //redirect("index.php");
		apologize("Unauthorized Access!");
		exit();
	}
    }
?>
