

<?php

require("../includes/config.php");
$id = $_SESSION["id"];
$title = "Storage";

if ($id != 1) { apologize("Unauthorized!"); exit();}
else
{


    if(isset($_POST['storage']))
    {
        //get variables
        if ( empty($_POST['quantity']) ||  empty($_POST['userid'])) { apologize("Please fill all required fields."); } //check to see if empty
        // if symbol or quantity empty
        $userid = sanatize('quantity', $_POST['userid']);
        $quantity = setPrice($_POST['quantity']);
        $transaction = strtoupper($_POST['transaction']);
        $symbol = $unittype;

        if($transaction=="WITHDRAW") {
            $totalq = query("SELECT units FROM accounts WHERE id = ?", $userid);
            @$total = (float)$totalq[0]["units"]; //convert array to value
            if ($quantity > $total)  //only allows user to deposit if they have less than
            {
                apologize("You only have " . number_format($total, 2, ".", ",") . " to withdraw!");
            }
            $quantity = ($quantity * -1);
        }


        // transaction information
        query("SET AUTOCOMMIT=0");
        query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
        // update cash after transaction for user          
        if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $quantity, $userid) === false)
        {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Database Failure #P1.");} //update portfolio
        //update transaction history for user
        if (query("INSERT INTO history (id, transaction, symbol, quantity, price, counterparty, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $userid, $transaction, $symbol, 0, 0, $adminid, $quantity) === false)
        {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Database Failure #P2.");} //update portfolio
        query("COMMIT;"); //If no errors, commit changes
        query("SET AUTOCOMMIT=1");
    }



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






    <?php

    $depository = query("SELECT depository, symbol, SUM(weight) AS weight FROM storage GROUP BY depository, symbol");
    $storage = query("SELECT * FROM storage WHERE 1"); // query database for user



    foreach ($depository as $row) {
        $symbol = $row["symbol"];
        $AskPrice = query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a' AND id=1)", $symbol);
        if (empty($AskPrice[0]["price"])) {$AskPrice[0]["price"] = 0;}
        $AskPrice[$symbol] = $AskPrice[0]["price"];
    }


    $total = query("SELECT symbol, SUM(weight) AS weight FROM storage GROUP BY symbol");
    foreach ($total as $row) {
        $symbol=$row['symbol'];
        if (empty($total[0]["weight"])) {$total[0]["weight"] = 0;}
        $totalweight[$symbol] = $total[0]["weight"];
    }
        ?>

<table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <tr>
        <td colspan="12" class="success"><strong>STORAGE</strong></td>
    </tr>
    <tr class="active">
        <td>Depository</td>
        <td>Symbol</td>
        <td>Weight (g)</td>
        <td>Weight (ozt)</td>
        <td>Value</td>
        <td>Portion (%)</td>

    </tr>
    <?php
    foreach ($depository as $row)
    {

        ?>
        <tr>
            <td><?php echo(htmlspecialchars($row["depository"])); ?></td>
            <td><?php echo(htmlspecialchars(strtoupper($row["symbol"]))); ?></td>
            <td><?php echo(number_format((31.1034768*$row["weight"]), 2, '.', ',')); ?></td>
            <td><?php echo(number_format($row["weight"], 4, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(getPrice($AskPrice[$symbol]*$row["weight"]), 2, '.', ',')); ?></td>
            <td><?php echo(number_format((100*($row["weight"]/$totalweight[$symbol])), 2, '.', ',')); ?>%</td>
        </tr>
<?php } ?>
</table>
















<?php
/*



    <table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
        <tr>
            <td colspan="13" class="success"><strong>ITEMS</strong></td>
        </tr>
        <tr class="active">
            <td>UID</td>
            <td>Depository</td>
            <td>Symbol</td>
            <td>Description</td>
            <td>ASW</td>
            <td>Purity</td>
            <td>Country</td>
            <td>Year</td>
            <td>Weight (g)</td>
            <td>Weight (ozt)</td>
            <td># of Items</td>
            <td>Value</td>
            <td>Portion</td>

        </tr>

        <?php
        foreach ($storage as $row)
        {
            ?>
            <tr>
                <td><?php echo(number_format($row["uid"], 0, '.', ',')); ?></td>
                <td><?php echo(htmlspecialchars($row["depository"])); ?></td>
                <td><?php echo(htmlspecialchars(strtoupper($row["symbol"]))); ?></td>
                <td><?php echo(htmlspecialchars($row["description"])); ?></td>
                <td><?php echo(number_format($row["asw"], 2, '.', ',')); ?></td>
                <td><?php echo(number_format($row["purity"], 2, '.', ',')); ?></td>
                <td><?php echo(htmlspecialchars($row["country"])); ?></td>
                <td><?php echo(number_format($row["year"], 0, '.', '')); ?></td>
                <td><?php echo(number_format((31.1034768*$row["weight"]), 2, '.', ',')); ?></td>
                <td><?php echo(number_format($row["weight"], 4, '.', ',')); ?></td>
                <td><?php echo(number_format(($row["quantity"]), 0, '.', ',')); ?></td>
                <td><?php echo($unitsymbol . number_format(getPrice($AskPrice[$symbol]*$row["weight"]), 2, '.', ',')); ?></td>
                <td><?php echo(number_format((100*($row["weight"]/$totalweight[$symbol])), 2, '.', ',')); ?>%</td>
            </tr>
        <?php } ?>
    </table>


*/ ?>





    <?php
    require("../templates/footer.php");

} //if adminid
?>
