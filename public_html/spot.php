<?php

    /***********************************************************************
     * constants.php
     *
     *
     * Global constants.
     **********************************************************************/

define("SERVER", "localhost");    // your database's server
define("DATABASE", "bank");    // your database's name

//define("USERNAME", "root");    // your database's username
//define("PASSWORD", "");    // your database's password
define("USERNAME", "hooah");    // your database's username
define("PASSWORD", "1qaz!QAZ1qaz!QAZ");    // your database's password


//authenticates in functions.php on line 119.

//define("CAN_REGISTER", "any");
//define("DEFAULT_ROLE", "member");
//define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!


?>




<?php

    /***********************************************************************
	 * finance.php
     *
     *
     * Global finance constants.
     **********************************************************************/
//headers.php & config.php
$adminid = 1;

//header & footer
$sitename = 'Spot'; //Pulwar or Element
?>


<?php
    /***********************************************************************
     * functions.php
     *
     * Helper functions.
     **********************************************************************/


    /**
     * Apologizes to user with message.
     */
function apologize($message)
    {
        render("apology.php", ["message" => $message, "title" => "Sorry!"]);
        exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
function logout()
    {
        // unset any session variables
        $_SESSION = array();

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();

    }
function query(/* $sql [, ... ] */)
	{
	$sql = func_get_arg(0);  // SQL statement
	$parameters = array_slice(func_get_args(), 1); // parameters, if any
	static $handle; // try to connect to database
	if (!isset($handle))
	{
		try
		{
            $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD); // connect to database
            $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  // ensure that PDO::prepare returns false when passed invalid SQL
		}
	    catch (Exception $e)
        {
            trigger_error($e->getMessage(), E_USER_ERROR);  // trigger (big, orange) error
            exit;
        }
	}
	$statement = $handle->prepare($sql);  // prepare SQL statement
	if ($statement === false)
	{
		trigger_error($handle->errorInfo()[2], E_USER_ERROR);  // trigger (big, orange) error
		exit;
	}
	$results = $statement->execute($parameters); // execute SQL statement
	if ($results !== false)   // return result set's rows, if any
	{
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	else
	{
		return false;
	}
}

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            require("constants.php");

            // render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }


function isValidEmail($email, $checkDNS = false)
{

    $valid = (
            /* Preference for native version of function */
            function_exists('filter_var') and filter_var($email, FILTER_VALIDATE_EMAIL)
            ) || (
                /* The maximum length of an e-mail address is 320 octets, per RFC 2821. */
                strlen($email) <= 320
                /*
                 * The regex below is based on a regex by Michael Rushton.
                 * However, it is not identical. I changed it to only consider routeable
                 * addresses as valid. Michael's regex considers a@b a valid address
                 * which conflicts with section 2.3.5 of RFC 5321 which states that:
                 *
                 * Only resolvable, fully-qualified domain names (FQDNs) are permitted
                 * when domain names are used in SMTP. In other words, names that can
                 * be resolved to MX RRs or address (i.e., A or AAAA) RRs (as discussed
                 * in Section 5) are permitted, as are CNAME RRs whose targets can be
                 * resolved, in turn, to MX or address RRs. Local nicknames or
                 * unqualified names MUST NOT be used.
                 *
                 * This regex does not handle comments and folding whitespace. While
                 * this is technically valid in an email address, these parts aren't
                 * actually part of the address itself.
                 */
                and preg_match_all(
                    '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?))'.
                    '{255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?))'.
                    '{65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|'.
                    '(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))'.
                    '(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|'.
                    '(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|'.
                    '(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})'.
                    '(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126})'.'{1,}'.
                    '(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|'.
                    '(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|'.
                    '(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::'.
                    '(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|'.
                    '(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|'.
                    '(?:(?!(?:.*[a-f0-9]:){5,})'.'(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::'.
                    '(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|'.
                    '(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|'.
                    '(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD',
                    $email)
            );

    if( $valid )
    {   $tmp = explode('@',$email, 2); //passed to tmp variable to get around 'Only variables should be passed by reference in...'
        if( $checkDNS && ($domain = end($tmp)) )
        {
            /*
            Note:
            Adding the dot enforces the root.
            The dot is sometimes necessary if you are searching for a fully qualified domain
            which has the same name as a host on your local domain.
            Of course the dot does not alter results that were OK anyway.
            */
            return checkdnsrr($domain . '.', 'MX');
        }
        return true;
    }
    return false;
}


     

function sanatize($type, $var)
{
	if($type=='phone')
	{
        $var = preg_replace("/[^0-9]/","", $var);
        if (!is_numeric($var)) { apologize("Phone must be numeric!");} //if quantity is numeric
            $var=(int)$var;
	}
	if($type=='date')
	{
        if (preg_match("/^[-0-9]+$/", $var) == false) {apologize(" You submitted an invalid date.");}
	}
	if($type=='address')
	{ //only alpha numeric, space, period, and comma allowed.
		$var = preg_replace("/[^0-9a-zA-Z .,#!?-]/", "", $var); //keep - at end or it will be interpreted as range.
	}

	if($type=='quantity')
	{	$var = preg_replace("/[^0-9]$/", "", $var);
		if ($var<0){ apologize("Quantity must be positive!");} //if quantity is numeric
    		if (preg_match("/^\d+$/", $var) == false) { apologize("The quantity must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)
    		$var=(int)$var;
    		if (!is_int($var)){ apologize("Quantity must be numeric!");} //ctype_digit will return false on negative and decimals
	}
	if($type=='alphabet') //side, type, etc.
	{	$var = preg_replace("/[^a-zA-Z]/", "", $var);
    		if (!ctype_alpha($var)) { apologize("Must be alphabetic!");} //if symbol is alpha (alnum for alphanumeric)
	}
	if($type=='alnum') //side, type, etc.
	{	$var = preg_replace("/[^0-9a-zA-Z]/", "", $var);
    		if (!ctype_alnum($var)) { apologize("Must be alphabetic or numeric!");} //if symbol is alpha (alnum for alphanumeric)
	}
	if($type=='email') //side, type, etc.
	{	
		if (isValidEmail($var, true)==false) { apologize("Invalid email address!");}
	}
	
       return($var);
}
function getIP()
{
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
    return($ipaddress);
}


function isDomainAvailible($domain) //returns true, if domain is availible, false if not
	{
		//check, if a valid url is provided
		if(!filter_var($domain, FILTER_VALIDATE_URL))
			{ return false; }
		//initialize curl
		$curlInit = curl_init($domain);
		curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,3); //default was 10
		curl_setopt($curlInit,CURLOPT_HEADER,true);
		curl_setopt($curlInit,CURLOPT_NOBODY,true);
		curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
		 //get answer
		$response = curl_exec($curlInit);
		curl_close($curlInit);
		if ($response){return true;}
		else {return false;}
	} 



/*
//BROWKEN AS A USER COULD LOG IN MULTIPLE TIMES A DAY AND NEVER EXCEED THE 1 DAY MARK WHICH WOULD THEN NEVER APLY INTEREST.
function update_loans($id)
{
	$lastupdate = query("SELECT date FROM loan where uid = 1"); //query to see if loans are up to date
	$lastupdate = $lastupdate[0]["date"];
	$now = time(); //get current time in unix seconds
	$days = floor($now / (24 * 60 * 60 )); //make time into days
	$updatedays = ($days - $lastupdate); //subtract dates
	if ($updatedays > 1){
		if (query("UPDATE users SET loan = (loan + (loan * (? * (rate/365))))", $updatedays) === false)	{ apologize("Database Failure Loan Update #1."); } //update loan
		if (query("UPDATE loan SET date = ? where uid = 1", $days) === false) { apologize("Database Failure Loan Update #2."); } } //update time
	
}
function update_loans($id)
{
				$userquery = query("SELECT last_login, loan, rate FROM users where id = ?", $id); //query to see if loans are up to date
				$lastupdate = ($userquery[0]["last_login"]); //query db how much units user has
				$now = time(); //get current time in unix seconds
				//$time = floor($now); // (24 * 60 * 60 )); //make time into days
				$updatetime = ($now - $lastupdate); //subtract dates
				$updatedays = ($updatetime / (24 * 60 * 60));
				if ($updatedays > 1) //if it has been more than 1 day since login update loans
					{
					$oldloan = (float)$userquery[0]["loan"]; //convert array from query to value
					$userrate = (float)$userquery[0]["rate"]; //convert array from query to value
					$interest = ($oldloan * ( $updatedays * ($userrate/365))); //might need to use intval() on $updatedays to convert the float to int.
					$newloan = ($oldloan + $interest);
					if (query("UPDATE users SET loan = ? WHERE id = ?", $newloan, $id) === false)	
					//	if (query("UPDATE users SET loan = (loan + (loan * (? * (rate/365))))", $updatedays) === false)	
						{ apologize("Database Failure Loan Update #1."); } //update loan
					//	if (query("UPDATE loan SET date = ? where uid = 1", $days) === false) 
					//		{ apologize("Database Failure Loan Update #2."); } //update time
					if (query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $id, 'INTEREST', $unittype, 		$updatedays, $interest) === false) { apologize("Database Failure Loan Update #3."); } //update history
					$neginterest = ($interest *-1);
					if (query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", 1, 'INTEREST', $unittype, $id, $neginterest) === false) { apologize("Database Failure Loan Update #3."); } //update history
				}
}


*/


?>




<?php

// if form was submitted
$title = "Guess";
if(!isset($_SESSION["id"])){$id=0;}else{$id=$_SESSION["id"];}


// configuration

if(!isset($_SESSION["id"])){$id=0;}else{$id=$_SESSION["id"];}


//CONTEST #1 FOR WHEN WE HAVE MULTIPLE CONTESTS/EVENTS
$event = 1;
$availableguesses=20;
$minval=0.01; //minimum value
$maxval=50; //maximum price


$format = 'Y-m-j G:i:s';
$contestclose='2015-05-20 12:00:00'; //date of spot at 2400est  
$votingclose=date ( $format, strtotime ( '-1 month' . $contestclose ) );; //last date to submit vote
if(strtotime($votingclose)>time()){$voting='OPEN';}else{$voting='CLOSED';}
////
//$format = 'Y-m-j G:i:s';
//$date = date ( $format );
//// - 7 days from today
//echo date ( $format, strtotime ( '-7 day' . $date ) );
//// - 1 month from today
//echo date ( $format, strtotime ( '-1 month' . $date ) );










//PULL SPOT IF OLDER THAN 15 MINUTES
$prices =	query("SELECT * FROM price");
$pricedate=strtotime($prices[0]["date"]);

if(time()<($pricedate+900)) //300=5m & 900=15m
{
    $bid=$prices[0]["bid"];
    $spot=$prices[0]["spot"];
    $ask=$prices[0]["ask"];
    $change=$prices[0]["change"];
}
else
{
//PULL NY SPOT
    // Include the library
    require('simple_html_dom.php');
    // Retrieve the DOM from a given URL
    $html = file_get_html('http://www.kitco.com/mobile/');
    // Extract all text from a given cell
    $bid = $html->find('td[align="center"]', 9)->plaintext.'<br><hr>'; 
    $ask = $html->find('td[align="center"]', 10)->plaintext.'<br><hr>';
    $change = $html->find('td[align="center"]', 12)->plaintext.'<br><hr>'; 
    $spot=($bid+$ask)/2; $spot=number_format((float)$spot,2,".",""); 
    
 if (query("UPDATE `price` SET `bid`=?,`spot`=?,`ask`=?,`change`=? WHERE `id`=1", $bid, $spot, $ask, $change)) 
 {apologize("Database Failure.");}
 
 $prices =	query("SELECT * FROM price");
$pricedate=strtotime($prices[0]["date"]);
    $bid=$prices[0]["bid"];
    $spot=$prices[0]["spot"];
    $ask=$prices[0]["ask"];
    $change=$prices[0]["change"];

    //$pricedate=time();


    /*
    $gold["bid"] = $html->find('td[align="center"]', 4)->plaintext.'<br><hr>'; 
    $gold["ask"] = $html->find('td[align="center"]', 5)->plaintext.'<br><hr>'; 
    $gold["change"] = $html->find('td[align="center"]', 7)->plaintext.'<br><hr>'; 
    $platinum["bid"] = $html->find('td[align="center"]', 14)->plaintext.'<br><hr>'; 
    $platinum["ask"] = $html->find('td[align="center"]', 15)->plaintext.'<br><hr>'; 
    $platinum["change"] = $html->find('td[align="center"]', 17)->plaintext.'<br><hr>';
    $palladium["bid"] = $html->find('td[align="center"]', 19)->plaintext.'<br><hr>'; 
    $palladium["ask"] = $html->find('td[align="center"]', 20)->plaintext.'<br><hr>';
    $palladium["change"] = $html->find('td[align="center"]', 22)->plaintext.'<br><hr>';
    $rhodium["bid"] = $html->find('td[align="center"]', 24)->plaintext.'<br><hr>'; 
    $rhodium["ask"] = $html->find('td[align="center"]', 25)->plaintext.'<br><hr>';  
    $rhodium["change"] = $html->find('td[align="center"]', 27)->plaintext.'<br><hr>';
    */
}//if age









//SEE IF USER NEEDS TO MAKE A GUESS
$filterusers=null;
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
  if (isset($_POST["user"]))
  {
    $postUser = $_POST["user"];
    $filterusers =	query("SELECT uid, id, price, name, date FROM spot WHERE (id=? AND event = ?) ORDER BY price ASC", $postUser, $event);

  }
      
    
  if (isset($_POST["clear"]) && $id==1)
  {
    if (query("TRUNCATE TABLE `spot`") === false){apologize("Clear Spot Database Failure");}
  }
  
  
  
  if (isset($_POST["newguess"])) 
  {
    //CHECK DATE
    if($voting!='OPEN'){apologize("Contest is not open!");}
     
    //POST DATA TO LOCAL
    $newguess = $_POST["newguess"];
    //CHECK TO MAKE SURE GUESS IS VALID
      if (preg_match("/^([0-9.]+)$/", $newguess) == false) {apologize("You submitted an invalid price. Failure #1. $newguess");}
    ////CURRENCY CHECK
      //ACCEPTS NEGATIVE NUMBER. REMOVE "-?" AT THE BEGINNING TO STOP
      //ACCEPTS ONLY ONE DECIMAL "0.7". IF YOU WANT IT TO ALWAYS BE TWO REPLACE "{1,2}" WITH {2}
      if (preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $newguess) == false) {apologize("You submitted an invalid price. Failure #2. $newguess");}
    //POSITIVE CHECK
      if ($newguess < 0) {apologize("Price must be positive!");}
    
      if ($newguess > $maxval){apologize("Maximum value is $maxval!");}
      if ($newguess < $minval){apologize("Minimum value is $minval!");}


    //SEE IF USER IS AUTHORIZED
    $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (id=?)", $id); // query database for user
    $numberguesses = $countQ[0]["total"];
    if($numberguesses>=$availableguesses){apologize("User has no available guesses!");}
    
    //CHECK TO MAKE SURE PRICE ISNT TAKEN
    $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (price=? AND event=?)", $newguess, $event); // query database for user
     $taken = $countQ[0]["total"];
    if($taken>0){apologize("Price already taken!");}

      //INSERT TO DB
    if (query("INSERT INTO spot (id,price,event) VALUES (?,?,?)", $id, $newguess, $event) === false) {apologize("Unable to insert guess!");}
  
  } //isset
} //if post




