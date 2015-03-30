
        
            <span class="input-group-btn">
                <form action="admin_users.php" method="post"><button type="submit" class="btn btn-success btn-xs" name="activate" value="ALL"><span class="glyphicon glyphicon-plus-sign"></span> Activate All</button></form>
                <form action="admin_users.php" method="post"><button type="submit" class="btn btn-danger btn-xs" name="deactivate" value="ALL"><span class="glyphicon glyphicon-minus-sign"></span> Deactivate All</button></form>

            </span>
        


<!--font color='#FF0000'></font-->
<table class="table" align="center">

<!-- HEADER ROW -->
    <thead>
        <tr bgcolor="#CCCCCC">
            <th>ID</th>
            <th>Email</th>
			<!--th>Password</th--> 
            <th>Phone</th>
            <th>Last Login</th>
            <th>Registered</th>
			<th>Fails</th> 
            <th>IP</th>
            <th><?php echo($unittype) //set in finance.php ?> Available</th>
            <th>Locked</th>
            <th>Total</th>
            <th>Active</th>
            <th>Lock</th>

        </tr>
    </thead>


    <tbody>
<?php
$lockedunits=0;
$availableunits=0;

	    foreach ($searchusers as $row)
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
            echo("<td>" . number_format(($row["locked"]+$row["units"]),2,".",",") . "</td>");


            if($row["active"]==1)
            {
                echo("<td><span class='label label-success'>" . number_format($row["active"],0,".",",") . "</span></td>");
                echo('<td><form method="post" action="admin_users.php"><button type="submit" class="btn btn-danger btn-xs" name="deactivate" value="' . $row["id"] . '"><span class="glyphicon glyphicon-lock"></span></button></form></td>');
            }
            else
            {
                echo("<td><span class='label label-danger'>" . number_format($row["active"],0,".",",") . "</span></td>");
                echo('<td><form method="post" action="admin_users.php"><button type="submit" class="btn btn-success btn-xs" name="activate" value="' . $row["id"] . '"><span class="glyphicon glyphicon-lock"></span></button></form></td>');
            }

            echo("</tr>");
            
        $lockedunits=$lockedunits+$row["locked"];
	$availableunits=$availableunits+$row["units"];  
	
        }
    ?>
    </tbody>
</table>

ACCOUNTS<br>
Total Locked: <?php echo number_format(($lockedunits),2,".",","); ?><br>
Total Available:  <?php echo number_format(($availableunits),2,".",","); ?><br>
Total Units:  <?php echo number_format(($lockedunits + $availableunits),2,".",","); ?><br>
<BR><BR>
<?php

$ledgerlocked = query("SELECT SUM(`amount`) AS 'amount' FROM `ledger` WHERE (`symbol`='XBT' AND `category`='locked')"); 
$ledgeravailable = query("SELECT SUM(`amount`) AS 'amount' FROM `ledger` WHERE (`symbol`='XBT' AND `category`='available')"); 
$ledgerlock = getPrice($ledgerlocked[0]["amount"]);
$ledgerunit = getPrice($ledgeravailable[0]["amount"]);
$ledgertotal = $ledgerlock+$ledgerunit;
?>

LEDGER<br>
Total Locked: <?php echo number_format(($ledgerlock),2,".",","); ?><br>
Total Available:  <?php echo number_format(($ledgerunit),2,".",",");  ?><br>
Total Units:  <?php echo number_format(($ledgertotal),2,".",","); ?><br>

<?php //var_dump(get_defined_vars()); ?>








<table class="table table-condensed  table-bordered" >
    <tr>
        <td><b>User</b></td>
        <td><b>Amount (LEDGER)</b></td>
    </tr>
    <?php
    $accounts = query("SELECT `user`, SUM(`amount`) AS 'amount' FROM `ledger` WHERE (`symbol`='XBT' AND `category`='available') GROUP BY `user`"); //trade, order, deposit, withdraw, transfer

    $totalunits=0;
    foreach ($accounts as $row) {

        $row["amount"]=getPrice($row["amount"]);
        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["user"]) . "</td>");
        echo("<td>" . number_format(($row["amount"]),0,".",",") . "</td>");
        echo("<tr>");
        $totalunits=$totalunits+$row["amount"];

    }
    ?>
</table>
Total: <?php echo $totalunits; ?>











<table class="table table-condensed  table-bordered" >
    <tr>
        <td><b>Symbol</b></td>
        <td><b>Amount (Sum of Ledger All)</b></td>
    </tr>
    <?php
    $accounts = query("SELECT `symbol`, SUM(`amount`) AS 'amount' FROM `ledger` WHERE (`category`!='locked') GROUP BY `symbol`"); //trade, order, deposit, withdraw, transfer


    foreach ($accounts as $row) {

        if($row["symbol"]==$unittype){$row["amount"]=getPrice($row["amount"]);}
        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["symbol"]) . "</td>");
        echo("<td>" . number_format(($row["amount"]),0,".",",") . "</td>");
        echo("<tr>");

    }
    ?>
</table>






<table class="table table-condensed  table-bordered" >
    <tr>
        <td><b>Symbol</b></td>
        <td><b>Locked (Sum of Ledger All)</b></td>
    </tr>
    <?php
    $locked = query("SELECT `symbol`, SUM(`amount`) AS 'amount' FROM `ledger` WHERE (`category`='locked' AND `status`=1) GROUP BY `symbol`"); //trade, order, deposit, withdraw, transfer


    foreach ($locked as $row) {

        if($row["symbol"]==$unittype){$row["amount"]=getPrice($row["amount"]);}
        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["symbol"]) . "</td>");
        echo("<td>" . number_format(($row["amount"]),0,".",",") . "</td>");
        echo("<tr>");

    }
    ?>
</table>




