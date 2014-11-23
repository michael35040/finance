<?php

//attempting to stop header errors
//ob_start(); //dirty hack to fix 'headers already sent... need to fix the issue. functions 150


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
	if($environment=='live')
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
	        //below should not execute unless user bypasses redirect.
	        header('WWW-Authenticate: Basic realm="Authentication System"');
	        header('HTTP/1.0 401 Unauthorized');
	        echo 'Unauthorized! Please sign in.'; //Text to send if user hits Cancel button
	        exit;
        }
        else
        {
	        $users = query("SELECT active FROM users WHERE id = ?", $_SESSION["id"]);
	    	@$active = $users[0]["active"];
            if (!preg_match("{(?:status)\.php$}", $_SERVER["PHP_SELF"]))
            {if($active!=1){redirect("status.php"); exit();} }//session_destroy();
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
