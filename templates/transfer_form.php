

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




<form action="transfer.php" method="post">

    <fieldset>

        <h3>Transfer:</h3>

        <div class="input-append">

            <div class="input-prepend">
                <span class="add-on"><i class="icon-gift"></i></span>
                <select class="input-small" name="symbol" require />
                <option value=<?php echo($unittype)?> selected><?php echo($unittype)?></option>
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

            <button type="submit" class="btn btn-warning"><b>TRANSFER</b></button>

        </div><!--input-append-->





        <?php //Database allows for cash to be decimal(65,30). 10,000,000,000,000,000,000,000,000,000,000,000.000000000000000000000000000000 offically termed Decillion 10^35 with 10^30 decimals. Large and requires extra menu but since this can cover a variety of items it should be compatiable with most financial calculations regardless of instruments. ?>

        <br />
        <input type="checkbox" name="copyunits" onclick="FillUnits(this.form)"> All <?php echo($unittype);?>
        <br />
        <br />

        <i>This is an instant, permanent, and non-reversible transaction.<br />Ensure your entries are correct!</i>
        <br /><br />
        &middot; <a class="btn btn-primary" href="users.php">SEARCH USERS</a> &middot;
        <br />


    </fieldset>
</form>


<?php //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header) ?>
