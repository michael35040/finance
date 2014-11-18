<?php
    // configuration
require("../includes/config.php");
//require("../includes/constants.php");


// if form was submitted  -- validate and insert int database
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$username = $_POST["username"];	
$password = $_POST["password"];
$confirmation = $_POST["confirmation"];
$email = $_POST["email"];
$phone = $_POST["phone"];	
	
        // validate submission
if (empty($username)) { apologize("You must provide a username."); }
if (empty($email)) { apologize("You must provide an email."); } 
if (empty($password) || empty($confirmation)) { apologize("You must provide a password and re-type it in the confirmation box."); }
if (empty($phone)) { apologize("You must provide a phone number."); } 
if ($password != $confirmation) { apologize("Password missmatch."); }


// USERNAME
$username = sanatize("username", $username);

//EMAIL
$email = sanatize("email", $email);

//PHONE
$phone = sanatize("phone", $phone);

     
//NEW METHOD
//password_hash($password, PASSWORD_DEFAULT);
/* Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP. 
     For that reason, the length of the result from using this identifier can change over time. Therefore, it is recommended to store the result in a database 
     column that can expand beyond 60 characters (255 characters would be a good choice). */

//OLD METHOD
$password = generate_hash($password); //generate blowfish hash from functions.php
if (strlen($password) != 60) { apologize("Invalid password configuration."); }  // The hashed pwd should be 60 characters long. If it's not, something really odd has happened

query("SET AUTOCOMMIT=0");
query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

//INSERTS INTO HISTORY for user
$quantity = 1; //admins id, will appear on the inital deposit as counterparty id.
		//$initialunits set in finance.php
$neginitialunits = ($initialunits * -1); //initial deposit
$transaction = 'LOAN'; //for listing on history
			      
$now = time(); //get current time in unix seconds
			//UPDATE USERS FOR USER
if (query("INSERT INTO users (username, email, password, phone, last_login, registered, fails) VALUES(?, ?, ?, ?, ?, ?, 0)", $username, $email, $password, $phone, $now, $now) === false) 
{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Username already taken."); 
} 
       
$rows = query("SELECT LAST_INSERT_ID() AS id"); //this takes the id to the next page
$id = $rows[0]["id"]; //sets sql query to var
$_SESSION["id"] = $rows[0]["id"]; //generate session id
$_SESSION["email"] = $email;
$_SESSION["username"] = $username;

if (query("INSERT INTO accounts (id, units, loan, rate) VALUES(?, ?, ?, ?)", $id, $initialunits, $neginitialunits, $loanrate) === false) 
{ 
	query("ROLLBACK"); //rollback on failure
	query("SET AUTOCOMMIT=1");
	apologize("Username already taken."); 
} 


if ($initialunits <= 0)
{								       
	//UPDATE HISTORY FOR USER
	if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'LOAN', $unittype, $quantity, $neginitialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure."); 
	}  	
	if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'DEPOSIT', $unittype, $quantity, $initialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure."); 
	}  	
			
			//UPDATE HISTORY and USERS FOR ADMIN //user id, will appear on the inital deposit for admin
	if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", 1, 'LOAN', $unittype, $id, $initialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure."); 
	} 
	if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", 1, 'DEPOSIT', $unittype, $id, $neginitialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure."); 
	}  						
	if (query("UPDATE accounts SET units = (units - ?) WHERE id = 1", $initialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure."); 
	} 
	if (query("UPDATE accounts SET loan = (loan + ?) WHERE id = 1", $initialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure."); 
	} 


} //initial deposit != 0

$ipaddress = $_SERVER["REMOTE_ADDR"];

//insert into login history table
if (query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $_SESSION["id"], $ipaddress, 's') === false) 
{ 
	query("ROLLBACK"); //rollback on failure
	query("SET AUTOCOMMIT=1");
	apologize("Database Failure."); 
} 
			
			

query("COMMIT;"); //If no errors, commit changes
query("SET AUTOCOMMIT=1");


			
redirect("index.php");
     
} //POST
else // else render form
{
render("register_form.php", ["title" => "Register"]);
}
?>
