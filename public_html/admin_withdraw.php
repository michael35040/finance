<?php
    // configuration 
    require("../includes/config.php");   

$id = $_SESSION["id"];    
if ($id != 1) { apologize("Unauthorized!");}

    // if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//get variables
	$quantity = $_POST["quantity"];
	$userid = $_POST["userid"];

    // if symbol or quantity empty
	if (empty($quantity)) //empty or a value of zero 0.
    {
            apologize("You did not enter the amount!");
    }   
         
   if (preg_match("/^([0-9.]+)$/", $quantity) == false)
    {
            apologize("You submitted an invalid number.");
	}

// calculate total quantity held
	$totalq = query("SELECT units FROM accounts WHERE id = ?", $userid);
	@$total = (float)$totalq[0]["units"]; //convert array to value
	
	if ($quantity > $total)  //only allows user to deposit if they have less than
	{ apologize("You only have " . number_format($total,2,".",",") . " to withdraw!"); }

query("SET AUTOCOMMIT=0");
query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

// transaction information
$transaction = 'WITHDRAW';
// update cash after transaction for user          
    if (query("UPDATE accounts SET units = (units - $quantity) WHERE id = ?", $userid) === false)
    {
    query("ROLLBACK"); //rollback on failure
    query("SET AUTOCOMMIT=1");
    apologize("Database Failure.1");
    }
// update cash after transaction for admin
    if (query("UPDATE accounts SET units = (units + $quantity) WHERE id = ?", 1) === false)
    {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Database Failure.4");
    }
//update transaction history for user
    if (query("INSERT INTO history (id, transaction, symbol, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?)", $userid, $transaction, $symbol, $quantity, $quantity, $quantity) === false)
    {
    query("ROLLBACK"); //rollback on failure
    query("SET AUTOCOMMIT=1");
    apologize("Database Failure.2");
    }
//update transaction history for admin
    if (query("INSERT INTO history (id, transaction, symbol, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?)", 1, $transaction, $symbol, $userid, $quantity, $quantity, $quantity) === false)
    {
    query("ROLLBACK"); //rollback on failure
    query("SET AUTOCOMMIT=1");
    apologize("Database Failure.3");
    }

query("COMMIT;"); //If no errors, commit changes
query("SET AUTOCOMMIT=1");

    $commissionTotal=0;
// render success form
    render("success_form.php", ["title" => "Success", "transaction" => $transaction, "symbol" => $symbol, "value" => $quantity, "quantity" => $quantity, "commissiontotal" => $commissionTotal]); // render success form

}
else // if form hasn't been submitted
{
	
 // render sell form
render("admin_withdraw_form.php", ["title" => "Withdraw"]);
}

//var_dump(get_defined_vars());

	
?>






