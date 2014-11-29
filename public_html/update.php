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
		//if (crypt($_POST["password"], $row["password"]) == $row["password"])// compare password of user's input against password that's in database
		if (password_verify($_POST["password"], $row["password"])) 
		{
			$fname = $_POST["fname"];
			$fname = sanatize("alphabet", $fname);
			$lname = $_POST["lname"];
			$lname = sanatize("alphabet", $lname);
			$email = $_POST["email"];
			$email = sanatize("email", $email);
			$address = $_POST["address"];
			$address = sanatize("address", $address);
			$city = $_POST["city"];
			$city = sanatize("alphabet", $city);
			$region = $_POST["region"]; //state
			$region = sanatize("alphabet", $region);
			$zip = (int)$_POST["zip"];
			$zip = sanatize("quantity", $zip);
			$phone = $_POST["phone"];
			$phone = sanatize("phone", $phone);
			$answer = $_POST["answer"];
			$question = $_POST["question"];
			$password = $_POST["password"];

            $birth = $_POST["birth"];
            $birth = sanatize("date", $birth);

			if (empty($fname)) { apologize("You must provide a First Name."); }
			if (empty($lname)) { apologize("You must provide a Last Name."); }
			if (empty($email)) { apologize("You must provide an Email."); }
			if (empty($address)) { apologize("You must provide an Address."); }
			if (empty($city)) { apologize("You must provide a City."); } //not mandatory
			if (empty($region)) { apologize("You must provide a State/Region."); }
			if (empty($zip)) { apologize("You must provide a Postal Code."); }
			if (empty($phone)) { apologize("You must provide a Phone Number."); }
			if (empty($question)) { apologize("You must provide a Security Question."); }
			if (empty($answer)) { apologize("You must provide a Security Answer."); }
			if (empty($password)) { apologize("You must provide a Password."); }
            if (empty($birth)) { apologize("You must provide a date."); }

			if (query("
			UPDATE users 
			SET email=?, fname=?, lname=?, birth=?, address=?, city=?, region=?, zip=?, phone=?, question=?, answer=?
			WHERE id = ?",
			$email, $fname, $lname, $birth, $address, $city, $region, $zip, $phone, $question, $answer, $_SESSION["id"]) === false)
			{apologize("Email already in use.");}

			if(!empty($_POST["newpassword"]))
			{
				if (empty($_POST["newconfirmation"])) { apologize("If selecting a new password, re-type it in the new confirmation box."); }
				if($_POST["newpassword"]==$_POST["newconfirmation"])
				{
					$newpassword = $_POST["newpassword"];

                    $options = ['cost' => 12,];
                    $newpassword = password_hash($newpassword, PASSWORD_BCRYPT, $options);


                    query("UPDATE users SET password=? WHERE id=?", $newpassword, $_SESSION["id"]);
					
				}
				else{apologize("New password and new confirmation do not match!");}
			}
		}else{apologize("Incorrect Password!");}	
	}else{apologize("unknown user!");}
redirect("update.php");
}  //post
else{
	$userinfo = query("SELECT * FROM users WHERE id =?", $_SESSION["id"]);
	render("update_form.php", ["title" => "Update", "userinfo" => $userinfo]);}// else render form


?>
