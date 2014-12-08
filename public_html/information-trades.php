<?php
require("../includes/config.php");
// if form was submitted
$title = "Trades";
$id = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['symbol'])){ $symbol=$_POST['symbol'];} 
    else{apologize("Unknown symbol!"); exit();}
    
    $trades =	query("SELECT * FROM trades WHERE (symbol = ?) ORDER BY date ASC", $symbol);
    $tradestotal =	query("SELECT SUM(price) AS totalprice, SUM(total) AS totaltotal, SUM(quantity) AS totalquantity, SUM(commission) AS totalcommission, COUNT(uid) AS totaltrades FROM trades WHERE (symbol = ?) ORDER BY date ASC", $symbol);
    
    //render("information-trades_form.php",["title" => $title,"trades" => $trades,"tradestotal" => $tradestotal]);
}
else{
 apologize("No symbol selected!");
}
?>




<?php
echo("<h3 style='text-align:center;'>" . htmlspecialchars(strtoupper($symbol)) . "<br>Trades<br>" . date('l jS \of F Y h:i:s A') . "</h3>");
?>

<style>
    table
    {
        border: 1px solid black;
    }
    td
    {
        border: 1px solid black;
    }
    .bold td
     {
         font-weight: bold;
     }

    
</style>

<table align="center">

<tr>
    <td>Order #</td>
    <td>Date/Time (Y/M/D)</td>
    <td>Price</td>
    <td>Quantity</td>
    <td>Commission</td>
    <td>Total</td>
    <td>Type</td>
    <td>Buyer</td>
    <td>Seller</td>
    <td>Ask UID</td>
    <td>Bid UID</td>
</tr>

<tr class="bold">
    <?php echo("<td>" . (number_format($tradestotal[0]["totaltrades"],0,".",",")) . "</td>"); ?>
    <td></td>
    <?php echo("<td>" . (number_format(getPrice($tradestotal[0]["totalprice"],0,".",","))) . "</td>"); ?>
    <?php echo("<td>" . (number_format($tradestotal[0]["totalquantity"],0,".",",")) . "</td>"); ?>
    <?php echo("<td>" . (number_format(getPrice($tradestotal[0]["totalcommission"],0,".",","))) . "</td>"); ?>
    <?php echo("<td>" . (number_format(getPrice($tradestotal[0]["totaltotal"],0,".",","))) . "</td>"); ?>
    <td colspan="5"></td>
</tr>


<?php
foreach ($trades as $row)
{ 
if($row['buyer']==$id || $row['seller']==$id){$color=' style="background-color:red"';}
else{$color='';}
?> 
<tr <?php echo($color); ?> >
    <?php

    echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
    echo("<td>" . (number_format(getPrice($row["price"]),2,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["quantity"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["commission"]),2,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["total"]),2,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
    echo("<td>" . (number_format(($row["buyer"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["seller"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["askorderuid"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["bidorderuid"]),0,".",",")) . "</td>");

    }
    ?>
</tr>









</table>
