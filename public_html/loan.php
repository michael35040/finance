<?php
    
require("../includes/config.php");  // configuration  
//require("../includes/constants.php"); //global finance constants

$id = $_SESSION["id"]; //get id from session

apologize("Disabled!");
/*


//update in case they changed
$accounts =	query("SELECT approved, rate FROM accounts WHERE id = ?", $id);	 //query db 
@$units = $accounts[0]["units"];
@$loan = $accounts[0]["loan"];
@$rate = $accounts[0]["rate"];
@$approved = $accounts[0]["approved"];
@$approved = $accounts[0]['approved'];	//convert array from query to value 


if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{

	 
	//approval button
if(isset($_POST["request"]))
{
//0 approved
//1 unapproved
//2 pending - not yet implemented
	
	if (!empty($_POST["request"]))
	{
		if ($approved == 0):	//change 1 to 0 or 0 to 1;	
			{$approval = 1;}
		elseif ($approved == 1):
			{$approval = 0;}
		else:
			 {apologize("Approval Switch Error.");}
		endif;
		if (query("UPDATE accounts SET approved = ? WHERE id = ?", $approval, $id) === false)
				{ apologize("Database Approval Error."); }
	header('Location: loan.php'); //reload page now that we are approved
	}
						 
}
				


//quick check to see if approved
if ($approved != 0)
		{ apologize("You are not approved for loans."); }










//assign post variables to local variables, not really needed but makes coding easier
$quantity = $_POST["quantity"];
$symbol = $_POST["symbol"];

//check to see if empty
	if (empty($quantity))	// if symbol or quantity empty
		{ apologize("You must enter an amount for loan."); }

	if (preg_match("/^\d+$/", $quantity) == false)	// if quantity is invalid (not a whole positive integer)
		{ apologize("You must enter a whole, positive integer."); }

	if (!ctype_digit($quantity)) 	
		{ apologize("Quantity must be numeric!");}

//Get cash for user
//$units =	query("SELECT units FROM users WHERE id = ?", $id); //query db how much units user has
//$units = $units[0]['units'];	//convert array from query to value

//Get loan for user
$loan =	query("SELECT loan FROM accounts WHERE id = ?", $id); //query db how much units user has
@$loan = $loan[0]['loan'];	//convert array from query to value
    
// transaction information id/transaction/symbol/quantity/price/dates
		//$id
        $transaction = 'LOAN';      
        $quantity = 1; //paying the bank back
		//$quantity
        $quantity_neg = ($quantity * -1);               
		$totalfee = ($quantity * $loanfee);
		$neg_fee = ($totalfee * -1);  

//LIMIT SET in FINANCE.php
if (($loan + $quantity_neg) < $loanlimit)  //only allows user to get loan if they have less than the limit (negative due to negative loans)
	{ apologize("You already have " . number_format($loan,2,".",",") . " in outstanding loans! The limit for loans is " . number_format($loanlimit,2,".",",") . "."); }





query("SET AUTOCOMMIT=0");
query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit





//take rate and update it with latest if it changed
//moved to top to take to next page
$currentrate = ((((1 + $rate) * $loan) + ((1 + $loanrate) * $quantity_neg))/ ($loan + $quantity_neg))-1; //calculate the average between old rate and new rate
if (query("UPDATE accounts SET rate = ? WHERE id = ?", $currentrate, $id) === false)  //add to loan
		{ apologize("Database Failure #R1."); }

 
//USER LOAN
if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'LOAN', $symbol, $quantity, $quantity_neg) === false)  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("UPDATE accounts SET loan = (loan - ?) WHERE id = ?", $quantity, $id) === false)  //add to loan
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'FEE', $symbol, $quantity, $neg_fee) === false)
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("UPDATE accounts SET loan = (loan - ?) WHERE id = ?", $totalfee, $id) === false)  //add to loan
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'DEPOSIT', $symbol, $quantity, $quantity) === false)
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $quantity, $id) === false) //give cash  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}

//ADMIN LOAN
if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $quantity, 'LOAN', $symbol, $id, $quantity) === false) 
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}	 	
if (query("UPDATE accounts SET loan = (loan + ?) WHERE id = 1", $quantity) === false)  //add to loan
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}		
if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $quantity, 'FEE', $symbol, $id, $totalfee) === false) 
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("UPDATE accounts SET loan = (loan + ?) WHERE id = 1", $totalfee) === false) //give cash  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}		
if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $quantity, 'DEPOSIT', $symbol, $id, $quantity_neg) === false)
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}
if (query("UPDATE accounts SET units = (units - ?) WHERE id = 1", $quantity) === false) //give cash  
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure."); 
}




query("COMMIT;"); //If no errors, commit changes
query("SET AUTOCOMMIT=1");


		



     
unset($_POST); //helps prevent resubmits but does not seem to work well
//echo(var_dump(get_defined_vars()));       //dump all variables if i hit error  
render("success_form.php", ["title" => "Success", "transaction" => $transaction, "symbol" => $symbol, "value" => $id, "unittype" => $unittype, "quantity" => $quantity]); // render success form
  
}
else
{
render("loan_form.php", ["title" => "Loan", "approved" => $approved]); // render buy form
}
  
//         echo(var_dump(get_defined_vars()));       //dump all variables if i hit error    
?>

*/
