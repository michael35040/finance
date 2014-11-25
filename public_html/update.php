<?php

require("../includes/config.php");

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//CHECK PASSWORD AND SELECT USER FROM DB
	$rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]); // query database for user
	$row = $rows[0];
	if (count($rows) == 1) // if we found user, check password
	{



        $row = $rows[0];  // first (and only) row
		if (crypt($_POST["password"], $row["password"]) == $row["password"])// compare password of user's input against password that's in database
		{


            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $city = $_POST["city"];
            $region = $_POST["region"];
            $zip = $_POST["zip"];
            $phone = $_POST["phone"];
            $question = $_POST["question"];
            $answer = $_POST["answer"];


            

            if (query("
        INSERT INTO users (email, fname, lname, address, city, region, zip, phone, question, answer, password, registered, last_login, ip, fails, active)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                    $email, $fname, $lname, $address, $city, $region, $zip, $phone, $question, $answer, $password, $now, $now, $ipaddress, 0, 0) === false)
            {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Email already in use. #1");
            }




            $change = $_POST["change"];
			if ($change == 'email')
			{
				if (empty($_POST["email"]) || empty($_POST["confirmation"])){apologize("You must provide a email.");}
				if ($_POST["email"] != $_POST["confirmation"]){apologize("Missmatch. The new email does not match its confirmation.");}
				$email = $_POST["email"];
				$email = sanatize("email", $email);
				if (query("UPDATE users SET email = ( ? ) WHERE id = ( ? )", ($email), $_SESSION["id"]) === false) {apologize("Sorry, some internal error ocured.");}
			}//email
			if ($change == 'phone')
			{	
				if (empty($_POST["phone"]) || empty($_POST["confirmation"])){apologize("You must provide a phone.");}
				if ($_POST["phone"] != $_POST["confirmation"]){ apologize("Missmatch. The new phone does not match its confirmation."); }       
				$phone = $_POST["phone"];
				$phone=sanatize("phone", $phone); //functions.php
				if(query("UPDATE users SET phone = ( ? ) WHERE id = ( ? )", $phone, $_SESSION["id"]) === false){ apologize("Sorry, username already taken."); }
			}//phone
			if ($change == 'password')
			{	
				if (empty($_POST["password"]))  // validate submission{apologize("You must provide your old password.");}
				if (empty($_POST["newpassword"]) || empty($_POST["confirmation"])){apologize("You must enter your new password and re-type it.");}          
				if ($_POST["newpassword"] != $_POST["confirmation"]){apologize("Missmatch. The new password does not match its Confirmation.");}
				if(query("UPDATE users SET password = ? WHERE id = ? ", generate_hash($_POST["newpassword"]), $_SESSION["id"]) === false) {apologize("Sorry, some internal error ocured.");}
			}//password
			redirect("update.php");
		} //password check is correct
		else // (crypt($_POST["password"], $row["password"]) != $row["password"])
			{apologize("Sorry, the 'Current Password' was not correct.");}// compare password of user's input against password that's in database
	} //row of # users
	else {apologize("Sorry, user information incorrect.");}//to many rows
}  //post
else{
	$userinfo = query("SELECT * FROM users WHERE id = ( ? )", $_SESSION["id"]);
	render("update_form.php", ["title" => "Update", "userinfo" => $userinfo]);}// else render form


/*
$fname = $userinfo[0]["fname"];
$lname = $userinfo[0]["lname"];
$email = $userinfo[0]["email"];
$address = $userinfo[0]["address"];
$city = $userinfo[0]["city"];
$region = $userinfo[0]["region"];
$zip = $userinfo[0]["zip"];
$phone = $userinfo[0]["phone"];
$question = $userinfo[0]["question"];
$answer = $userinfo[0]["answer"];
*/

?>
