<form action="admin_withdraw.php" method="post">
<fieldset>
<h3>Withdraw:</h3>
<br /><input class="input-small" name="userid" placeholder="User ID" type="number" min="0" max="any" required />
<br /><input class="input-medium"  type="number" name="quantity" placeholder="<?php echo($unitsymbol);?> Amount/Quantity" step="0.0000000000001" min="0" max="any" required />
<br /><button type="submit" class="btn btn-danger"><b>WITHDRAW</b></button>
</fieldset>
</form>
<br /><br />
