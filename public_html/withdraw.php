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
	$symbol = $_POST["symbol"];
	$weight = $_POST["weight"];
	$userid = $_POST["userid"];

	//convert it to grams
	//1ozt = 480grains
	//1ozt = 31.1034768 grams
	//1 grain = 0.06479891 grams
	//1 grain = 0.0020833333333 troy ounce
	//1 gram =	0.0321507466 troy ounce
	//1 gram = 15.4323584 grains
	
	
$metals = array('gold', 'silver');
if(in_array($symbol,$metals)){
//alternative solution
//if ($symbol == 'gold' || $symbol == 'silver')
	if ($_POST["weight"] == "gram"):
		{$quantity = ($quantity * 1);} //grams stay grams 
	elseif($_POST["weight"] == "grain"):
		{$quantity = ($quantity * 0.06479891);} //convert grains to grams 
	elseif($_POST["weight"] == "ozt"):
		{$quantity = ($quantity * 31.1034768);} //convert troy ounce to grams
	else:
		{ apologize("Conversion Error!"); }
	endif;
}
	
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
	$totalq = query("SELECT $symbol FROM accounts WHERE id = ?", $userid);
	@$total = (float)$totalq[0][$symbol]; //convert array to value
	
	if ($quantity > $total)  //only allows user to deposit if they have less than
	{ apologize("You only have " . number_format($total,2,".",",") . " to withdraw!"); }




query("SET AUTOCOMMIT=0");
query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit





		
// transaction information
$transaction = 'WITHDRAW';      
$quantity = 1; //for admin id since that is where the money is coming from
		
// update cash after transaction for user          
if (query("UPDATE accounts SET $symbol = ($symbol - $quantity) WHERE id = ?", $userid) === false) 
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure.1"); 
} 

 
//update transaction history for user
if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $userid, $transaction, $symbol, $quantity, $quantity) === false)
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure.2"); 
} 


//update transaction history for admin
if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", 1, $transaction, $symbol, $userid, $quantity) === false) 
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure.3"); 
}

// update cash after transaction for admin             
if (query("UPDATE accounts SET $symbol = ($symbol + $quantity) WHERE id = ?", 1) === false) 
{ 
query("ROLLBACK"); //rollback on failure
query("SET AUTOCOMMIT=1");
apologize("Database Failure.4"); 
}


			


query("COMMIT;"); //If no errors, commit changes
query("SET AUTOCOMMIT=1");



		
 //suppose to help with prevent resubmits
unset($_POST);

// render success form
render("success_form.php", ["title" => "Success", "transaction" => $transaction, "symbol" => $symbol, "value" => $userid, "quantity" => $quantity]); 

	
}
else // if form hasn't been submitted
{
	
 // render sell form
render("withdraw_form.php", ["title" => "Withdraw"]);
}

//var_dump(get_defined_vars());

	
?>