//PULL DB QUERY OF CURRENT GUESSES
  //PULLS ALL GUESSES, AT THE MOMENT WE ARE JUST PULLING IT FOR EACH NUMBER
  $guesses =	query("SELECT uid, id, price, name, date FROM spot WHERE event = ? ORDER BY price ASC", $event);
$count=count($guesses);
  if(!empty($guesses)) 
  {

  $i=0;
  $winningDif=$maxval;
  foreach ($guesses as $guess) { 
        $thisValue = $guesses[$i]['price'];
        $currentDif = ($spot-$thisValue);
        
        //WINNING
        if($currentDif<$winningDif&&$currentDif>0){$winning=$guesses[$i]['uid'];$winningDif=$currentDif;}
        $i++;
  }

  }//!empty
  ?>













<!DOCTYPE html>
<html lang="en">
<style>

    .logobar
    {
        width: 100%;
    }
    .logobar table {
        display:inline-block;
    }
    .logobar td
    {
        background-color:transparent;
        text-align:left;
        width:50%;
        text-shadow: 1px 1px 2px #fff;
        color: rgb(102, 111, 119);
        cursor: auto;
        font-family: Roboto, Helvetica, sans-serif;
        font-size: 20px;
        font-stretch: normal;
        font-style: normal;
        font-variant: normal;
        font-weight: 500;
        height: auto;
        letter-spacing: 2px;
        margin-bottom: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 0px;
        padding-bottom: 0px;
        padding-left: 0px;
        padding-right: 0px;
        padding-top: 10px;
        text-decoration: none;
        text-transform: uppercase;
        vertical-align: baseline;
    }
    .navigationBar .btn-default
    {
        color: #444;
        background-color: #ffffff; /*#d1d1d1;*/
        border-color: #E8F9FA;
    }
    .table {margin-bottom:0;} /*set to 20 in bootstrap*/
