
<br />
<br />
<?php

//buy/sell/exchange/etc form > success_form.php > success.php > successPRG_form.php 
//POST-REDIRECT-GET: TO PREVENT FORM RESUBMISSIONS!

////from success_form.php
$transaction = $_SESSION['PRGtransaction'];
$symbol = $_SESSION['PRGsymbol'];
$value = $_SESSION['PRGvalue'];
$quantity = $_SESSION['PRGquantity'];
$commissionTotal = $_SESSION['PRGcommissiontotal'];
$confirmation = $_SESSION['PRGconfirmation']; 


if ($transaction === "BUY" || $transaction === "BID")
{
    $value *= -1;
} //to ensure total comes out correctly

echo("
        <br /> <br />
		<table align='center' border=1>
        <tr>
            <th style='width:15%;'>Transaction</th>
            <th style='width:15%;'>Quantity</th>
            <th style='width:15%;'>Symbol</th>
            <th style='width:15%;'>Commission</th>
            <th style='width:15%;'>Total</th>
            <th style='width:15%;'>Confirmation</th>
        </tr>
        <tr>
            <td>" . htmlspecialchars($transaction) . "</td>
            <td>" . htmlspecialchars($quantity) . "</td>
            <td>" . htmlspecialchars($symbol) . "</td>
            <td>" . $unitsymbol . number_format($commissionTotal,2,'.',',') . "</td>
            <td>" . $unitsymbol . number_format($value,2,'.',',') . "</td>
            <td>#" . htmlspecialchars($confirmation) . "</td>
        </tr>
		</table>");
// var_dump(get_defined_vars()); //dump all variables if i hit error
?>

<br /><br />
<a href="history.php" class="btn btn-primary btn-medium"><i class="fa fa-share"></i> &nbsp; CONTINUE</a>
<br /><br />
