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
    		if (!ctype_alpha($var)) { apologize("Must be alphabetic or numeric!");} //if symbol is alpha (alnum for alphanumeric)
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
