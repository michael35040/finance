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
<style>
    #middle
    {
        background-color:transparent;
        border:0;
    }
    .formtable
    {
        /*width:75%;*/
        padding:10px;
        background-color:white;
        border:2px solid black;
        margin-top:5px;
    }
    </style>

<form action="transfer.php" method="post" class="formtable">
    <fieldset>
        <h3>Transfer:</h3>
        <br /><input class="input-small" name="userid" placeholder="User ID" type="number" min="0" max="any" required />
        <br /><input class="input-medium"  type="number" name="quantity" placeholder="<?php echo($unitsymbol);?> Amount/Quantity" step="0.0000000000001" min="0" max="any" required />
        <br /><button type="submit" class="btn btn-warning"><b>TRANSFER</b></button>

        <br /><input type="checkbox" name="copyunits" onclick="FillUnits(this.form)"> All <?php echo($unittype);?>
        <br><br>
        <i>This is an instant, permanent, and non-reversible transaction.<br />Ensure your entries are correct!</i>
        <br /><br />

    </fieldset>
</form>
<br /><br />