<?php

require("../includes/config.php");
//$id = $_SESSION["id"];
//if ($id != 1) { apologize("Unauthorized!");}

//if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
//$assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC"); // query assets
$title = "Dashboard";

//TOTAL
$count = query("SELECT COUNT(id) AS total FROM users"); // query database for user
$dash["userstotal"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM assets"); // query database for user
$dash["assetstotal"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM orderbook"); // query database for user
$dash["orderstotal"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM trades"); // query database for user
$dash["tradestotal"] = $count[0]["total"];

//MONTH
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["usersmonth"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["assetsmonth"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["ordersmonth"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["tradesmonth"] = $count[0]["total"];


//WEEK
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["usersweek"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["assetsweek"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["ordersweek"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["tradesweek"] = $count[0]["total"];


//DAY
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["usersday"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["assetsday"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["ordersday"] = $count[0]["total"];

$count = query("SELECT COUNT(uid) AS total FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["tradesday"] = $count[0]["total"];


//MONEY SUPPLY
$public =	query("SELECT SUM(quantity) AS quantity FROM portfolio"); // query user's portfolio
if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
$StockSupply = $public[0]["quantity"];
$askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE side='a'"); // query user's portfolio
if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
$StockSupplyAsk = $askQuantity[0]["quantity"];
$StockTotal = $StockSupplyAsk+$StockSupply;
$moneySupply =	query("SELECT SUM(units) AS units FROM accounts"); // query user's portfolio
if(empty($moneySupply[0]["units"])){$moneySupply[0]["units"]=0;}
$MoneySupply = $moneySupply[0]["units"];
$bidTotal =	query("SELECT SUM(total) AS total FROM orderbook WHERE side='b'"); // query user's portfolio
if(empty($bidTotal[0]["total"])){$bidTotal[0]["total"]=0;}
$MoneySupplyBids = $bidTotal[0]["total"];
$moneySupplyTotal = $MoneySupply+$MoneySupplyBids;

//apologize(var_dump(get_defined_vars())); //dump all variables anywhere (displays in header)
require("../templates/header.php");
?>



<table border="3">

<tr>
  <td colspan="5">ACTIVITY</td>
</tr>
<tr>
  <th>Period</th><th>Users</th><th>Assets</th><th>Orders</th><th>Trades</th>
</tr>

<tr>
  <td>1 Days</td>
  <td><?php echo(number_format($dash["usersday"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["assetsday"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["ordersday"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["tradesday"], 0, '.', ',')); ?></td>
</tr> 

<tr>
  <td>7 Days</td>
  <td><?php echo(number_format($dash["usersweek"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["assetsweek"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["ordersweek"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["tradesweek"], 0, '.', ',')); ?></td>
</tr> 

<tr>
  <td>30 Days</td>
  <td><?php echo(number_format($dash["usersmonth"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["assetsmonth"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["ordersmonth"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["tradesmonth"], 0, '.', ',')); ?></td>
</tr> 

<tr>
  <td>Total</td>
  <td><?php echo(number_format($dash["userstotal"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["assetstotal"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["orderstotal"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["tradestotal"], 0, '.', ',')); ?></td>
</tr>  

<tr>
  <td colspan="5">STOCK SUPPLY</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td>IN PORTFOLIO</td>
  <td>OPEN ASKS</td>
  <td>TOTAL SUPPLY</td>
</tr>
<tr>
  <td colspan="2">STOCK SUPPLY</td>
  <td><?php echo(number_format($StockSupply, 0, '.', ',')); ?></td>
  <td><?php echo(number_format($StockSupplyAsk, 0, '.', ',')); ?></td>
  <td><?php echo(number_format($StockTotal, 0, '.', ',')); ?></td>
</tr>

<tr>
  <td colspan="5">MONEY SUPPLY</td>
</tr>
<tr>
  <td colspan="2"></td>
  <td>IN ACCOUNTS</td>
  <td>OPEN BIDS</td>
  <td>TOTAL SUPPLY</td>
</tr>
<tr>
  <td colspan="2">STOCK SUPPLY</td>
  <td><?php echo(number_format($MoneySupply, 2, '.', ',')); ?></td>
  <td><?php echo(number_format($MoneySupplyBids, 2, '.', ',')); ?></td>
  <td><?php echo(number_format($moneySupplyTotal, 2, '.', ',')); ?></td>
</tr>

  
  
  









</table>



<?php
require("../templates/footer.php");
?>
