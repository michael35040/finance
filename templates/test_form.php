

<form action="test.php" name="test_form" method="post" oninput="quantityAmount.value=quantity.value;">
    <fieldset>

        <TABLE class="exchangeForm" BORDER="3" cellspacing="0" cellpadding="5" align="center">


            <TR>
                <TH ROWSPAN="1">Symbol</TH>
                <TD>
                    <input list="symbol" placeholder="Symbol" name="symbol" maxlength="8" class="input-small" required><!--<input list="symbol" class="input-small" name="symbol" id="symbol" placeholder="Symbol" type="text" maxlength="5" required-->
                    <datalist id="symbol"><!--select class="input-small" name="symbol" id="symbol" /-->
                        \
                        <?php
                        $stocks =	query("SELECT symbol FROM portfolio GROUP BY symbol ORDER BY symbol ASC");	  // query user's portfolio
                        if (empty($stocks)) {
                            echo("<option value=' '>No Symbols</option>");
                        } else {
                            foreach ($stocks as $stock) {
                                $symbol = $stock["symbol"];
                                $quantity = $stock["quantity"];
                                echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . ")</option>");
                            }
                        }
                        ?>
                    </datalist>
                </TD>
            </TR>


            <TR>
                <TH ROWSPAN="2">Type</TH>

                <TD>

                    <div id="subMenuType" style="opacity:1; display:inline">
                        <INPUT TYPE="radio" NAME="type" VALUE="limit" id='limitSub' required>
                    </div>
                    <!--subMenuType-->
                    <div id="subMenuTypeText" style="display:inline">
                        Limit
                    </div>
                </TD>
            </TR>
            <TR>
                <TD><INPUT TYPE="radio" NAME="type" VALUE="market" id='marketSub' required> Market</TD>
            </TR>


            <TR>
                <TH ROWSPAN="1">Quantity</TH>
                <TD>
                    <input class="input-small" type="range" id="quantity" placeholder="Quantity" name="quantity"
                           value=1
                           min="1" max="100" step="1" required>
                    <output name="quantityAmount" for="quantity">1</output>
                </TD>
            </TR>

        </TABLE>
<br>
        <button type="submit" class="btn btn-danger">SUBMIT</button>


    </fieldset>
</form>

<br>
<br>



<b>Current Orderbook</b><br>
<b>All Symbols</b><br>
<table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
    <!--/////////ORDERS - COMBINED//////-->
    <tr>
        <td colspan="2" bgcolor="#CCCCCC" style="color:black" size="+1" >
            <b>BIDS</b>
        </td>
    </tr>
    <tr>
        <td ><b>Qty</b></td>
        <td ><b>$</b></td>
    </tr>
    <tr>
        <th><?php echo($bidsTotal);?></th>
        <th>ALL</th>
    </tr>
    <?php
    foreach ($bidsGroup as $order)
    {
        $quantity = $order["SUM(`quantity`)"];
        $price = $order["price"];
        echo("<tr><td >" . number_format($quantity,0,".",",") . "</td><td >" . number_format($price,2,".",",") . "</td></tr>");
    }
    ?>
</table>

<table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
    <tr>
        <td colspan="2" bgcolor="#CCCCCC" style="color:black" size="+1" >
            <b>ASKS</b>
        </td>
    </tr>
    <tr>
        <td ><b>$</b></td>
        <td ><b>Qty</b></td>
    </tr>

    <tr>
        <th>ALL</th>
        <th><?php echo($asksTotal);?></th>
    </tr>
    <?php
    foreach ($asksGroup as $order)
    {
        $price = $order["price"];
        $quantity = $order["SUM(`quantity`)"];
        echo("<tr ><td >" . number_format($price,2,".",",") . "</td><td >" . number_format($quantity,0,".",",") . "</td></tr>");
    }
    ?>

</table>
<br />  <br />