</style>
<head>
    <title>
        <?php
        if (isset($title))
        {
            echo(htmlspecialchars($sitename));
            echo(" ");
            echo(htmlspecialchars($title));
        }  ?>
    </title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script>


    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/styles.php" rel="stylesheet" media="screen"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div id="page" style="text-align:center; ">
    <div id="top" style="text-align:center; ">






        <table class="logobar">
            <tr>
                <td>
                    <?php echo(htmlspecialchars($sitename)); ?>
                    <img src="img/logo/<?php //echo($ranimg); ?>1.png" width="27" style="vertical-align:middle;" />
                    <?php if(isset($title)){echo("" . htmlspecialchars($title) . "");} ?>
                </td>



                <!-- Menu in style.css -->
                <?php
                //SHOW ON LOG IN ARGUMENT FOR MENU AND INFORMATION
                if (isset($_SESSION["id"]))
                {?>

                    <td>
                        <?php
                        $users =query("SELECT id, email, fname, lname, active FROM users WHERE id = ?", $_SESSION["id"]);
                        @$id = $users[0]["id"];
                        @$email = $users[0]["email"];
                        @$fname = $users[0]["fname"];
                        @$lname = $users[0]["lname"];

                        @$active = $users[0]["active"];
                        if($active==1)
                        {
                            
                            // query cash for template
                            
                            /*
                            //ACCOUNTS UNITS
                            $accounts =	query("SELECT units FROM accounts WHERE id = ?", $id);	 //query db //, loan, rate, approved
                            if(empty($accounts)){$units=0;}
                            else{$units = getPrice($accounts[0]["units"]);}
                            */
                            
                            //LEDGER
                            $accounts = query("SELECT SUM(amount) AS total FROM ledger WHERE (user=? AND symbol=? AND category=?)", $id, $unittype, 'available'); // query user's portfolio
                            if(empty($accounts)){$units=0;}
                            //if($accounts==null){$units=0;}
                            $units = getPrice($accounts[0]["total"]); 



    <div class="navigationBar" align="right">
        <div class="btn-group">

            <div class="btn-group">
                <div class="input-group">
                    <button id="bankButton" type="button" class="btn btn-default  btn-sm   dropdown-toggle" data-toggle="dropdown">
                        <b>MENU</b>
                    <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="account.php">ACCOUNT</a></li>
                        <li><a href="status.php">STATUS</a></li>
                        <li><a href="update.php">UPDATE</a></li>

                        <!--
                         <li><a href="exchange-quick.php">X-QUICK</a></li>
                        <li><a href="transfer.php">Transfer </a></li><li><a href="loan.php">Loan</a></li><?php //if ($loan < 0) { //-0.00000001 ?><li><a href="loanpay.php">Pay Loan</a></li> --><?php //} ?>
                    </ul>
                </div>
            </div>


            <?php if ($_SESSION["id"] == $adminid) { //ADMIN MENU FOR ADMIN?>

                <div class="btn-group">
                    <div class="input-group">
                        <button id="adminButton" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            <!--<span class="glyphicon glyphicon-home"></span>&nbsp;-->
                             <b>ADMIN</b>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="admin.php">Dashboard</a></li>
                            <li><a href="admin_users.php">Users </a></li>
                            <li><a href="admin_offering.php">Offering </a></li>
                            <li><a href="admin_update.php">Update </a></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <div class="btn-group">
                <div class="input-group">
                    <a href="logout.php">
                        <button type="button" class="btn btn-danger  btn-sm ">
                        <!--<b>EXIT</b>-->
                        <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </a>
                </div>
            </div>




        </div><!--btn-group-->
    </div><!--navigationBar-->



                            //include("banner.php");
                        } //if active==1
                        ?>
                    </td>


                <?php
                } //bracket for the show on log in argument
                //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
                ?>



            </tr>
        </table>


<?php
if(1==1){ //if(isset($_SESSION["id"]))
//placing it here it only shows up when logged on so no box on login screen
?>
    </div><!--top-->
    <div id="middle" style="text-align:center;background-color:transparent;border:0;"> 
<?php  
} //bracket for the show on log in argument
?>














<?php
if($id==1){
?>
    <form method="post" action="guess.php">
        <button type="submit" class="btn btn-danger btn-xs" name="clear" value="yes">
        <span class="glyphicon glyphicon-remove-circle"></span>CLEAR TABLE
        </button>
    </form>
<?php
}//if id==1

?>





<table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th>Bid</th>
        <th>Spot</th>
        <th>Ask</th>
        <th>Change</th>
        <th>Updated</th>
    </tr>
    <tr>
        <td><?php echo(number_format((float)$bid,2,".","")); ?></td>
        <td><?php echo(number_format((float)$spot,2,".","")); ?></td>
        <td><?php echo(number_format((float)$ask,2,".","")); ?></td>
        <td><?php echo(number_format((float)$change,2,".","")); ?></td>
        <td><?php echo(date($format,$pricedate)); ?></td>
    </tr>
</table>








<!--DATE-->
<br>
<?php 
function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a d, %h h, %i m, %s s');
}
?>
<table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th>CONTEST DATE</th>
        <th>TIME TO CLOSE</th>
        <th>LAST DAY TO VOTE</th>
        <th>TIME TO VOTE</th>
    </tr>
    <tr>
        <td><?php echo $contestclose; ?></td>
        <td><?php 
            $timeremaining=strtotime($contestclose)-time();
            if($timeremaining>0){echo secondsToTime($timeremaining); }else{echo('Contest is Over!');}
            ?></td>
        <td><?php echo $votingclose; ?></td>
        <td><?php 
            
            $timeremaining=strtotime($votingclose)-time();
            if($timeremaining>0){echo secondsToTime($timeremaining); }else{echo('Voting is Closed!');}
            ?></td>
    </tr>
