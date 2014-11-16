<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

// if form was submitted  -- validate and insert int database
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $terms = $_POST["terms"];

    //apologize(var_dump(get_defined_vars())); //dump all variables if i hit error



    if($terms == "all")
    {
        //execute query
        $rows = query("
        SELECT * FROM users, accounts
        WHERE users.id=accounts.id ;
        ");

        foreach ($rows as $row)		// for each of user
        {
            $info["id"] = $row["id"];
            $info["username"] = $row["username"];
            $info["email"] = $row["email"];
            $info["password"] = $row["password"];
            $info["phone"] = $row["phone"];
            $info["last_login"] = $row["last_login"];
            $info["registered"] = $row["registered"];
            $info["fails"] = $row["fails"];
            $info["ip"] = $row["ip"];

            $accounts = query("SELECT units, loan, rate FROM accounts WHERE id = ?", $info["id"]);
            $info["units"] = $accounts[0]["units"];
            $info["loan"] = $accounts[0]["loan"];
            $info["rate"] = $accounts[0]["rate"];
            $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=? AND side='b')", $info["id"]);	  // query user's portfolio

            $info["locked"] = $bidLocked[0]["total"]; //shares trading

            $searchusers[] = $info;
        }



    }
    else //elseif($terms == "money")
    {
        //execute query
        $rows = query("SELECT * FROM users, accounts WHERE users.id=accounts.id ORDER BY units DESC LIMIT 0,10 ;");

        foreach ($rows as $row)		// for each of user
        {
            $info["id"] = $row["id"];
            $info["username"] = $row["username"];
            $info["email"] = $row["email"];
            $info["password"] = $row["password"];
            $info["phone"] = $row["phone"];
            $info["last_login"] = $row["last_login"];
            $info["registered"] = $row["registered"];
            $info["fails"] = $row["fails"];
            $info["ip"] = $row["ip"];

            $accounts = query("SELECT units, loan, rate FROM accounts WHERE id = ?", $info["id"]);
            $info["units"] = $accounts[0]["units"];
            $info["loan"] = $accounts[0]["loan"];
            $info["rate"] = $accounts[0]["rate"];
            $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=? AND side='b')", $info["id"]);	  // query user's portfolio

            $info["locked"] = $bidLocked[0]["total"]; //shares trading

            $searchusers[] = $info;
        }




    }

//var_dump(get_defined_vars()); 
    render("admin_users_form.php", ["title" => "Search Users", "searchusers" => $searchusers]);   // render output
}
else
{
    render("admin_users_search_form.php",  ["title" => "Search Users"]);  // else render for inputs
}
?>