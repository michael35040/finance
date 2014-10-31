<?php
if (!isset($commission)) //set at top of buy.php
{
    $commission = 0;
}

?>

<style>
    .exchangeForm {


        text-align: center;
        width: 50%;
        padding: 0px;
        position:relative;
        margin-left: auto;
        margin-right: auto;
        /*
            height:600px;
            display: inline-table;
                    top:0px;
        left:0px;
        right:0px;
        bottom:0px;
                float: left;

        */
    }
    th, td {
        width: 50%;
        padding: 10px;
    }
</style>


<TABLE class="exchangeForm" BORDER="3" cellspacing="0" cellpadding="5" align="center">

<form action="exchange.php" name="exchange_form" method="post"
      oninput="
          priceAmount.value=price.value;
          quantityAmount.value=quantity.value;
          commissionAmount.value=parseFloat(parseInt(quantity.value)*parseInt(price.value)*<?php echo($commission) ?>).toFixed(2);
          subtotal.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)).toFixed(2);
          total.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)+parseFloat(commissionAmount.value)).toFixed(2);
          "
      onclick="
          priceAmount.value=price.value;
          quantityAmount.value=quantity.value;
          commissionAmount.value=parseFloat(parseInt(quantity.value)*parseInt(price.value)*<?php echo($commission) ?>).toFixed(2);
          subtotal.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)).toFixed(2);
          total.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)+parseFloat(commissionAmount.value)).toFixed(2);
          "
    >

    <fieldset>


            <TR>
                <TH ROWSPAN="2">Side</TH>
                <TD><INPUT TYPE="radio" NAME="side" VALUE="b" required> Buy / Bid Order</TD>
            </TR>
            <TR>
                <TD><INPUT TYPE="radio" NAME="side" VALUE="a" required> Sell / Ask Order</TD>
            </TR>

            <TR>
                <TH ROWSPAN="1">Symbol</TH>
                <TD>
                    <input list="symbol" name="symbol" maxlength="8" class="input-small" required><!--<input list="symbol" class="input-small" name="symbol" id="symbol" placeholder="Symbol" type="text" maxlength="5" required-->
                    <datalist id="symbol"><!--select class="input-small" name="symbol" id="symbol" /-->
                        <?php
                        if (empty($stocks)) {
                            echo("<option value=' '>No Stocks Held</option>");
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
                <TH ROWSPAN="1">Price</TH>
                <TD>
                    <!--subMenuPrice-->
                    <div id="subMenuPriceText" style="opacity:1;">
                    </div>
                    <!--subMenuPriceText-->
                    <div id="subMenuPrice" style="opacity:1;">
                        <input class="input-small" type="range" id="price" placeholder="Price" name="price" value=0
                               min="10" max="50" step=".25" style="width:100%;" required><br />
                        $<output name="priceAmount" for="price">0</output>
                    </div>



                </TD>
            </TR>


            <TR>
                <TH ROWSPAN="1">Quantity</TH>
                <TD>
                    <input class="input-small" type="range" id="quantity" placeholder="Quantity" name="quantity" value=1
                           min="1" max="100" step="1" style="width:100%;" required><br />
                    <output name="quantityAmount" for="quantity">1</output>
                </TD>
            </TR>


            </TR>
            <TR>
                <TH ROWSPAN="1">Subtotal</TH>
                <TD>
                    $
                    <output name="subtotal" for="price quantity">0</output>
                </TD>
            </TR>

            <TR>
                <TH ROWSPAN="1">Commission <br> (<?php echo(number_format(100 * $commission, 2, ".", ",")); ?>%)</TH>
                <TD>
                    <?php


                    if ($commission != 0) {
                        $commission *= 100;
                        echo('$<output name="commissionAmount" for="commission">0</output>');
                    } else {
                        echo("No Commission! $0 (0%)");
                    }
                    ?>
                </TD>
            </TR>
            <TR>
                <TH ROWSPAN="1">Total</TH>
                <TD>
                    $
                    <output name="total" for="price quantity commission">0</output>
                </TD>
            </TR>





        <button type="submit" class="btn btn-danger">SUBMIT</button>




    </fieldset>
</form>
</TABLE>




<script>


    //TYPE MARKET
    document.getElementById("marketSub").addEventListener("click", function () {
        document.getElementById('subMenuPriceText').innerHTML = '<font color=red>Market Order</font>';
        document.getElementById("subMenuPrice").style.opacity = 0;
        document.getElementById("price").disabled = true;
        //document.getElementById("price").style.opacity = 0;
        //document.getElementById("price").val = 5;
    }, false);
    //TYPE LIMIT
    document.getElementById("limitSub").addEventListener("click", function () {
        document.getElementById('subMenuPriceText').innerHTML = '';
        document.getElementById("subMenuPrice").style.opacity = 1;
        document.getElementById("price").disabled = false;
        //document.getElementById("price").style.opacity = 1;
        //document.getElementById("price").value = 10;
    }, false);


</script>