</table>


<?php //echo('Contest is ' . $contest); ?>
<?php if($voting!='OPEN'){ ?><h2 style="color:red">VOTING IS CLOSED!</h2><?php } ?>
<?php if($voting=='OPEN'){ ?><h2 style="color:green">VOTING IS OPEN!</h2>
<table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th>NEW</th>
        <th>USED</th>
        <th>AVAILABLE</th>
        <th>ALL</th>
    </tr>
    <tr>
        <td>
        <form method="post" action="guess.php">
            <select  name="newguess" >
                <?php 
                $i=$minval;
                while($i<=$maxval){ 
                    $i=round($i, 2); //$i=number_format(($i),2,".","")
                    $taken = query("SELECT COUNT(id) AS total FROM spot WHERE (price=?)", $i); // query database for user
                    $taken = $taken[0]["total"];
                    if($taken<=0){echo('<option value="' .  number_format(($i),2,".",",") . '">' . number_format(($i),2,".",",") . '</option>');} 
                    $i=$i+0.01;}  
                ?>
            </select>
            <button type="submit" >Submit</button>
        </form>
        </td>
        <td><?php 
            $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (id=?)", $id); // query database for user
            $numberguesses = $countQ[0]["total"];
            echo($numberguesses); ?></td>
        <td><?php $guessesleft=$availableguesses-$numberguesses; echo($guessesleft); ?></td>
        <td><?php echo($count); ?></td>
    </tr>
</table>
<?php } //if open ?>

  
  
  

  
  
  
  
  
  
  
  
  
 

