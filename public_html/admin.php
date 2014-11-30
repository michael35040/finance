

<?php

require("../includes/config.php");
$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!"); exit();}
else
{




//if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
//$assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC"); // query assets
$title = "Dashboard";





//for delete or process
$assets = query("SELECT symbol FROM assets"); // query database for user
    if(isset($_POST['process'])) {


        if ($_POST["process"] == 'ALL') {
            try {
                $processOrderbook = processOrderbook();
            } catch (Exception $e) {
                echo('Error: ' . $e->getMessage() . '<br>');
            }         //catch exception
        } else {
            try {
                $processOrderbook = processOrderbook($_POST["process"]);
            } catch (Exception $e) {
                echo('Error: ' . $e->getMessage() . '<br>');
            }         //catch exception
        }

        echo($processOrderbook . " orders processed.");
    }




    if(isset($_POST['transaction']))
    {
        //get variables
        if ( empty($_POST['quantity']) ||  empty($_POST['userid'])) { apologize("Please fill all required fields."); } //check to see if empty
        // if symbol or quantity empty
        $userid = sanatize('quantity', $_POST['userid']);
        $quantity = sanatize('price', $_POST['quantity']);
        $transaction = $_POST['transaction'];
        $symbol = $unittype;

        if($transaction=="withdraw")
       {
            $totalq = query("SELECT units FROM accounts WHERE id = ?", $userid);
        	@$total = (float)$totalq[0]["units"]; //convert array to value
        	if ($quantity > $total)  //only allows user to deposit if they have less than
        	{ apologize("You only have " . number_format($total,2,".",",") . " to withdraw!"); }
        	$quantity = ($quantity*-1);
       }

        // transaction information
            query("SET AUTOCOMMIT=0");
            query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
        // update cash after transaction for user          
            if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $quantity, $userid) === false)
            {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Database Failure #P1.");} //update portfolio
        //update transaction history for user
        if (query("INSERT INTO history (id, transaction, symbol, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?)", $userid, $transaction, $symbol, $quantity, $quantity, $quantity) === false)
            {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Database Failure #P2.");} //update portfolio
            query("COMMIT;"); //If no errors, commit changes
            query("SET AUTOCOMMIT=1");
    }






    if(isset($_POST['reset'])) {
            $user = sanatize('quantity', $_POST['user']);
            $password = $_POST['reset'];
            $options = ['cost' => 12,];
            $password = password_hash($password, PASSWORD_BCRYPT, $options);
        query("UPDATE users SET password=?, fails=0 WHERE id=?", $password, $user);
    }










    if(isset($_POST['lock'])) {
            $user = sanatize('quantity', $_POST['lock']);
        query("UPDATE users SET active=0 WHERE id=?", $user);
    }







    if(isset($_POST['notice'])) {
            $user = sanatize('quantity', $_POST['user']);
            $notice = sanatize('address', $_POST['notice']);
            query("INSERT INTO notification (id, notice, status) VALUES (?, ?, ?)", $user, $notice, 1);
    }













    if(isset($_POST['delete'])) {
        if(!empty($_POST['delete'])) {
        removeAsset($_POST['delete']);}
    }








    if(isset($_POST['admin'])) {
        if ($_POST['admin'] == 'all') {clear_all();}
        if ($_POST['admin'] == 'test') {test();}
        if ($_POST['admin'] == 'orderbook') {clear_orderbook();}
        if ($_POST['admin'] == 'trades') {clear_trades();}
        if ($_POST['admin'] == 'populate') {populatetrades();}
        if ($_POST['admin'] == 'createstocks') {
            try {
                createStocks();
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
            }
        }
        if ($_POST['admin'] == 'randomorders') {
            try {
                $randomOrders = randomOrders();
            } catch (Exception $e) {
                echo('Error: ' . $e->getMessage() . '<br>');
            }         //catch exception
        }
    } //if admin post







    //TOP MONEY USERS
    $searchusersquery = query("SELECT * FROM users, accounts WHERE users.id=accounts.id ORDER BY units DESC LIMIT 0,10 ;");
    foreach ($searchusersquery as $row)		// for each of user
    {
        $info["id"] = $row["id"];
        $info["email"] = $row["email"];
        $info["password"] = $row["password"];
        $info["phone"] = $row["phone"];
        $info["last_login"] = $row["last_login"];
        $info["registered"] = $row["registered"];
        $info["fails"] = $row["fails"];
        $info["ip"] = $row["ip"];
        $accounts = query("SELECT units, loan, rate FROM accounts WHERE id = ?", $info["id"]);
        $info["units"] = $accounts[0]["units"];
        $info["loan"] = $accounts[0]["loan"];
        $info["rate"] = $accounts[0]["rate"];
        $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=? AND side='b')", $info["id"]);	  // query user's portfolio
        $info["locked"] = $bidLocked[0]["total"]; //shares trading
        $topusers[] = $info;
    }
















