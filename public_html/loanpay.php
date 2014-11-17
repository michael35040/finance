<?php
    
    // configuration 
    require("../includes/config.php");   
    $id = $_SESSION["id"];
	    
apologize("Disabled!");
/*	    
	    
    // if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//get variables
	$quantity = $_POST["quantity"];
	$symbol = $_POST["symbol"];

    // if symbol or shares empty
	if (empty($quantity)) //empty or a value of zero 0.
    {
            apologize("You did not enter the amount to transfer!");
    }   
         
    // checks for whole integer
    if (preg_match("/^([0-9.]+)$/", $quantity) == false)
    {
            apologize("You submitted an invalid quantity. Please enter a positive number to transfer.");
	}
	
	if (is_numeric($quantity) == false) { apologize("Invalid number"); }


		// calculate total quantity held

	$units = query("SELECT units FROM accounts WHERE id = ?", $id);

			// calculate loans
	$loan = query("SELECT loan FROM accounts WHERE id = ?", $id);	


	//convert array to value
	$units = $units[0]['units'];
	$loan = $loan[0]['loan'];
	
	
		// checks to see if they are paying more than they have.
	if ($units < $quantity)  //it might do this in query() > function.php
	{

			apologize("You tried to payoff $" . number_format($quantity,2,".",",") . " but you only have $" . number_format($units,2,".",",") . "!");
	}
	
			// checks to see if they are paying more than they owe.
	if ($loan > ($quantity*-1))  //it might do this in query() > function.php
	{

			apologize("You tried to payoff $" . number_format($quantity,2,".",",") . " but you only owe $" . number_format($loan,2,".",",") . "!");
	}
		            
	
       // transaction information id/transaction/symbol/shares/price/dates
		//$id
        $transaction = 'PAYMENT';      
		//$unittype //set in finance.php
        $shares = 1; //paying the bank back
		//$quantity
        $quantity_neg = ($quantity * -1);               




query("SET AUTOCOMMIT=0");
query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit




//USER LOAN
if (query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $id, $transaction, $symbol, $shares, $quantity_neg) === false)  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("UPDATE accounts SET units = (units - ?) WHERE id = ?", $quantity, $id) === false) //give cash  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("UPDATE accounts SET loan = (loan + ?) WHERE id = ?", $quantity, $id) === false)  //add to loan 
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
//ADMIN LOAN
if (query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $shares, $transaction, $symbol, $id, $quantity) === false)  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}	
if (query("UPDATE accounts SET units = (units + ?) WHERE id = 1", $quantity) === false) //give cash  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("UPDATE accounts SET loan = (loan - ?) WHERE id = 1", $quantity) === false)  //add to loan  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
		



query("COMMIT;"); //If no errors, commit changes
query("SET AUTOCOMMIT=1");


		


unset($_POST); //helps prevent resubmits
render("success_form.php", ["title" => "Success", "transaction" => $transaction, "symbol" => $symbol, "value" => $id, "quantity" => $quantity]); 
// render success form
	
}
 
// if form hasn't been submitted
else
{
// render sell form
render("loanpay_form.php", ["title" => "Pay Loan"]);
}

//var_dump(get_defined_vars());
?>



*/


