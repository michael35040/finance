<?php

// configuration
require("../includes/config.php");


$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}
if ($id == 1) { 

// if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //get variables
    $quantity = $_POST["quantity"];
    $userid = $_POST["userid"];
    $transaction = 'DEPOSIT';

    if ( empty($quantity) ||  empty($userid)) { apologize("Please fill all required fields."); } //check to see if empty

    if (preg_match("/^\d+$/", $quantity) == false) { apologize("The number must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)
    if (!ctype_digit($quantity)) { apologize("Quantity must be numeric!");} //if quantity is numeric
    if (!ctype_digit($userid)) { apologize("User ID must be numeric!");} //if quantity is numeric

    // if symbol or quantity empty
    if (preg_match("/^([0-9.]+)$/", $quantity) == false) {apologize("You submitted an invalid number.");}

// transaction information
    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

// update cash after transaction for user          
    if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $quantity, $userid) === false)
    {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Database Failure #P1.");
    } //update portfolio


//update transaction history for user
    if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $userid, $transaction, $symbol, $quantity, $quantity) === false)
    {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Database Failure #P2.");
    } //update portfolio

    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");

//
// render success form
    render("success_form.php", ["title" => "Success", "transaction" => $transaction, "value" => $userid, "quantity" => $quantity]);


}
else // if form hasn't been submitted
{

    // render sell form
    render("admin_deposit_form.php", ["title" => "Deposit"]);
}
} //$id

?>






