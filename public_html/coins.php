<div class="exchangeTable">


    <fieldset>

        <table class="table table-condensed  table-bordered" >
        <thead>
            <tr>
                <th style="font-size:120%;">ADVANCE</th>
                <th style="font-size:120%;">ORDER FORM</th>
            </tr>
        </thead>
        <tbody>
        <TR>
            <TD ROWSPAN="1">Symbol</TD>
            <TD>
                <select name="symbol"></select>
            </TD>
        </TR>

            <TR>
                <TD >Side</TD>
                <TD >
                    <INPUT TYPE="radio" NAME="side" VALUE="b" id="buyOrder" required> Buy / Bid Order <br>
                    <INPUT TYPE="radio" NAME="side" VALUE="a" id="sellOrder" required> Sell / Ask Order
                    <INPUT TYPE="radio" NAME="type" VALUE="limit" id='limitSub' required>Limit<br>
                    <INPUT TYPE="radio" NAME="type" VALUE="market" id='marketSub' required> Market
                </TD>
            </TR>



            <TR>
                <TD ROWSPAN="1">Price</TD>
                <TD>
                    <div id="subMenuPrice" style="opacity:1;">
                        <input type="range" id="price" placeholder="Price" name="price" value=0
                        min="0.25" max="100" step=".25" style="width:100%;" required>
                    </div>
                </TD>
            </TR>


        <tr><td colspan="2"> <br>
               <center>
                   <button type="submit" class="btn btn-primary">SUBMIT</button>
               </center>

                <br></td></tr>

        </tbody>

</TABLE>


        <a href="convert.php">
            <button type="button" class="btn btn-danger btn-xs">
                Basic
            </button>
        </a>


    </fieldset>
</form>
</div>




<script>

    //SELL ORDER
    document.getElementById("sellOrder").addEventListener("click", function () {
        document.getElementById('commissionText').innerHTML = '<?php echo(number_format($commission, 2, '.', '')) ?>% commission.';
    }, false);
    //BUY ORDER
    document.getElementById("buyOrder").addEventListener("click", function () {
        document.getElementById('commissionText').innerHTML = 'No commission for Bids!';
    }, false);



    //TYPE MARKET
    document.getElementById("marketSub").addEventListener("click", function () {
        document.getElementById('subMenuPriceText').innerHTML = 'Market Order';
        document.getElementById("subMenuPrice").style.opacity = 0;
        document.getElementById("price").disabled = true;
        document.getElementById('price').value='0';
    }, false);

    //TYPE LIMIT
    document.getElementById("limitSub").addEventListener("click", function () {
        document.getElementById('subMenuPriceText').innerHTML = '';
        document.getElementById("subMenuPrice").style.opacity = 1;
        document.getElementById("price").disabled = false;
    }, false);
</script>
