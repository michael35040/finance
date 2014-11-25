<?php
// configuration
require("../includes/config.php");
//require("../includes/constants.php");






//GET CLIENT IP ADDRESS
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

if (!empty($_SESSION["id"]))
{
    logout();    // log out current user, if any
}

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    // validate submission
    if (empty($_POST["email"])) { apologize("You must provide your email address."); }
    if (empty($_POST["password"])) { apologize("You must provide your password."); }
    if (isValidEmail($_POST["email"], true)==false) { apologize("Invalid email address!");}
    // query database for user
    $rows = query("SELECT * FROM users WHERE email = ?", $_POST["email"]);



    // if we found user, check password
    if (count($rows) == 1)
    {
        // first (and only) row
        $row = $rows[0];
        $active = $row["active"];
        $fails = $row["fails"];
        $id = $row["id"];


        // config already sends to activation.php
        //if ($active != 1) { apologize("Your account has not been activated. An administrator will review it soon."); }

        //checks attempts for the id before trying password to ensure not bruteforce
        $maxAttempts = 5;
        $attemptsLeft = ($maxAttempts-$fails);


        if ($fails > $maxAttempts) { apologize("Too many incorrect login attempts. Please contact us to unlock your account."); }


        // compare password of user's input against password that's in database
        //OLD METHOD
            //if (crypt($_POST["password"], $row["password"]) == $row["password"])
        //NEW METHOD
            if (password_verify($_POST["password"], $row["password"])) {
                remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];
                $_SESSION["email"] = $row["email"];

            //update users last login
            if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $id, 'Login Success', $ipaddress) === false) {apologize("Failure Login Query #1");}
            if(query("UPDATE users SET last_login = now(), fails = 0, ip = ? WHERE id = ?", $ipaddress, $id) === false){ apologize("Failure Login Query #2"); }
            if(query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $id, $ipaddress, 's') === false){ apologize("Failure Login Query #3"); }//update login success
            redirect("index.php");		// redirect to portfolio
        } //password
        else
        {
            if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $id, 'Login Failure', $ipaddress) === false) {apologize("Failure Login Query #4");}
            if(query("UPDATE users SET fails=(fails+1) WHERE (id = ?)", $id) === false) {apologize("Failure Login Query #5");}//update failed attempts with 1 additional failed attempt
            if(query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $id, $ipaddress, 'f') === false) {apologize("Failure Login Query #6");}//update login history to track ips
            apologize("Invalid email and/or password. Only " . $attemptsLeft . " attempts left!" );
        }

    } //ROW COUNT
    elseif (count($rows) == 0) {
        if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'Login Failure', $ipaddress) === false) {apologize("Failure Login Query #7");}
        if(query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", 0, $ipaddress, 'f') === false)  {apologize("Failure Login Query #8");}//update login history to track ips
        apologize("Invalid email and/or password."); 
    }
    else
    {
        if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'Login Failure', $ipaddress) === false) {apologize("Failure Login Query #9");}
        if(query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", 0, $ipaddress, 'f') === false)  {apologize("Failure Login Query #10");}//update login history to track ips
        apologize("Invalid email and/or password.");
    }

} //POST


    $symbol =	query("SELECT symbol FROM assets ORDER BY symbol ASC LIMIT 0,1");

    @$symbol = $symbol[0]["symbol"]; //will be empty if there are no stocks. if(!empty($symbol)) {)


    $bidGroup =	query("SELECT `price`, SUM(`quantity`) AS quantity FROM `orderbook` WHERE (side='b' AND symbol=?) GROUP BY `price` ORDER BY `price` DESC LIMIT 5", $symbol);	  // query user's portfolio
    $askGroup =	query("SELECT `price`, SUM(`quantity`) AS quantity FROM `orderbook` WHERE (side='a' AND symbol=?) GROUP BY `price` ORDER BY `price` ASC LIMIT 5", $symbol);	  // query user's portfolio

// else render form
    render("login_form.php", ["title" => "Log In", "bidGroup" => $bidGroup, "askGroup" => $askGroup]);



//print (var_dump(get_defined_vars()));
?>
