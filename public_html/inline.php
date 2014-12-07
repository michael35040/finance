


<?php
require("../includes/config.php");

// render header
require("../templates/header.php");

?>

<div style="box-sizing: initial;">




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<head>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/sparkline.js"></script>
    <script type="text/javascript">
        $(function() {
            /** This code runs when everything has been loaded on the page */
            /* Inline sparklines take their values from the contents of the tag */
            $('.inlinesparkline').sparkline();

        });
    </script>
</head>
<body>
<p>
    <?php
    //SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE ( (type='LIMIT' or type='MARKET') AND symbol ='SILVER') GROUP BY DAY(date) ORDER BY uid ASC

    $allAssets =	query("SELECT * FROM assets ORDER BY symbol ASC");
    foreach ($allAssets as $asset)		// for each of user's stocks
    {
        $tradesG =  query("SELECT price, quantity FROM trades WHERE (symbol=? AND (type='limit' OR type='market')) ORDER BY uid DESC", $asset["symbol"]);
        //$tradesG = query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE ( (type='LIMIT' or type='MARKET') AND symbol =?) GROUP BY DAY(date) ORDER BY uid ASC ", $asset["symbol"]);      // query user's portfolio
        $trades=count($tradesG);
        echo('<span class="inlinesparkline">');
        $t=0;
        foreach($tradesG as $trade){
            echo(number_format(getPrice($trade["price"]), 2, ".", ""));
            $t++;
            if($t<$trades){echo(",");}
        }
        echo('</span>');
    }
    ?>
</p>
<p>
    Inline Sparkline: <span class="inlinesparkline">1,4,4,7,5,9,10</span>.
</p>



</body>
</html>

<?php

// render footer
require("../templates/footer.php");

?>


</div>