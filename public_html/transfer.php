<?php
    
    // configuration 
    require("../includes/config.php");
	//require("../includes/constants.php"); //global finance constants

    $id = $_SESSION["id"];
	    
    // if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//get variables
	$quantity = $_POST["quantity"];
	$userid = $_POST["userid"];
	
	if (empty($userid))
		{apologize("You must enter the User ID of who you want to transfer funds to!");}
	// if symbol or quantity empty
	if (empty($quantity)) //empty or a value of zero 0.
		{apologize("You did not enter the amount to transfer!");}   
	//if (empty($userid) || empty($quantity)) //redundant check of either but already accomplished in the previous two args. not needed.
	//    {apologize("You must enter a user ID and enter a quantity.");}            
	
	// checks for whole integer
	if (!ctype_digit($userid)) 	
		{ apologize("User ID must be numeric!");}
	
	if (preg_match("/^\d+$/", $userid) == false)
		{apologize("You entered a negative number for user ID! A User ID should be a positve integer.");}
	if (preg_match("/^([0-9.]+)$/", $quantity) == false)
		{apologize("You submitted an invalid quantity. Please enter a positive number to transfer.");}
	if (is_numeric($quantity) == false) 
		{ apologize("Invalid number"); }
	//if (!ctype_digit($quantity)) 	
	//	{ apologize("User ID must be numeric!");} //gives error since quantity can be decimal
	
	//check to see if valid id
	$num_user = query("SELECT count(*) AS num_user FROM users WHERE id = ?", $userid);
	$count = $num_user[0]['num_user'];
	if ($count == 0) {apologize("User ID not found.");}
	elseif ($count != 1) { apologize("Invalid User ID.");}
	elseif ($count == 1)
	{
		// calculate total quantity held
		$totalq = query("SELECT units FROM accounts WHERE id = ?", $id);
		@$total = (float)$totalq[0]['units']; //convert array to value
		
		// checks to see if they are transfer more than they have.
		if ($total < $quantity)  //it might do this in query() > function.php
		{apologize("You tried to transfer " . number_format($quantity,2,".",",") . " but you only have " . number_format($total,2,".",",") . "!");}
				
		// transaction information
		$transaction = 'TRANSFER';      
		$commission = ($quantity * $commission);
		$price = ($quantity - $commission);

	
		query("SET AUTOCOMMIT=0");
		query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
		
		// update cash after transaction             
		if (query("UPDATE accounts SET units = (units - ?) WHERE id = ?", $price, $id))  
			{ 
			query("ROLLBACK"); //rollback on failure
			query("SET AUTOCOMMIT=1");
			apologize("Database Failure."); 
			}
		// transfer the cash to other user
		if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $price, $userid)) 
			{ 
			query("ROLLBACK"); //rollback on failure
			query("SET AUTOCOMMIT=1");
			apologize("Database Failure."); 
			}
		// transfer the cash to admin
		if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $commission, 1)) 
			{ 
			query("ROLLBACK"); //rollback on failure
			query("SET AUTOCOMMIT=1");
			apologize("Database Failure."); 
			}	
			
		//update transaction history for transferer
		if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $id, 'TRANSFER', 'OUTGOING', $userid, $price, $commission, $quantity))
			{ 
			query("ROLLBACK"); //rollback on failure
			query("SET AUTOCOMMIT=1");
			apologize("Database Failure."); 
			}
		//update transaction history for transferee
		if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $userid, 'TRANSFER', 'RECEIVING', $id, $price, $commission, $quantity))
			{ 
			query("ROLLBACK"); //rollback on failure
			query("SET AUTOCOMMIT=1");
			apologize("Database Failure."); 
			}
		$symbol = 'RECEIVING';
        $value = $quantity;

		query("COMMIT;"); //If no errors, commit changes
		query("SET AUTOCOMMIT=1");
		
		render("success_form.php", ["title" => "Success", 
		"transaction" => $transaction, 
		"symbol" => $symbol, 
		"value" => $value, 
		"quantity" => $quantity,
		"commissiontotal" => $commission
		//"variable_on_success_form" => $local_var_on_this_form.
		]); 
		
		// render success form
	}//if count==1

       if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", 1, $transaction, $symbol, $quantity, $price, $commissionTotal, $id) === false)
        {   //UPDATE HISTORY 
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Insert History Failure");
        }    


	
}
else // if form hasn't been submitted
{
render("transfer_form.php", ["title" => "Transfer"]); // render sell form
} 

//var_dump(get_defined_vars());
?>






