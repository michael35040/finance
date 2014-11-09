<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

// if form was submitted  -- validate and insert int database
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $terms = $_POST["terms"];




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
    elseif($terms == "money")
    {


        //execute query
        $rows = query("SELECT id, units FROM accounts ORDER BY units DESC  LIMIT 0, 10", $id); //top 10 (0-9)

        foreach ($rows as $row)		// for each of user
        {
            $info["id"] = $row["id"];
            $info["units"] = $row["units"];

            $searchusers[] = $info;
        }




    }
    else
    {


        // if symbol or shares empty
        if (empty($_POST["where"]) || empty($_POST["search"])) //empty or a value of zero 0.
        {
            apologize("You need to select an option and term!");
        }


        $search = $_POST["search"];
        $where = $_POST["where"];

        if (!ctype_digit($where)){ apologize("Search Error! E1");}  //made where an integer on form page to assist in security, being a little more cautious since it is directly in my query as I can't get it to work when i parameterize it.

        if ($where == 1): { $where = "id"; }
        elseif ($where == 2): {	$where = "username"; }
        elseif ($where == 3): {	$where = "email"; }
        else: { apologize("Search Error! E2"); }
        endif;

        $search = filter_var($search, FILTER_SANITIZE_EMAIL); //even though can contain other than email, it has the options that assist in safety.
        if ($where == 3) //if email
        {
            if (!filter_var($search, FILTER_VALIDATE_EMAIL)) { apologize("The search contains invalid text characters."); }   // Not a valid search, diregard email validation
        }





//SANATIZE SEARCH TO ASSIST IN PREVENTING SQL INJECTION
        $search = htmlspecialchars($search);
        $search = str_replace(",", '', $search);
        $search = str_replace(";", '', $search);
        $search = str_replace(")", '', $search);
        $search = str_replace("(", '', $search);
        $search = str_replace("\"", '', $search);
        $search = str_replace("'", '', $search);
        $search = str_replace("=", '', $search);
        $search = str_replace("&", '', $search);
        $search = str_ireplace("delete", '', $search); //irplace is case insesntive version of replace
        $search = str_ireplace("update", '', $search);
        $search = str_ireplace("insert", '', $search);


//check to see if valid id
        $num_user = query("SELECT count(*) AS num_user FROM users WHERE $where = ?", $search); //might be prone to SQL injections...

        $count = $num_user[0]['num_user'];
        if ($count == 0) //0 no users //1 valid users
        {
            apologize("User not found! F1");
        }



//execute query
        $rows = query("SELECT * FROM users WHERE $where = ?", $search);

        if ($rows == null)
        {apologize("User not found! F2");}

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

            $searchusers[] = $info;
        }

//check to see if valid id
        if ($count !== 1)	//might need to be != and not !==
        {
            apologize("User not found! F3");
        }


    }//from the terms function

//var_dump(get_defined_vars()); 
    render("admin_users_form.php", ["title" => "Search Users", "searchusers" => $searchusers]);   // render output
}
else
{
    render("admin_users_search_form.php",  ["title" => "Search Users"]);  // else render for inputs
}
?>