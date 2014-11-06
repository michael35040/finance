

<table class="table table-condensed  table-bordered" >

        <tr  class="success">
            <td colspan="7" style="font-size:20px; text-align: center;">ACCOUNTS</td>
        </tr>
        <tr   class="active">
            <th>Account #</th>
            <th>Type</th>
            <th colspan="4">Description</th>
            <th>Amount</th>
        </tr>

        <?php
        $i=0;
        if($units != 0)
        {       ?>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($userid); $i++; echo("-" . $i); ?></td>
                <td><?php echo(strtoupper($unittype)) //set in finance.php ?></td></td>
                <td colspan="4"><?php echo($unitdescription); ?></td>
                <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                    <?php echo(number_format($units,2,".",",")) ?></td>
            </tr>
        <?php
        }
        if($loan <=-0.00000001)
        {   ?>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($userid); $i++; echo("-" . $i); ?></td>
                <td><?php echo(strtoupper("LOAN")) //set in finance.php ?></td></td>
                <td colspan="4">APR: <?php echo(htmlspecialchars(number_format($rate,2)));?>%</td>
                <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                    <?php echo(number_format($loan,2,".",",")) ?></td>
            </tr>
        <?php
        }
        if($locked != 0)
        {
            ?>

            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($userid);
                    $i++;
                    echo("-" . $i); ?></td>
                <td><?php echo(strtoupper($unittype)) //set in finance.php ?></td>
                </td>
                <td colspan="4"><?php echo("Locked-Pending Bid Order"); ?></td>
                <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                    <?php echo(number_format($locked, 2, ".", ",")) ?></td>
            </tr>
        <?php
        }
        if($i == 0)
        {
            echo("<tr><td colspan='7'>You do not have any funds in any accounts</td></tr>");

        } ?>

            <tr  class="active">
                <td colspan="6"><strong>SUBTOTAL</strong></td>
                <td>
                    <strong>
                        <?php
                        $accountsTotal = ($units+$loan+$locked);
                        echo(number_format($accountsTotal, 2, ".", ","))
                        ?>
                    </strong>
                </td>
            </tr>

        <tr><td colspan="7"> </td></tr><!--blank line-->
    <!-- HEADER ROW -->
    <tr class="success">
        <td colspan="7" style="font-size:20px; text-align: center;">PORTFOLIO</td>
    </tr> <!--blank row breaker-->

    <tr  class="active">
        <th>Symbol</th>
        <th>Quantity</th>
        <th>Locked*</th>
        <th>Price</th>
        <th>Purchase</th>
        <th>Loss/Gain</th>
        <th>Market Value</th>
    </tr>

    <!-- STOCKS ROW -->
    <?php $i = 0;
    foreach ($portfolio as $row) {
        echo("<tr>");
        echo("<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . htmlspecialchars($row["symbol"]) . "</td>");  //htmlspecialchars
        echo("<td>" . (number_format($row["quantity"], 0, ".", ",")) . "</td>");
        echo("<td>" . (number_format($row["locked"], 0, ".", ",")) . "</td>");
        echo("<td>" . $unitsymbol . (number_format($row["price"], 2, ".", ",")) . "</td>");
        echo("<td>" . $unitsymbol . (number_format($row["value"], 2, ".", ",")) . "</td>");
        $pricechange = ($row["total"] - $row["value"]);
        if ($row["value"] > 0) {
            $percentchange = 100 * (($row["total"] / $row["value"]) - 1); // total/purchase
        } else {
            $percentchange = 0;
        }
        echo("<td>" . $unitsymbol . number_format($pricechange, 2, ".", ",") . " (<i>" . number_format($percentchange, 2, ".", ",") . "</i>%) ");

        //ARROWS START
        if ($row['value'] < $row['total']) {
            echo("<font color='#00FF00'>&#x25B2;</font></td>");
        } //money is up
        elseif ($row['value'] > $row['total']) {
            echo("<font color='#FF0000'>&#x25BC;</font></td>");
        }  //money is down
        else {
            echo("&#x25C4; &#x25BA; </td>");
        } //even left and right arrow
        //ARROWS END
        echo("<td>" . $unitsymbol . (number_format($row["total"], 2, ".", ",")) . "</td></tr>");
        $i++;
    } //foreach statement


    if ($i == 0) {
        echo("<tr><td colspan='7'>You do not have any stocks in your portfolio account</td></tr>");
        $total = 0;  //set to zero for networth calc
        ?>
        <tr  class="active">
        <td colspan="4"><strong>SUBTOTAL</strong></td>
            <td><strong>0</strong></td>
            <td><strong>0</strong></td>
            <td><strong>0</strong></td>
        </tr>
        <tr>
            <td colspan="7" style="font-size:10px;"><i>&nbsp;&nbsp;&nbsp;&nbsp;* Locked-Pending Ask Order</i></td>
        </tr>
 
        <?php
    } else {
        ?>


        <!-- TOTAL STOCK WORTH -->
        <tr  class="active">
            <td colspan="4"><strong>SUBTOTAL</strong></td>
            <td><strong>
                    <?php //calculate value of purchase price
                    $purchaseprice = $purchaseprice[0]["purchaseprice"]; //convert array to number
                    echo($unitsymbol . number_format($purchaseprice, 2, ".", ",")); //display purchase price
                    ?></strong>
            </td>
            <td><strong>
                    <?php
                    //calculate value of current price
                    $sum = array_shift($portfolio);
                    foreach ($portfolio as $val) {
                        foreach ($val as $key => $val) {
                            $sum[$key] += $val;
                        }
                    } //sum all the values in array
                    $total = $sum['total'];
                    $value = $sum['value'];
                    $change = ($total - $purchaseprice);
                    if ($value > 0) {
                        $percent = 100 * (($total / $value) - 1); // total/purchase
                    } else {
                        $percent = 0;
                    }

                    echo($unitsymbol . number_format($change, 2, ".", ",") . " (<i>" . number_format($percent, 2, ".", ",") . "</i>%) "); //display change

                    //ARROWS START
                    if ($value < $total) {
                        echo("<font color='#00FF00'>&#x25B2;</font>");
                    } //money is up
                    elseif ($value > $total) {
                        echo("<font color='#FF0000'>&#x25BC;</font>");
                    }  //money is down
                    else {
                        echo("&#x25C4; &#x25BA;");
                    } //even left and right arrow
                    //ARROWS END
                    ?></strong>
            </td>
            <td><strong>
                    <?php
                    echo($unitsymbol . number_format($total, 2, ".", ",")); //display market value
                    ?></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7"><i>&nbsp;&nbsp;&nbsp;&nbsp;* Locked-Pending Ask Order</i></td>
        </tr>

    <?php
    } //$i==0 else statement
    ?>





        <tr><td colspan="7"> </td></tr><!--blank line-->
    <tr  class="success">
        <td colspan="7" style="font-size:20px; text-align: center;">NETWORTH</td>
    </tr>

          <!-- NETWORTH ROW -->
    <tr class="active">
        <td colspan="6"><strong>TOTAL</strong></td>
        <td>
            <strong>
                <?php
                echo($unitsymbol);
                $networth = ($total + $units + $loan + $locked);
                echo(htmlspecialchars(number_format($networth, 2, ".", ","))); //networth defined previously
                ?>
            </strong>
        </td>
    </tr>




    </table>
