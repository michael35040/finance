<?php

require("../includes/config.php");

// render header
require("../templates/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    $symbol = $_POST["symbol"];
    $lastTrade = query("SELECT price FROM trades WHERE symbol=? ORDER BY date ASC LIMIT 0, 1", $symbol);
    if (count($lastTrade) < 1){apologize("Incorrect symbol!");} //check to see if exists in db
    //WORKING SQL QUERY FOR CHARTING DAILY TRADES
    $trades = query("SELECT quantity, price, date FROM trades WHERE symbol=? ORDER BY uid ASC ", $symbol);

    ?>
    <head>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart()
            {

                var data = google.visualization.arrayToDataTable([
                    <?php

                    echo("['Date', 'Price', 'Volume(k)'],"); // ['Year', 'Sales', 'Expenses'],
                    //SQL QUERY FOR ALL TRADES

                    foreach ($trades as $trade)	// for each of user's stocks
                    {
                        $dbDate = $trade["date"];
                        $date = strtotime($dbDate);
                        $price = number_format(($trade["price"]), 2, '.', '');
                        $quantity = number_format(($trade["quantity"]), 2, '.', '');
                        //$quantity = (int)$trade["quantity"];
                        //$quantity = ($quantity/1000);

                        echo("['" . date("m-d-Y", $date) . "', " . $price .  ", " . $quantity . "],");
                    }//ex: ['2013',  1000, 400],
                    ?>
                ]);
                var options =
                {
                    title: '<?php echo($symbol); ?>',
                    hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                    vAxis: {title: 'Price', minValue: 0}
                };
                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                chart.draw(data, options);


            }
        </script>
    </head>

    <body>

    Last Trade: $
    <?php
    //var_dump(get_defined_vars());
    $lastTrade = $lastTrade[0]["price"];
    $lastTrade = number_format(($lastTrade), 2, '.', '');
    echo($lastTrade);
    ?>

    <div id="chart_div" style="width: 900px; height: 500px;">
    </body>
<?php


// render footer
    require("../templates/footer.php");

} //if not post
else {
    ?>

<form action="chart.php" method="post">
    <fieldset>
        <!-- removed autofocus             <input autofocus name="symbol" placeholder="Symbol" type="text" maxlength="31"/> -->

        <input list="symbol" name="symbol" maxlength="8" class="input-small" required><!--<input list="symbol" class="input-small" name="symbol" id="symbol" placeholder="Symbol" type="text" maxlength="5" required-->
        <datalist id="symbol"><!--select class="input-small" name="symbol" id="symbol" /-->

            <?php
            $stocks =	query("SELECT symbol FROM portfolio GROUP BY symbol ORDER BY symbol ASC");
            if (empty($stocks)) {
                echo("<option value=' '>No Symbols</option>");
            } else {
                foreach ($stocks as $stock) {
                    $symbol = $stock["symbol"];
                    echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                }
            }
            ?>
</datalist>

<button type="submit" class="btn btn-danger"  >CHART</button><!--national exchange-->



</fieldset>
</form>
<?php
}


?>
