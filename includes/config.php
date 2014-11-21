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

$environment='test'; // 'live' or 'test'
if($environment=='test')
{
//FOR LIVE ENVIRONMENT
	error_reporting(0); // show nothing
	@ini_set("display_errors", 0);//won't display or even put in log file
}
else
{
//FOR TESTING ENVIRONMENT
	ini_set("display_errors", 1);// display errors, warnings, and notices
	error_reporting(E_ALL); //when testing site
}

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
