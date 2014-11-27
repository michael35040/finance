<?php
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE id=?", $id); // query database for user
$orders = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM trades WHERE (buyer=? OR seller=?)", $id, $id); // query database for user
$trades = $count[0]["total"];
$count = query("SELECT COUNT(symbol) AS total FROM portfolio WHERE id=?", $id); // query database for user
$assets = $count[0]["total"];

?>



<style>
    #middle
    {
        background-color:transparent;
        border:0;
    }
    .container table {
        display:inline-block;
        text-align:center;
        border-collapse:collapse;
        /*border:3px solid black;*/
    }
    .container td {
        /*border:1px solid black;*/
        padding:5px;
        color:black;
        text-shadow: 0px 0px 5px #fff;
        background-color:transparent;

    }
</style>

<div class="container">

    <!--    <table class="table table-striped table-condensed table-bordered" >-->
<table>
    <tr>
        <td><strong>Name: </strong><?php echo(htmlspecialchars($fname . " " . $lname)); ?></td>
        <td><strong>Email: </strong><?php echo(htmlspecialchars($email)); ?></td>
        <td><strong>ID: </strong><?php echo(number_format($id, 0, '.', '')); ?></td>
    </tr>
</table>

    <table>
        <tr>
            <td><strong>Orders: </strong><?php echo(number_format($orders, 0, '.', '')); ?></td>
            <td><strong>Trades: </strong><?php echo(number_format($trades, 0, '.', '')); ?></td>
            <td><strong>Assets: </strong><?php echo(number_format($assets, 0, '.', '')); ?></td>
        </tr>
    </table>




    <?php if(!empty($notifications)) {?>
        <table>
        <tr  class="danger">
            <td colspan="3" style="font-size:20px; text-align: center;">NOTIFICATIONS</td>
        </tr>
        <?php foreach ($notifications as $notification) { ?>
            <tr>
                <td colspan="3"><form><button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="accounts.php" name="cancel" value="<?php echo($notification["uid"]) ?>"><span class="glyphicon glyphicon-remove-circle"></span></button></form>
                    <strong>Notification: </strong>
                    <?php echo(htmlspecialchars("[" . date('Y-m-d H:i:s', strtotime($notification["date"])) . "] " . $notification["notice"])); ?>
                </td>
            </tr>
        <?php
        } //if foreach
    ?></table><?php } //!empty ?>



    </div><!--container-->




<table class="table table-condensed  table-bordered" >

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
                <td colspan="4"><?php echo("Pending Bid Orders (Locked)"); ?></td>
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
                <td colspan="7"><strong>TOTAL</strong></td>
                <td>
                    <strong>
                        <?php
                        $accountsTotal = ($units+$loan+$bidLocked);
                        echo(number_format($accountsTotal, 2, ".", ","))
                        ?>
                    </strong>
                </td>
            </tr>
    <!-- HEADER ROW -->
    
    </table>






