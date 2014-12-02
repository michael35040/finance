<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}
if ($id == 1) {


    if (isset($_POST["activate"]))
    {
        $id = $_POST["activate"];
        if ($id == 'ALL') { if (query("UPDATE users SET active=1 WHERE 1") === false) {apologize("Unable to activate all users!");}}
        else { if (query("UPDATE users SET active=1 WHERE id=?", $id) === false) {apologize("Unable to activate user!");}}
        redirect('admin_users.php');
    }
    if (isset($_POST["deactivate"]))
    {
        $id = $_POST["deactivate"];
        if ($id == 'ALL') {
            if (query("UPDATE users SET active=0 WHERE 1") === false) {apologize("Unable to deactivate all users!");}
            if (query("UPDATE users SET active=1 WHERE id=?", $adminid) === false) {apologize("Unable to activate all users!");}
        }
        else { if (query("UPDATE users SET active=0 WHERE id=?", $id) === false) {apologize("Unable to deactivate user!");}}
        redirect('admin_users.php');
    }


// if form was submitted  -- validate and insert int database

//apologize(var_dump(get_defined_vars())); //dump all variables if i hit error

    //execute query
        $rows = query("
        SELECT * FROM users, accounts
        WHERE users.id=accounts.id ;
        ");

        foreach ($rows as $row)		// for each of user
        {
            $info["id"] = $row["id"];
            $info["email"] = $row["email"];
            $info["password"] = $row["password"];
            $info["phone"] = $row["phone"];
            $info["last_login"] = $row["last_login"];
            $info["registered"] = $row["registered"];
            $info["fails"] = $row["fails"];
            $info["ip"] = $row["ip"];
            $info["active"] = $row["active"];

            $accounts = query("SELECT units, loan, rate FROM accounts WHERE id = ?", $info["id"]);
            $info["units"] = getPrice($accounts[0]["units"]);
                $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=? AND side='b')", $info["id"]);	  // query user's portfolio
            $info["locked"] = getPrice($bidLocked[0]["total"]); //units locked for bids

            $searchusers[] = $info;
        }




//var_dump(get_defined_vars()); 
    render("admin_users_form.php", ["title" => "Users", "searchusers" => $searchusers]);   // render output


} //$id
?>
