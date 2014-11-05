<form action="admin_withdraw.php" method="post">

    <fieldset>
                
 <h3>Withdraw:</h3>
 
<div class="input-append">

        	<div class="input-prepend">
                <input class="input-small" name="userid" placeholder="User ID" type="number" min="0" max="any" required />
			</div><!--input-prepend-->
 
         	<div class="input-prepend">
                <input class="input-medium"  type="number" name="quantity" placeholder="<?php echo($unitsymbol);?> Amount/Quantity" step="0.0000000000001" min="0" max="any" required />
			</div><!--input-prepend-->
    <br />
    <button type="submit" class="btn btn-danger"><b>WITHDRAW</b></button>
            
</div><!--input-append-->  



<?php //Database allows for cash to be decimal(65,30). 10,000,000,000,000,000,000,000,000,000,000,000.000000000000000000000000000000 offically termed Decillion 10^35 with 10^30 decimals. Large and requires extra menu but since this can cover a variety of items it should be compatiable with most financial calculations regardless of instruments. ?>

</fieldset>
</form>


<?php //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header) ?>
  <br />   <br />