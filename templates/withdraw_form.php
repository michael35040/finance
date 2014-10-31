<form action="withdraw.php" method="post">

    <fieldset>
                
 <h3>Withdraw:</h3>
 
<div class="input-append">

        	<div class="input-prepend">
				<span class="add-on"><i class="icon-share"></i></span>
                <select class="input-small" name="symbol" require /><option value=<?php echo($unittype)?> selected><?php echo($unittype)?></option>
                <option value="gold">Gold</option>
				<option value="silver">Silver</option>
				<option value="usd">USD</option>
				<option value="eur">EUR</option>
				<option value="btc">BTC</option>
                
                </select>
			</div><!--input-prepend-->
            
        	<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
                <input class="input-small" name="userid" placeholder="User ID" type="number" min="0" max="any" required />
			</div><!--input-prepend-->
 
         	<div class="input-prepend">
				<span class="add-on"><i><?php echo($unitsymbol);?></i></span>
                <input class="input-medium"  type="number" name="quantity" placeholder="Amount/Quantity" step="0.0000000000001" min="0" max="any" required />
			</div><!--input-prepend-->
            
			<button type="submit" class="btn btn-danger"><b>WITHDRAW</b></button>
            
</div><!--input-append-->  


 <hr />
<h4>If Precious Metals (Gold or Silver)</h4>
 

<?php //Database allows for cash to be decimal(65,30). 10,000,000,000,000,000,000,000,000,000,000,000.000000000000000000000000000000 offically termed Decillion 10^35 with 10^30 decimals. Large and requires extra menu but since this can cover a variety of items it should be compatiable with most financial calculations regardless of instruments. ?>

<input type="radio" name="weight" value="grain" required = "required" /> Grain &nbsp; &nbsp; &middot;  &nbsp; &nbsp;
<input type="radio" name="weight" value="gram" required = "required" checked/> Gram &nbsp; &nbsp; &middot; &nbsp; &nbsp;
<input type="radio" name="weight" value="ozt" required = "required"/> Troy Ounce


</fieldset>
</form>


<table border="1" style="width:500px" align="center"> 
	<tr>
    	<th></th>
        <th><b>grain</b></th>
	    <th>gram</th>
	    <th>troy ounce</th>
    </tr>
    <tr>
    	<td><b>grain</b></td>
    	<td>1</td>
        <td>0.06479891</td>
        <td>0.0020833333333</td>
	</tr>
    <tr>
    	<td><b>gram</b></td>
        <td>15.4323584</td>
        <td>1</td>
        <td>0.0321507466</td>
    </tr>
    <tr>
       	<td><b>troy ounce</b></td>
        <td>480</td>
        <td>31.1034768</td>
        <td>1</td>
    </tr>
</table>


<?php //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header) ?>
  <br />