    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

//CHART 1
        var data = google.visualization.arrayToDataTable([
        <?php 
        echo("['Asset', 'Value'],");
        foreach ($portfolio as $asset) // for each of user's stocks
        {       $value = number_format(($asset["total"]), 0, '.', '');
                $asset = htmlspecialchars($asset["symbol"]);
                echo("['" . $asset . "', " . $value . "],");
        } ?>  
        ]);
        var options = {
        title: 'Portfolio Assets by Value',
        //width: 500,
        height: 500,
        pieSliceText: 'label',
        legend: {position: 'none'},
        //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
        //is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        
        
//CHART 2     
        var data2 = google.visualization.arrayToDataTable([
            ['Accounts', 'Value'],
            ['<?php echo($unitdescription); ?>', <?php echo(number_format($units, 0, ".", "")) ?>],
            ['Locked', <?php echo(number_format($bidLocked, 0, ".", "")) ?>],
            ['Portfolio', <?php echo(number_format($portfolioTotal, 0, ".", "")) ?>]
        ]);
        var options2 = {
        title: 'Networth by Asset Value',
        pieSliceText: 'label',
        legend: {position: 'none'},
       // width: 500,
        height: 500,
        //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
        //is3D: true,
        };
        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart2.draw(data2, options2);

        
      }
    </script>




<table class="table table-condensed  table-bordered" >



    <tr class="success">
        <td colspan="8" style="font-size:20px; text-align: center;">PORTFOLIO</td>
    </tr> <!--blank row breaker-->

    <tr  class="active">
        <th>Asset</th>
        <th>Control</th>
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
           $totalOwned=($row["quantity"]+$row["locked"]);
        echo("<tr>");
        echo("<td><form><button type='submit' class='btn btn-primary btn-xs' formmethod='post' formaction='information.php' name='symbol' value='" . $row['symbol'] . "'><b>&nbsp;" . $row['symbol']
           . "&nbsp;</b></button></form></td>");
        // . htmlspecialchars($row["symbol"]) .
        echo("<td>" . (number_format($totalOwned, 0, ".", ",")) . " (" . (number_format($row["control"], 2, ".", ",")) . "%)</td>");  //htmlspecialchars
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
        echo("<tr><td colspan='8'>You do not have any stocks in your portfolio account</td></tr>");
        $portfolioTotal = 0;  //set to zero for networth calc
        ?>
        <tr  class="active">
        <td colspan="5"><strong>SUBTOTAL</strong></td>
            <td><strong>0</strong></td>
            <td><strong>0</strong></td>
            <td><strong>0</strong></td>
        </tr>
        <tr>
            <td colspan="8" style="font-size:10px;"><i>&nbsp;&nbsp;&nbsp;&nbsp;* Locked-Pending Ask Order(s)</i></td>
        </tr>
 
        <?php
    } else {
        ?>


        <!-- TOTAL STOCK WORTH -->
        <tr  class="active">
            <td colspan="5"><strong>SUBTOTAL</strong> (<?php echo($i); ?> Stocks) <i>&nbsp;&nbsp;&nbsp;&nbsp;* Locked-Pending Ask Order(s)</i></td>
            <td><strong>
                    <?php //calculate value of purchase price
                    $purchaseprice = $purchaseprice[0]["purchaseprice"]; //convert array to number
                    echo($unitsymbol . number_format($purchaseprice, 2, ".", ",")); //display purchase price
                    ?></strong>
            </td>
            <td><strong>
                    <?php
                    
                    /* //DONE ON PORTFOLIO.php
                    //calculate value of current price
                    $sum = array_shift($portfolio);
                    foreach ($portfolio as $val) {
                        foreach ($val as $key => $val) {
                            $sum[$key] += $val;
                        }
                    } //sum all the values in array
                    $portfolioTotal = $sum['total'];
                    $value = $sum['value'];
                     */
                    $change = ($portfolioTotal - $purchaseprice);
                    if ($value > 0) {
                        $percent = 100 * (($portfolioTotal / $purchaseprice) - 1); // total/purchase
                    } else {
                        $percent = 0;
                    }
                   

                    echo($unitsymbol . number_format($change, 2, ".", ",") . " (<i>" . number_format($percent, 2, ".", ",") . "</i>%) "); //display change

                    //ARROWS START
                    if ($value < $portfolioTotal) {
                        echo("<font color='#00FF00'>&#x25B2;</font>");
                    } //money is up
                    elseif ($value > $portfolioTotal) {
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
                    echo($unitsymbol . number_format($portfolioTotal, 2, ".", ",")); //display market value
                    ?></strong>
            </td>
        </tr>

    <?php
    } //$i==0 else statement
    ?>



    <tr><td colspan="8"> </td></tr><!--blank line-->



    <tr  class="success">
        <td colspan="8" style="font-size:20px; text-align: center;">ACCOUNTS</td>
    </tr>
    <tr   class="active">
        <th colspan="2">Account #</th>
        <th>Type</th>
        <th colspan="4">Description</th>
        <th>Amount</th>
    </tr>

    <?php
    $i=0;
    if($units >= 0)
    {       ?>
        <tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($id); $i++; echo("-" . $i); ?></td>
            <td><?php echo(strtoupper($unittype)) //set in finance.php ?></td></td>
            <td colspan="4"><?php echo($unitdescription); ?></td>
            <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                <?php echo(number_format($units,2,".",",")) ?></td>
        </tr>
    <?php
    }
    /*
    if($loan <0)
    {   ?>
        <tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($id); $i++; echo("-" . $i); ?></td>
            <td><?php echo(strtoupper("LOAN")) //set in finance.php ?></td></td>
            <td colspan="4">APR: <?php echo(htmlspecialchars(number_format($rate,2)));?>%</td>
            <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                <?php echo(number_format($loan,2,".",",")) ?></td>
        </tr>
    <?php
    }
    */
    if($bidLocked != 0)
    {
        ?>

        <tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($id);
                $i++;
                echo("-" . $i); ?></td>
            <td><?php echo(strtoupper($unittype)) //set in finance.php ?></td>
            </td>
            <td colspan="4"><?php echo("Locked-Pending Bid Order(s)"); ?></td>
            <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                <?php echo(number_format($bidLocked, 2, ".", ",")) ?></td>
        </tr>
    <?php
    }
    if($i == 0)
    {
        echo("<tr><td colspan='8'>You do not have any funds in any accounts</td></tr>");

    } ?>

    <tr  class="active">
        <td colspan="7"><strong>SUBTOTAL</strong></td>
        <td>
            <strong>
                <?php
                $accountsTotal = ($units+$loan+$bidLocked);
                echo(number_format($accountsTotal, 2, ".", ","))
                ?>
            </strong>
        </td>
    </tr>






    <tr><td colspan="8"> </td></tr><!--blank line-->




    <tr  class="success">
        <td colspan="8" style="font-size:20px; text-align: center;">NETWORTH</td>
    </tr>

          <!-- NETWORTH ROW -->
    <tr class="active">
        <td colspan="7"><strong>TOTAL</strong></td>
        <td>
            <strong>
                <?php
                echo($unitsymbol);
                $networth = ($portfolioTotal + $accountsTotal);
                echo(htmlspecialchars(number_format($networth, 2, ".", ","))); //networth defined previously
                ?>
            </strong>
        </td>
    </tr>

    <?php if($i!=0){ ?>
    <tr>
        <td colspan="4"><div id="piechart" style=""></div></td>
        <td colspan="4"><div id="piechart2" style=""></div></td>
    </tr>
    <?php } ?>










    </table>


<?php   // echo(var_dump(get_defined_vars())); ?>