<!--WINNING -->
<table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th colspan="4">WINNING GUESS</th>
    </tr>
    <tr>
      <td><b>PRICE</b></td>
      <td><b>USER (ID)</b></td>
      <td><b>SPOT</b></th>
      <td><b>DATE</b></td>
    </tr>   
<?php 
//$winningQ =   query("SELECT uid, id, price, name, date FROM spot WHERE (event=? AND uid=?) ORDER BY price ASC", $event, $winning);
$winningQ =   query("SELECT uid, id, price, name, date FROM spot WHERE (event=? AND price<=?) ORDER BY price DESC LIMIT 1", $event, $spot);
  if(!empty($winningQ)) 
  {
        $distance =           ($winningQ[0]["price"]-$spot);
        $distancepercentage = 100*(($winningQ[0]["price"]-$spot)/$spot);

    echo('<tr style="color:green;font-weight: bolder;font-size: 150%;">');
        echo('<td>' . number_format($winningQ[0]["price"],2,".",",") . '</td>');
        echo('<td><a href="http://www.reddit.com/user/' . $winningQ[0]["name"] . '" target="_blank">' . $winningQ[0]["name"] . '</a> (' . $winningQ[0]["id"] . ')</td>');  //. $guess["name"] . '/'
        echo('<td>' . number_format(($distance),2,".",",") . ' (' . number_format($distancepercentage,2,".",",") . '%)</td>');
        echo('<td>' . $winningQ[0]["date"] . '</td>');
    echo('</tr>');
    }
    else{echo('<tr><td colspan="3">None</td></tr>');}
    ?>
    
