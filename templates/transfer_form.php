

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



                <select class="form-control" name="symbol" require />
                <option value=<?php echo($unittype)?> selected><?php echo($unittype)?></option>
                </select>

                <input class="form-control" name="userid" placeholder="User ID" type="number" min="0" max="any" required />

                <input class="form-control"  type="number" name="quantity" placeholder="<?php echo($unitsymbol);?> Amount/Quantity" step="0.0000000000001" min="0" max="any" required />

                <input type="checkbox" name="copyunits" onclick="FillUnits(this.form)"> All <?php echo($unittype);?>
                <br /><br>
                <button type="submit" class="btn btn-warning btn-sm">
                    <span class="glyphicon glyphicon-refresh"></span>
                    &nbsp;  TRANSFER 
                </button>
        <br><br>


      <?php //Database allows for cash to be decimal(65,30). 10,000,000,000,000,000,000,000,000,000,000,000.000000000000000000000000000000 offically termed Decillion 10^35 with 10^30 decimals. Large and requires extra menu but since this can cover a variety of items it should be compatiable with most financial calculations regardless of instruments. ?>

        <i>This is an instant, permanent, and non-reversible transaction.<br />Ensure your entries are correct!</i>
        <br /><br />


    </fieldset>
</form>
