<?php
    // configuration
require("../includes/config.php");
//require("../includes/constants.php");


// if form was submitted  -- validate and insert int database
if ($_SERVER["REQUEST_METHOD"] == "POST")
{ //        var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
    if(!ctype_digit($_POST["captcha"])){apologize("Incorrect captcha input!");}
    $code=$_SESSION["code"];
    $captcha=(int)$_POST["captcha"];
    if($code!=$captcha){echo("Incorrect captcha!"); exit(); }
    // else($code===$captcha){echo("Correct captcha!"); exit(); }

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
    
    @$zip = (int)$_POST["zip"];
    $zip = sanatize("wholenumber", $zip);

    $phone = $_POST["phone"];
    $phone = sanatize("phone", $phone);

    $answer = $_POST["answer"];
    

    $question = $_POST["question"];
    $password = $_POST["password"];
    $confirmation = $_POST["confirmation"];


        // validate submission
    if (empty($password) || empty($confirmation)) { apologize("You must provide a password and re-type it in the confirmation box."); }
    if ($password != $confirmation) { apologize("Password missmatch."); }
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
    if (empty($confirmation)) { apologize("You must provide a Password Confirmation."); }


     
//NEW METHOD
//password_hash($password, PASSWORD_DEFAULT);
/* Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP. 
     For that reason, the length of the result from using this identifier can change over time. Therefore, it is recommended to store the result in a database 
     column that can expand beyond 60 characters (255 characters would be a good choice). */

//OLD METHOD
$password = generate_hash($password); //generate blowfish hash from functions.php
if (strlen($password) != 60) { apologize("Invalid password configuration."); }  // The hashed pwd should be 60 characters long. If it's not, something really odd has happened


    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')):
    { $ipaddress = getenv('HTTP_CLIENT_IP'); }
    elseif(getenv('HTTP_X_FORWARDED_FOR')):
    { $ipaddress = getenv('HTTP_X_FORWARDED_FOR'); }
    elseif(getenv('HTTP_X_FORWARDED')):
    { $ipaddress = getenv('HTTP_X_FORWARDED'); }
    elseif(getenv('HTTP_FORWARDED_FOR')):
    { $ipaddress = getenv('HTTP_FORWARDED_FOR'); }
    elseif(getenv('HTTP_FORWARDED')):
    { $ipaddress = getenv('HTTP_FORWARDED'); }
    elseif(getenv('REMOTE_ADDR')):
    { $ipaddress = getenv('REMOTE_ADDR'); }
    else:
    { $ipaddress = 'UNKNOWN'; }
    endif;


query("SET AUTOCOMMIT=0");
query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit



//INSERTS INTO HISTORY for user
$quantity = 1; //admins id, will appear on the inital deposit as counterparty id.
		//$initialunits set in finance.php
$neginitialunits = ($initialunits * -1); //initial deposit
$transaction = 'LOAN'; //for listing on history

$now = time(); //get current time in unix seconds
			//UPDATE USERS FOR USER
if (query("
        INSERT INTO users (email, fname, lname, address, city, region, zip, phone, question, answer, password, registered, last_login, ip, fails, active)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        $email, $fname, $lname, $address, $city, $region, $zip, $phone, $question, $answer, $password, $now, $now, $ipaddress, 0, 0) === false)
{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Email already in use. #1"); 
} 
       
$rows = query("SELECT LAST_INSERT_ID() AS id"); //this takes the id to the next page
$id = $rows[0]["id"]; //sets sql query to var
$_SESSION["id"] = $rows[0]["id"]; //generate session id
$_SESSION["email"] = $email;

if (query("INSERT INTO accounts (id, units, loan, rate, approved) VALUES(?, ?, ?, ?, ?)", $id, $initialunits, $neginitialunits, $loanrate, 0) === false)
{ 
	query("ROLLBACK"); //rollback on failure
	query("SET AUTOCOMMIT=1");
	apologize("Email already in use. #2"); 
} 


if ($initialunits != 0)
{								       
	//UPDATE HISTORY FOR USER
	if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'LOAN', $unittype, $quantity, $neginitialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure. #2"); 
	}  	
	if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'DEPOSIT', $unittype, $quantity, $initialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure. #3"); 
	}  	
			
			//UPDATE HISTORY and USERS FOR ADMIN //user id, will appear on the inital deposit for admin
	if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", 1, 'LOAN', $unittype, $id, $initialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure. #4"); 
	} 
	if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", 1, 'DEPOSIT', $unittype, $id, $neginitialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure. #5"); 
	}  						
	if (query("UPDATE accounts SET units = (units - ?) WHERE id = 1", $initialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure. #6"); 
	} 
	if (query("UPDATE accounts SET loan = (loan + ?) WHERE id = 1", $initialunits) === false) 
	{ 
		query("ROLLBACK"); //rollback on failure
		query("SET AUTOCOMMIT=1");
		apologize("Database Failure. #7"); 
	} 


} //initial deposit != 0

$ipaddress = $_SERVER["REMOTE_ADDR"];

//insert into login history table
if (query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $id, $ipaddress, 's') === false) 
{ 
	query("ROLLBACK"); //rollback on failure
	query("SET AUTOCOMMIT=1");
	apologize("Database Failure. #8"); 
} 
			
			

query("COMMIT;"); //If no errors, commit changes
query("SET AUTOCOMMIT=1");

redirect("status.php");
//apologize("You have successfully registered. Now your account needs to be activated.");
     
     
} //POST
else // else render form
{
render("register_form.php", ["title" => "Register"]);
}
?>
