<?php
require("../includes/config.php");
// if form was submitted
$title = "Oderbook";
$id = $_SESSION["id"];

$symbol='A';

$bids =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 5", $symbol, 'b');
$asks =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 5", $symbol, 'a');


?>

<table class="table" align="center">
<tr class="active">
  <td>Order #</td>
  <td>Date/Time (Y/M/D)</td>
  <td>Symbol</td>
  <td>Side</td>
  <th>Type</th>
  <th>Price</th>
  <td>Quantity</td>
  <th>Total</th>
  <td>ID</td>
</tr>
<?php
foreach ($bids as $row)
{ ?>
<tr <?php if($row['id']==$id){echo('class="danger"');} ?> >
<?php
    echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
    echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
    if($row["side"]=='b'){$side='BID';}
    if($row["side"]=='a'){$side='ASK ';}
      echo("<td>" . htmlspecialchars($side) . "</td>");
    echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
    echo("<td>" . (number_format(getPrice($row["price"]),2,".",",")) . "</td>");
    echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
    echo("<td>" . (number_format(getPrice($row["total"]),2,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["id"]),2,".",",")) . "</td>");
}
?>
</tr>
</table>
