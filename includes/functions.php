<?php
    /***********************************************************************
     * functions.php
     *
     * Helper functions.
     **********************************************************************/
     

function sanatize($type, $var)
{
	if($type=='phone')
	{
	        $var = str_replace("-", '', $var); //replace these symbols that are commonly typed with phone numbers.
	        $var = str_replace(".", '', $var);
	        $var = str_replace(",", '', $var);
	        $var = str_replace(" ", '', $var);
	        $var = str_replace("(", '', $var);
	        $var = str_replace(")", '', $var);
	        $var = str_replace("&", '', $var);
	        //$var = str_replace("/", '', $var);
	        //$var = str_replace("\\", '', $var);
	        //$var = str_replace("|", '', $var);
	        //$var = str_replace("'"), "", $var);
	        //$var = str_replace('"'), '', $var);
	        if (!is_numeric($var)) { apologize("Phone must be numeric!");} //if quantity is numeric	

	}
	if($type=='quantity')
	{
		if ($var<0){ apologize("Quantity must be positive!");} //if quantity is numeric
    		if (preg_match("/^\d+$/", $var) == false) { apologize("The quantity must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)
    		if (!is_int($var)){ apologize("Quantity must be numeric!");} //ctype_digit will return false on negative and decimals
	}
	if($type=='price')
	{
		if ($var<0){ apologize("Price must be positive!");} //if quantity is numeric
	    	if (!is_float($var)) { apologize("Price must be numeric!");} //if quantity is numeric
	}
	if($type=='alphabet') //side, type, etc.
	{
    		if (!ctype_alpha($var)) { apologize("Must be alphabetic!");} //if symbol is alpha (alnum for alphanumeric)
	}
       return($var);
}


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

// Generate a secure hash for a given password. The cost is passed
// to the blowfish algorithm. Check the PHP manual page for crypt to
// find more information about this setting.
//
function generate_hash($password, $cost=11){  //higher cost equals higher security and higher server workload to generate the hash.
        // To generate the salt, first generate enough random bytes. Because
        // base64 returns one character for each 6 bits, the we should generate
        // at least 22*6/8=16.5 bytes, so we generate 17. Then we get the first
        // 22 base64 characters
        //
        $salt=substr(base64_encode(openssl_random_pseudo_bytes(17)),0,22);
        // As blowfish takes a salt with the alphabet ./A-Za-z0-9 we have to
        // replace any '+' in the base64 string with '.'. We don't have to do
        // anything about the '=', as this only occurs when the b64 string is
        // padded, which is always after the first 22 characters.
        //
        $salt=str_replace("+",".",$salt);
        // Next, create a string that will be passed to crypt, containing all
        // of the settings, separated by dollar signs
        //
        $param='$'.implode('$',array(
                "2a", //select the most secure version of blowfish (read below)
                str_pad($cost,2,"0",STR_PAD_LEFT), //add the cost in two digits
                $salt //add the salt
        ));
		/*
		 Summary: for passwords without characters with the 8th bit set, there's 
		 no issue, all three prefixes work exactly the same. For occasional passwords 
		 with characters with the 8th bit set, if the app prefers security and 
		 correctness over backwards compatibility, no action is needed - just upgrade 
		 to new PHP and use its new behavior (with $2a$). However, if an app install 
		 admin truly prefers backwards compatibility over security, and the problem 
		 is seen on the specific install (which is not always the case because not 
		 all platforms/builds were affected), then $2a$ in existing hashes in the 
		 database may be changed to $2x$. Alternatively, a similar thing may be 
		 achieved by changing $2a$ to $2x$ in PHP app code after database queries, 
		 and using $2y$ on newly set passwords (such that the app's automatic 
		 change to $2x$ on queries is not triggered for them).
		 
		 To encrypt using blowfish in pre-5.3.7, you would prefix your salt with 
		 $2a$ followed by a 2 digit cost parameter (base-2 logarithm, between 04-31), 
		 another $ sign, and finally 22 alphanumeric characters (0-9, A-Z, a-z).
		 So you end up with something like this: $2a$10$22randomcharactershere$
		 With PHP 5.3.7, the behavior of crypt() when using the $2a$ has changed 
		 to promote the new, more secure behavior — this is where the backwards 
		 compatibility break comes in. Now $2a$ will use the correct behavior, 
		 and has explicit countermeasures against the insecurities of the old behavior.
		 Two new prefixes were introduced, $2x$, which exactly replicates the behavior 
		 of $2a$ in pre-5.3.7 and $2y$ which is secure like the new $2a$ but with 
		 no countermeasures 
		 */
       
        //now do the actual hashing
        return crypt($password,$param);
}
 
// Check the password against a hash generated by the generate_hash function.
function validate_pw($password, $hash){
        // Regenerating the with an available hash as the options parameter should produce the same hash if the same password is passed.
        return crypt($password, $hash)==$hash;
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
