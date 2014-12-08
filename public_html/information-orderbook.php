<?php
require("../includes/config.php");
// if form was submitted
$title = "Oderbook";
$id = $_SESSION["id"];

$symbol='A';

$bids =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC", $symbol, 'b');
$asks =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC", $symbol, 'a');



echo("<h3>" . htmlspecialchars(strtoupper($symbol)) . " Orderbook " . date('l jS \of F Y h:i:s A') . "</h3>");

?>

<table class="table" align="center" border="3">
<tr>
    <td colspan="7" style="text-align:center;">BID</td>
    <td></td>
    <td colspan="7" style="text-align:center;">ASK</td>
</tr>
<tr class="active">
    <td>Side</td>
    <td>Order #</td>
    <td>Date/Time (Y/M/D)</td>
    <td>Type</td>
    <td>Total</td>
    <td>ID</td>
    <td>Quantity</td>

    <td><b>Price</b></td>

    <td>Quantity</td>
    <td>ID</td>
    <td>Total</td>
    <td>Type</td>
    <td>Date/Time (Y/M/D)</td>
    <td>Order #</td>
    <td>Side</td>

</tr>



<?php
foreach ($bids as $row)
{ ?> 
<tr <?php if($row['id']==$id){echo('bgcolor="#FF0000"');} ?> >
    <?php
    if($row["side"]=='b'){$side='BID';}
    if($row["side"]=='a'){$side='ASK ';}
    echo("<td>" . htmlspecialchars($side) . "</td>");
    echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
    echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
    echo("<td>" . (number_format(getPrice($row["total"]),2,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["id"]),0,".",",")) . "</td>");
    echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
    echo("<td>" . (number_format(getPrice($row["price"]),2,".",",")) . "</td>");
    }
    ?>
    <td colspan="7"></td>
</tr>




<?php
foreach ($asks as $row)
{ ?> 
<tr <?php if($row['id']==$id){echo('bgcolor="#FF0000"');} ?> >
    <td colspan="7"></td>
    <?php
    if($row["side"]=='b'){$side='BID';}
    if($row["side"]=='a'){$side='ASK ';}
    echo("<td>" . (number_format(getPrice($row["price"]),2,".",",")) . "</td>");
    echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
    echo("<td>" . (number_format(($row["id"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["total"]),2,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
    echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
    echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars($side) . "</td>");
    }
    ?>
</tr>


</table>
