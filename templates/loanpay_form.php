

<script type="text/javascript">
<!--
function FillUnits(f) 
{
  if(f.copyunits.checked == true) 
  {
    f.quantity.value = <?php echo($units); ?>;
  }
}
// -->
</script>

<form action="loanpay.php" method="post">

 <h3>Pay Loan:</h3>

    <fieldset>

	<div class="input-append"> 
		<select class="input-small" name="symbol"><option value=<?php echo($unittype)?> selected><?php echo($unittype)?></option></select>
		<input  type="number" class="input-small" name="quantity" placeholder="Amount" step="0.0000000000001" min="0" max="any" required = "required"/>
		<button type="submit" class="btn btn-danger">PAY</button>
	</div>

            <?php //Database allows for cash to be decimal(65,30). 10,000,000,000,000,000,000,000,000,000,000,000.000000000000000000000000000000 offically termed Decillion 10^35 with 10^30 decimals. Large and requires extra menu but since this can cover a variety of items it should be compatiable with most financial calculations regardless of instruments. ?>
			<label style="text-align:center; size:1"><input type="checkbox" name="copyunits" onclick="FillUnits(this.form)"> All <?php echo($unittype);?></label>
<br />

<strong>Current Loans: <?php echo($unitsymbol); //set in finance.php ?><?php echo(number_format($loan,2,".",",")); ?></strong><br />

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
<?php
	} //if $loanfee
} //if isset loanfee

	
?>

    </fieldset>
</form>

<?php //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header) ?>
