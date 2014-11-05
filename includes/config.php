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

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);


    // require authentication for most pages
    if (!preg_match("{(?:login|logout|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id"]))
        {
            redirect("login.php");
        }
    }

    // require admin authentication; user id 1  /^def/
    if (preg_match("{(?:withdraw|deposit|users|ipo:?)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (isset($_SESSION["id"])) 
		{
			if ($_SESSION["id"] !== $adminid) //admin ID
		       		{
    	//	        redirect("index.php");
		            apologize("Unauthorized Access!");
   	    			}
		}
    }
?>
