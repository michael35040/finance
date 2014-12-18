
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/sparkline.js"></script>
<script type="text/javascript">
    $(function() {
        /** This code runs when everything has been loaded on the page */
        /* Inline sparklines take their values from the contents of the tag */
        $('.inlinesparkline').sparkline();

        $('.sparklines').sparkline('html', { enableTagOptions: true });

    });
</script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
<?php 

echo("['Asset', 'Value'],");
foreach ($assets as $asset) // for each of user's stocks
{
        $value = number_format(($asset["marketcap"]), $decimalplaces, '.', '');
        $asset = htmlspecialchars($asset["symbol"]);
        echo("['" . $asset . "', " . $value . "],");
} ?>  

        ]);

        var options = {
        title: 'Assets by Value',
        //width: 400,
            //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
            //is3D: true,
        height: 500
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    
    
<style>
    .hiddenRow {
        padding: 0 !important;
    }

    .accordian-body td
    {
        background-color: #eeeeee;
    }

        .nobutton button
        {
            padding:0;
            font-weight: 100;
            border:0;
            background:transparent;
        }
    *
    {
        /*for sparkline box*/
        box-sizing: initial;
        /*box-sizing: content-box;*/

    }
    </style>

<table class="table table-condensed table-bordered table-hover" id="assets" style="border-collapse:collapse;">
    <thead>

    <tr class="success"><td colspan="4" style="font-size:20px; text-align: center;">ASSETS</td>

    <tr class="active"><!-- active warning danger info success -->
        <th width="25%">Symbol</th>
        <th width="25%">Price</th>
        <th width="25%">Volume (<?php echo($timeframe); ?>)</th>
        <th width="25%">Market Cap</th>
    </tr>
    </thead>
    <tbody>
    
    
    <?php $i = 0;
    if(!empty($assets))
    {
        foreach ($assets as $asset)
        {
            $tradesG = query("SELECT SUM(quantity) AS volume, AVG(price) AS price, date FROM trades WHERE ( (type='LIMIT' or type='MARKET') AND symbol =?) GROUP BY DAY(date) ORDER BY date DESC LIMIT 0,7", $asset["symbol"]);      // query user's portfolio
            $tradesG = array_reverse($tradesG); //so it will be in correct ASC order for chart

            //$tradesG = query("SELECT SUM(quantity) AS volume, AVG(price) AS price, date FROM trades WHERE ( (type='LIMIT' or type='MARKET') AND symbol =?) GROUP BY DAY(date) ORDER BY uid ASC LIMIT 0,7", $asset["symbol"]);      // query user's portfolio
            //$tradesG =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE symbol =? GROUP BY DAY(date) ORDER BY uid ASC ", $asset["symbol"]);	  // query user's portfolio

            $tradesCount=count($tradesG);
            $i++;
            echo('<tr data-toggle="collapse" data-target="#demo' . $i . '" class="accordion-toggle">');
            echo('<td><span class="glyphicon glyphicon-chevron-down"></span>&nbsp;&nbsp;&nbsp;&nbsp;' . htmlspecialchars($asset["symbol"]) . ' </td>');
            echo('<td >' . $unitsymbol . (number_format($asset["price"], $decimalplaces, ".", ",")));
            echo('&nbsp;&nbsp;<span class="sparklines" sparkType="line" >');
                $t=0;
                foreach($tradesG as $trade){
                    echo(number_format(getPrice($trade["price"]), $decimalplaces, ".", ""));
                    $t++;
                    if($t<$tradesCount){echo(",");}
                }
            echo('</span></td>');
            echo('<td >' . (number_format($asset["volume"], 0, ".", ",")));
            echo('&nbsp;&nbsp;<span class="sparklines" sparkType="bar" sparkBarColor="blue" >');
                $t=0;
                foreach($tradesG as $trade){
                    echo(number_format(($trade["volume"]), 0, ".", ""));
                    $t++;
                    if($t<$tradesCount){echo(",");}
                }
            echo('</span>');



            echo('</td>');            
            echo('<td >' . $unitsymbol . htmlspecialchars(number_format($asset["marketcap"], $decimalplaces, ".", ",")) . '</td>');
            echo('</tr>');
            echo('<div  class="hiddenRow">');
            echo('<tr class="accordian-body collapse" id="demo' . $i . '"   >');
            echo('<td colspan="1">&nbsp;&nbsp;' . htmlspecialchars($asset["name"]) . '
                <br>&nbsp;&nbsp;' . htmlspecialchars($asset["url"]) . '
                <br>&nbsp;&nbsp;<form method="post" action="information.php"><span class="nobutton"><button type="submit" name="symbol" value="' . $asset["symbol"] . '"><span class="glyphicon glyphicon glyphicon-info-sign"> Information</span></button></span></form></td>');
            echo('<td >' . $unitsymbol . (number_format($asset["bid"], $decimalplaces, ".", ",")) . ' - Bid
                <br>' . $unitsymbol . (number_format($asset["ask"], $decimalplaces, ".", ",")) . ' - Ask
                <br>' . $unitsymbol . (number_format($asset["avgprice"], $decimalplaces, ".", ",")) . ' - Avg. Price (' . $timeframe . ')</td>');
            echo('<td >' . (number_format($asset["public"], 0, ".", ",")) . ' - Publicly Held
                <br>' . (number_format($asset["issued"], 0, ".", ",")) . ' - Issued (' . (number_format($asset["userid"], 0, ".", ",")) . ')
                <br>' . htmlspecialchars($asset["date"]) . ' - Listed</td>');
            echo('<td >
                Type: ' . htmlspecialchars(ucfirst($asset["type"])) . '<br>
                ');
            //COMMODITY, CURRENCY, STOCK
                if ($asset["type"]=="stock"){echo('
                Rating: ' . htmlspecialchars($asset["rating"]) . ' <br>
                Dividend: ' . number_format($asset["dividend"], $decimalplaces, ".", ",")
                ); }
                //elseif  ($asset["type"]=="commodity"){echo('Ratio: ' . number_format($asset["dividend"], $decimalplaces, ".", ",")); }
                //elseif  ($asset["type"]=="currency"){echo('Exc. Rate: ' . number_format($asset["dividend"], $decimalplaces, ".", ",")); }
            echo('</td></tr>');
        }
        echo("<tr><td colspan='3'><strong>Market Value</strong></td><td><strong>" . $unitsymbol . (number_format($indexMarketCap, $decimalplaces, ".", ",")) . "</strong></td></tr>");
        echo('<tr><td colspan="4"><div id="piechart" style=""></div></td></tr>');
    }
    if($i==0)
    {
        echo("<tr><td colspan='4'><i>No assets</i></td></tr>");
    }
    ?>
    
    
    
    </tbody>
</table>



<?php //echo(var_dump(get_defined_vars())); ?>