</table>










<!--FILTER BY USER-->
<?php
  //USER GUESSERS DROP DOWN
  $guessers =	query("SELECT distinct id, name FROM spot WHERE (event = ?) ORDER BY name ASC", $event);
  if(!empty($guessers)) 
  {
      ?>
  <form method="post" action="guess.php">
    <select  name="user" >
        <?php   foreach ($guessers as $user) { 
            echo('<option value="' . $user["id"] . '">'  . $user["name"] . '</option>');
        } //foreach
        ?>
      </select>
<button type="submit" >FIND USER</button>
</form>          
      
      <?
  }
  ?>
<br>
<?php 
if(!is_null($filterusers))
{ 
    echo('Filtered by user: ' . $postUser);
    echo('
    <table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th>PRICE</th>
        <th>USER (ID)</th>
        <th>SPOT</th>
        <th>DATE</th>
    </tr>');
    foreach ($filterusers as $filtered) { 
        $distance =           ($filtered["price"]-$spot);
        $distancepercentage = 100*(($filtered["price"]-$spot)/$spot);

        echo('<tr>');
        echo('<td>' . number_format($filtered["price"],2,".",",") . '</td>');
        echo('<td>' . $filtered["name"] . ' (' . $filtered["id"] . ')</td>');  //. $guess["name"] . '/'
        echo('<td>' . number_format(($distance),2,".",",") . ' (' . number_format($distancepercentage,2,".",",") . '%)</td>');
        echo('<td>' . $filtered["date"] . '</td>');
        echo('</tr>');
    } //foreach
     echo('</table>');
}//if
?>











<!--ALL-->
 <table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th colspan="6">ALL GUESSES</th>
    </tr>
    <tr>
      <td><b>PRICE</b></td>
      <td><b>USER (ID)</b></td>
      <td><b>SPOT</b></td>
      <td><b>PREV</b></td>
      <td><b>NEXT</b></td>
      <td><b>DATE</b></td>
    </tr>   
<?php
  if(!empty($guesses)) 
  {

  $i=0;
  foreach ($guesses as $guess) { 
      
      $distance =           ($spot-$guess["price"]);
      $distancepercentage = 100*(($spot-$guess["price"])/$spot);

        if($i==0){$prevValue=$minval;}else{$prevValue = $guesses[$i - 1]['price'];}
        $thisValue = $guesses[$i]['price'];
        if($i>=($count-1)){$nextValue=$maxval;}else{
            $nextValue = $guesses[$i + 1]['price'];}
            
        //$percentageDiff = ($nextValue-$thisValue)/$thisValue;
        //$currentDif = ($spot-$thisValue);
      
        
        if($guess["uid"]==$winning){echo('<tr style="color:green;font-weight: bolder;font-size: 150%;">');}
        else{echo('<tr>');}
        echo('<td>' . number_format($guess["price"],2,".",",") . '</td>');
        echo('<td><a href="http://www.reddit.com/user/' . $guess["name"] . '" target="_blank">' . $guess["name"] . '</a> (' . $guess["id"] . ')</td>');  //. $guess["name"] . '/'
        echo('<td>' . number_format(($distance),2,".",",") . ' (' . number_format($distancepercentage,2,".",",") . '%)</td>');
        echo('<td>' . number_format(($prevValue-$guess["price"]),2,".",",") . '</td>');
        echo('<td>' . number_format(($nextValue-$guess["price"]),2,".",",") . '</td>');
        echo('<td>' . $guess["date"] . '</td>');
    echo('</tr>');
    
    $i++;
    } //foreach
  } //if
  else{echo('<tr><td colspan="6">None</td></tr>');}
?>

  </table>







<?php
  if(!empty($guesses)) 
  {
?>

<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>
       <div id="chart_div" style="width: 100%; height: 1000px;"></div>

<script>
          google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Price', 'Price/ID'],<?php   

foreach ($guesses as $guess) 
{ 
    echo('[ ' . $guess["price"] . ', ' . $guess["id"] . '],');   
} //foreach
?>
        ]);

        var options = {
          //title: 'Spot Guesses',
          hAxis: {title: 'Spot Price Guess', minValue: 0, maxValue: 0},
          vAxis: {title: 'User ID', minValue: 0, maxValue: 0},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
</script>

<?php } //if ?>



</div> <!--middle -->
<div id="bottom"  style="text-shadow: 1px 1px 5px #000; z-index:-1;">
<br>
 <?php echo(htmlspecialchars($sitename))?> &#169; 1985-2014

<h6 style='text-align:center; text-shadow: 1px 1px 2px #000; color:white;'>
Server Time: <?php echo(date('Y-m-d H:i:s')); ?>
</h6>

</div> <!--bottom-->


</div> <!--page -->
</body>


</html>
