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
                	$change = $_POST["change"];
			if ($change == 'email')
			{
				if (empty($_POST["email"]) || empty($_POST["confirmation"])){apologize("You must provide a email.");}
				if ($_POST["email"] != $_POST["confirmation"]){apologize("Missmatch. The new email does not match its confirmation.");}
				$email = $_POST["email"];
				$email = filter_input(INPUT_POST, $email, FILTER_SANITIZE_EMAIL);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { apologize("The email address you entered is not valid."); }   // Not a valid email
				if (query("UPDATE users SET email = ( ? ) WHERE id = ( ? )", ($_POST["email"]), $_SESSION["id"]) === false) {apologize("Sorry, some internal error ocured.");}
			}//email
			if ($change == 'phone')
			{	
				if (empty($_POST["phone"]) || empty($_POST["confirmation"])){apologize("You must provide a phone.");}
				if ($_POST["phone"] != $_POST["confirmation"]){ apologize("Missmatch. The new phone does not match its confirmation."); }       
				$phone = $_POST["phone"];
				$phone=sanatize($phone);
				if (!ctype_digit($phone)) { apologize("Phone must be numeric!");} //if quantity is numeric	
				if(query("UPDATE users SET phone = ( ? ) WHERE id = ( ? )", $phone, $_SESSION["id"]) === false){ apologize("Sorry, username already taken."); }
			}//phone
			if ($change == 'password')
			{	
				if (empty($_POST["password"]))  // validate submission{apologize("You must provide your old password.");}
				if (empty($_POST["newpassword"]) || empty($_POST["confirmation"])){apologize("You must enter your new password and re-type it.");}          
				if ($_POST["newpassword"] != $_POST["confirmation"]){apologize("Missmatch. The new password does not match its Confirmation.");}
				if(query("UPDATE users SET password = ? WHERE id = ? ", generate_hash($_POST["newpassword"]), $_SESSION["id"]) === false) {apologize("Sorry, some internal error ocured.");}
			}//password
			if ($change == 'username')
			{	
				if (empty($_POST["username"])){apologize("You must provide a username.");}
				if (empty($_POST["confirmation"])){apologize("You must re-type your username.");}
				if (!ctype_alnum($_POST["username"])) {apologize("Usernames must be alphanumeric (A-Z and/or 0-9)!");}
				if ($_POST["username"] != $_POST["confirmation"]){apologize("Missmatch. The new username does not match its confirmation.");}       
				if(query("UPDATE users SET username = ( ? ) WHERE id = ( ? )", ($_POST["username"]), $_SESSION["id"]) === false){apologize("Sorry, username already taken.");}
			}//username
			redirect("change.php");
		} //password check is correct
		else // (crypt($_POST["password"], $row["password"]) != $row["password"])
			{apologize("Sorry, the 'Current Password' was not correct.");}// compare password of user's input against password that's in database
	} //row of # users
	else {apologize("Sorry, user information incorrect.");}//to many rows
}  //post
else{
	$userinfo = query("SELECT username, email, phone FROM users WHERE id = ( ? )", $_SESSION["id"]);
	render("change_form.php", ["title" => "Change User Account", "userinfo" => $userinfo]);}// else render form

?>
