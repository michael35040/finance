<?php
// configuration
require("../includes/config.php");
//require("../includes/constants.php");

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
    {
        if( $checkDNS && ($domain = end(explode('@',$email, 2))) )
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
    if (isValidEmail($_POST["email"], true)==true) { apologize("Invalid email address!");}
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


        // else apologize



        //checks attempts for the id before trying password to ensure not bruteforce
        $maxAttempts = 5;
        $attemptsLeft = ($maxAttempts-$fails);

        if ($active != 1) { apologize("Your account has not been activated. An administrator will review it soon."); }
        if ($fails > $maxAttempts) { apologize("Too many incorrect login attempts. Please contact us to unlock your account."); }

        // compare password of user's input against password that's in database
        //NEW METHOD
        /*
        if (password_verify($_POST["password"], $row["password"])) {
                remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];
                $_SESSION["email"] = $row["email"];
        } else {
            echo 'Invalid password.';
        }
        */

        //OLD METHOD
        if (crypt($_POST["password"], $row["password"]) == $row["password"])
        {
            // remember that user's now logged in by storing user's ID in session
            $_SESSION["id"] = $id;
            $_SESSION["email"] = $row["email"];

            //update users last login
            if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $id, 'Login Success', $ipaddress) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure Login Query");}
            if (query("UPDATE users SET last_login = now(), fails = 0, ip = ? WHERE id = ?", $ipaddress, $id) === false){ apologize("Database Failure #L1."); 		}
            query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $id, $ipaddress, 's');//update login success
            redirect("index.php");		// redirect to portfolio
        } //password
        else
        {
            if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $id, 'Login Failure', $ipaddress) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure Login Query");}
            query("UPDATE users SET fails=(fails+1) WHERE (id = ?)", $id);//update failed attempts with 1 additional failed attempt
            query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $id, $ipaddress, 'f');//update login history to track ips
            apologize("Invalid email and/or password. Only " . $attemptsLeft . " attempts left!" );
        }

    } //ROW COUNT
    elseif (count($rows) == 0) {
        if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $id, 'Login Failure', $ipaddress) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure Login Query");}
        query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", 0, $ipaddress, 'f');//update login history to track ips
        apologize("Invalid email and/or password."); }

    else
    {
        if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $id, 'Login Failure', $ipaddress) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure Login Query");}
        query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", 0, $ipaddress, 'f');//update login history to track ips
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