//TOTAL
$count = query("SELECT COUNT(id) AS total FROM users"); // query database for user
$dash["userstotal"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets"); // query database for user
$dash["assetstotal"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook"); // query database for user
$dash["orderstotal"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades"); // query database for user
$dash["tradestotal"] = $count[0]["total"];
$dash["valuetotal"] = $count[0]["value"];
$dash["volumetotal"] = $count[0]["volume"];
//MONTH
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["usersmonth"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["assetsmonth"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["ordersmonth"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["tradesmonth"] = $count[0]["total"];
    $dash["valuemonth"] = $count[0]["value"];
    $dash["volumemonth"] = $count[0]["volume"];
//WEEK
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["usersweek"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["assetsweek"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["ordersweek"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["tradesweek"] = $count[0]["total"];
    $dash["valueweek"] = $count[0]["value"];
    $dash["volumeweek"] = $count[0]["volume"];

//DAY
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["usersday"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["assetsday"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["ordersday"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["tradesday"] = $count[0]["total"];
    $dash["valueday"] = $count[0]["value"];
    $dash["volumeday"] = $count[0]["volume"];





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

    <style>
        #middle
        {
            background-color:transparent;
            border:0;
        }


    </style>

<table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
<tr>
  <td colspan="7" class="success"><strong>ACTIVITY</strong></td>
</tr>
<tr class="active">
  <td>PERIOD</td><td>USERS</td><td>ASSETS</td><td>ORDERS</td><td>TRADES</td><td>TRADE VOLUME</td><td>TRADE VALUE</td>
</tr>

<tr>
  <td>1 Days</td>
  <td><?php echo(number_format($dash["usersday"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["assetsday"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["ordersday"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["tradesday"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["volumeday"], 0, '.', ',')); ?></td>
  <td><?php echo($unitsymbol . number_format($dash["valueday"], 2, '.', ',')); ?></td>
</tr>
<tr>
  <td>7 Days</td>
  <td><?php echo(number_format($dash["usersweek"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["assetsweek"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["ordersweek"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["tradesweek"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeweek"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format($dash["valueweek"], 2, '.', ',')); ?></td>

</tr>
<tr>
  <td>30 Days</td>
  <td><?php echo(number_format($dash["usersmonth"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["assetsmonth"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["ordersmonth"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["tradesmonth"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumemonth"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format($dash["valuemonth"], 2, '.', ',')); ?></td>

</tr>
<tr>
  <td>Total</td>
  <td><?php echo(number_format($dash["userstotal"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["assetstotal"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["orderstotal"], 0, '.', ',')); ?></td>
  <td><?php echo(number_format($dash["tradestotal"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumetotal"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format($dash["valuetotal"], 2, '.', ',')); ?></td>

</tr>  
</table>

<table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
<tr>
  <td colspan="3" class="success"><strong>STOCK SUPPLY</strong></td>
</tr>
<tr class="active">
  <td>IN PORTFOLIO</td>
  <td>OPEN ASKS</td>
  <td>TOTAL SUPPLY</td>
</tr>
<tr>
  <td><?php echo(number_format($StockSupply, 0, '.', ',')); ?></td>
  <td><?php echo(number_format($StockSupplyAsk, 0, '.', ',')); ?></td>
  <td><?php echo(number_format($StockTotal, 0, '.', ',')); ?></td>
</tr>

<tr>
  <td colspan="3" class="success"><strong>MONEY SUPPLY</strong></td>
</tr>
<tr class="active">
  <td>IN ACCOUNTS</td>
  <td>OPEN BIDS</td>
  <td>TOTAL SUPPLY</td>
</tr>
<tr>
  <td><?php echo(number_format($MoneySupply, 2, '.', ',')); ?></td>
  <td><?php echo(number_format($MoneySupplyBids, 2, '.', ',')); ?></td>
  <td><?php echo(number_format($moneySupplyTotal, 2, '.', ',')); ?></td>
</tr>

</table>





    <!--font color='#FF0000'></font-->
    <table class="table table-condensed table-striped table-bordered" id="topusers" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
        <!-- HEADER ROW -->
        <thead>
        <tr>
            <td colspan="12" class="success"><strong>TOP USERS</strong></td>
        </tr>
        </thead>
        <tbody>
        <tr class="active">
            <td>ID</td>
            <td>EMAIL</td>
            <!--th>Password</th-->
            <td>PHONE</td>
            <td>LAST LOGIN</td>
            <td>REGISTERED</td>
            <td>FAILS</td>
            <td>IP</td>
            <td><?php echo($unittype) //set in finance.php ?></td>
            <td>LOCKED</td>
            <td>LOAN</td>
            <td>RATE</td>
            <td>PASSWORD</td>
        </tr>

        <?php
        foreach ($topusers as $row)
        {
            echo("<tr>");
            echo("<td>" . number_format($row["id"],0,".",",") . "</td>");
            echo("<td>" . htmlspecialchars($row["email"]) . "</td>");
            //  echo("<td>" . htmlspecialchars($row["password"]) . "</td>");
            echo("<td>" . htmlspecialchars($row["phone"]) . "</td>");
            echo("<td>" . (date('Y-m-d H:i:s', strtotime($row["last_login"])) . "</td>"));
            echo("<td>" . (date('Y-m-d H:i:s', strtotime($row["registered"])) . "</td>"));
            echo("<td>" . htmlspecialchars($row["fails"]) . "</td>");
            echo("<td>" . htmlspecialchars($row["ip"]) . "</td>");
            echo("<td>" . number_format($row["units"],2,".",",") . "</td>");
            echo("<td>" . number_format($row["locked"],2,".",",") . "</td>");
            echo("<td>" . number_format($row["loan"],2,".",",") . "</td>");
            echo("<td>" . number_format(($row["rate"]*100),2,".",",") . "%</td>");
            echo("<td>" . htmlspecialchars($row["password"]) . "</td>");
            echo("</tr>");
        }
        ?>
        </tbody>
    </table>








    <table class="table table-condensed table-striped table-bordered" id="notice" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <thead>
    <tr>
        <td class="success"><strong>NOTIFICATION</strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <form action="admin.php"  class="noticeForm" method="post">
                <input type="text" name="user" placeholder="User"  size="4">
                <input type="text" name="notice" placeholder="Notice"  size="70">
                <button type="submit" class="btn btn-info"><b> SUBMIT </b></button>
            </form>
        </td>
    </tr>
    </tbody>
    </table>












    <table class="table table-condensed table-striped table-bordered" id="password" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <thead>
    <tr>
        <td class="success"><strong>RESET PASSWORD</strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <form action="admin.php" method="post">
                <input type="text" name="user" placeholder="User"  size="4">
                <input type="text" name="reset" placeholder="Password"  size="35">
                <button type="submit" class="btn btn-danger"><b> RESET </b></button>
            </form>
        </td>
    </tr>
    </tbody>
    </table>




















    <table class="table table-condensed table-striped table-bordered" id="lock" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <thead>
    <tr>
        <td class="warning"><strong>LOCK</strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <form action="admin.php" method="post">
                <input type="text" name="lock" placeholder="User"  size="4">
                <button type="submit" class="btn btn-danger"><b> LOCK </b></button>
            </form>
        </td>
    </tr>
    </tbody>
    </table>













    <table class="table table-condensed table-striped table-bordered" id="process" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <thead>
    <tr>
        <td class="success"><strong>PROCESS ORDERBOOK</strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <form action="admin.php"  class="processForm" method="post">

            <select name="process"  class="form-control" >
                    <?php
                    if (empty($assets)) {
                        echo("<option value=''>No Assets</option>");
                    } else {
                        //echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                        echo ('    <option value="ALL">-All Assets-</option>');
                        foreach ($assets as $asset) {
                            $symbol = $asset["symbol"];
                            echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                        }
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-success"><b> PROCESS </b></button></span>
            </form></td>
    </tr>
    </tbody>
    </table>











    <table class="table table-condensed table-striped table-bordered" id="process" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <thead>
    <tr>
        <td class="danger"><strong>DELETE ASSET</strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <form action="admin.php"  class="deleteForm" method="post">

            <select name="delete"  class="form-control" >
                    <?php
                    if (empty($assets)) {
                        echo("<option value=''>No Assets</option>");
                    } else {
                        //echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                        echo("<option class='select-dash' disabled='disabled' selected value=''>SELECT</option>");
                        foreach ($assets as $asset) {
                            $symbol = $asset["symbol"];
                            echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                        }
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-danger"><b> DELETE </b></button></span>
            </form></td>
    </tr>
    </tbody>
    </table>








<table class="table table-condensed table-striped table-bordered" id="notice" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <thead>
    <tr>
        <td class="success" colspan="3"><strong>TRANSACTION</strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <script type="text/javascript">
                function FillUnits(f)
                { if(f.copyunits.checked == true) {f.quantity.value = <?php echo($units); ?>;}}
            </script>
            <form action="admin.php" method="post" class="formtable">
                <fieldset>
                    <input class="input-small" name="userid" placeholder="User ID" type="number" min="0" max="any" required /><br />
                    <input class="input-medium" type="number" name="quantity" placeholder="Amount/Quantity" step="0.01" min="0" max="any" required /><br>
                    <button type="submit"
                            class="btn btn-warning btn-xs"
                            name="transaction"
                            value="withdraw">WITHDRAW
                    </button>
                    <button type="submit"
                            class="btn btn-success btn-xs"
                            name="transaction"
                            value="deposit">DEPOSIT
                    </button>

                    <br /><input type="checkbox" name="copyunits" onclick="FillUnits(this.form)"> All <?php echo($unittype);?>
                </fieldset>
            </form>
        </td>
    </tr>
    </tbody>
    </table>






    <form action="admin.php"  class="symbolForm" method="post"   >
    <fieldset>
        <table class="table table-condensed table-striped table-bordered" id="admin" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
            <tr><th colspan=2>TESTING</th></tr>
            <tr><td><input type="radio" name="admin" value="all"></td>          <td>Clear All</td></tr>
            <tr><td><input type="radio" name="admin" value="test"></td>          <td>New Environment</td></tr>
            <tr><td><input type="radio" name="admin" value="orderbook"></td>    <td>Clear Orderbook</td></tr>
            <tr><td><input type="radio" name="admin" value="trades"></td>       <td>Clear Trades</td></tr>
            <tr><td><input type="radio" name="admin" value="createstocks"></td> <td>Create Stocks</td></tr>
            <tr><td><input type="radio" name="admin" value="randomorders"></td> <td>Random Orders</td></tr>
            <tr><td><input type="radio" name="admin" value="populate"></td>      <td>Populate</td></tr>
            <tr><td colspan='2'>
                    <button type="submit" class="btn btn-info"><b> SUBMIT </b></button></span>
                </td></tr>
        </table>

    </fieldset>
</form>



<?php
require("../templates/footer.php");

} //if adminid
?>
