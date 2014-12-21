<?php


require("../includes/config.php");

$symbol="A";

// Fetch the data
$trades = query("SELECT * FROM trades WHERE symbol=? ORDER BY date ASC", $symbol);

// HIGH CHARTS
echo('[');
//for each row
foreach ($trades as $trade) // for each of user's stocks
{ 	$date = strtotime($trade["date"]);
	$date = $date*1000; //javascript expects milliseconds
    echo('[');
        echo($date);
        echo(',');
        echo(number_format($trade["price"],2,".",""));
        //echo(',');
        //echo($trade["quantity"]);
    echo("]");
    echo(",");

}
echo("]");
//end of chart  


/*
// Print rows
$prefix = '';
echo "[\n";
//for each row
foreach ($trades as $trade) // for each of user's stocks
{ $date = strtotime($trade['date']);
  echo $prefix . " {\n";
  echo '  "date": "' . $date . '",' . "\n";
  echo '  "value": ' . number_format($trade['price'],2,".","") . ',' . "\n";
  echo '  "volume": ' . $trade['quantity'] . '' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";
//end of chart  
*/

?>
