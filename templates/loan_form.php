


<?php
if ($approved == 0): //0 is approved
{
?>	



<form action="loan.php" name="loan_form" method="post">
<h3>Loan Application: <font color='green'>Approved</font></h3>
<fieldset>

<div class="input-append">
	<select class="input-small" name="symbol"><option value=<?php echo($unittype)?> selected><?php echo($unittype)?></option></select>
	<input class="input-small" name="quantity" placeholder="Loan Amount" type="number" min="0" max="any" required/>
	<button type="submit" class="btn btn-success">GET LOAN</button>
</div>

<br />
<br />
<strong>Available Credit: <?php echo($unitsymbol) //set in finance.php ?><?php 
$credit=($loanlimit-$loan)*-1; 
if ($credit <= 0) 
{ 
	echo("0 (" . number_format($credit,2,".",",") . " over limit)");
}
else
{
echo(number_format($credit,2,".",","));
}
?></strong><br />
<strong>Loan Limit: <?php echo($unitsymbol); echo(number_format($loanlimit,2,".",",")); ?></strong><br />

<strong>Current Loans: <?php echo($unitsymbol); //set in finance.php ?><?php echo(number_format($loan,2,".",",")); ?></strong><br />

<?php if (isset($loanfee) ) //set at top of buy.php
{
	if($loanfee != 0)
	{ ?>
    <br /><strong>Origination Fee: <?php $loanfee *= 100; echo(number_format($loanfee,2,".",",")) ?>%</strong>
<?php 
	if (isset($loanrate) ) //set at top of buy.php
	{
		if($loanrate != 0)
		{
		?>
	    <br /><strong>Annual Percentage Rate: <?php $loanrate *= 100; echo(number_format($loanrate,2,".",",")) ?>%</strong>
<br /><i>*Overall rate will be adjusted according<br /> to your current rate and this rate.</i>       
<?php 
		} //loanrate
	} //isset loanrate 
?> 
</fieldset>
</form>


<form action="loan.php" name="loan_form" method="post">
<input type="hidden" name="request" value="cancelloan" />  	
<br />
<button type="submit" class="btn btn-danger">CANCEL APPROVAL</button>	
</fieldset>
</form>
    
<?php
	} //if $loanfee
} //if isset
} //if approved
elseif ($approved == 1): //1 is unapproved
{	
?>
<h3>Loan Application: <font color='red'>Unapproved</font></h3>
<form action="loan.php" name="loan_form" method="post">
<fieldset>
<input type="hidden" name="request" value="requestloan" />  	
<br />
<button type="submit" class="btn btn-warning">REQUEST APPROVAL</button>
</fieldset>
</form>
<?php
} //unapproved

else: //neither approved or unapproved
echo("<font color='red'>Approval Error!</font>");
endif;
//echo(var_dump(get_defined_vars()));       //dump all variables if i hit error

?>







