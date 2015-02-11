
<table class="table table-condensed  table-bordered" >
    <tr   class="success" ><td colspan="14"  style="font-size:20px; text-align: center;">LEDGER (<?php echo(strtoupper($tabletitle)); ?>) &nbsp;
            <?php
            //	Display link to all history as long as your not already there
            if (isset($title))
            {
                if ($title !== "All")
                {
                    echo('

                        <span class="input-group-btn" style="display:inline;">
    <form method="post" action="ledger.php"><button type="submit" class="btn btn-success btn-xs" name="history" value="all">
        <span class="glyphicon glyphicon-plus-sign"></span> Show All
    </button></form>
</span>

	');
                }
                else
                {
                    echo('

                        <span class="input-group-btn" style="display:inline;">
    <form method="post" action="ledger.php"><button type="submit" class="btn btn-success btn-xs" name="history" value="limit">
        <span class="glyphicon glyphicon-minus-sign"></span> Last 10
    </button></form>
</span>

	');
                }
            }

            ?>

        </td></tr> 


    <tr   class="active" >

        <th>UID</th>
        <th>Date/Time (Y/M/D)</th>

        <th>User</th>
        <th>Symbol</th>
        <th>Amount</th>

        <th>X-User</th>
        <th>X-Symbol</th>
        <th>X-Amount</th>
        
        <th>Category</th>
        <th>Note</th>
        <th>Ask</th>
        <th>Bid</th>
        <th>Reference</th>
<!--        <th>X-Reference</th>-->
        <th>Status</th>
    </tr>

    <?php
    $ledger = query("SELECT * FROM ledger ORDER BY uid ASC");

    foreach ($ledger as $row)
    {

        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["uid"]) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");

        echo("<td><b>" . htmlspecialchars($row["user"]) . "</b></td>");
        echo("<td><b>" . htmlspecialchars(strtoupper($row["symbol"])) . "</b></td>");
        if($row["symbol"]==$unittype){echo("<td><b>" . $unitsymbol . (number_format(getPrice($row["amount"]),$decimalplaces,".",",")) . "</b></td>");}
        else{echo("<td><b>" . (number_format(($row["amount"]),0,".",",")) . "</b></td>");}

        echo("<td>" . htmlspecialchars($row["xuser"]) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["xsymbol"])) . "</td>");
        if($row["symbol"]==$unittype){echo("<td>" . $unitsymbol . (number_format(getPrice($row["xamount"]),$decimalplaces,".",",")) . "</td>");}
        else{echo("<td>" . (number_format(($row["xamount"]),0,".",",")) . "</td>");}

        echo("<td>" . htmlspecialchars($row["category"]) . "</td>");
        echo("<td>" . htmlspecialchars(ucfirst(($row["note"])) . "</td>");
        echo("<td>" . htmlspecialchars($row["askuid"]) . "</td>");
        echo("<td>" . htmlspecialchars($row["biduid"]) . "</td>");
        echo("<td>" . htmlspecialchars($row["reference"]) . "</td>");
//        echo("<td>" . htmlspecialchars($row["xreference"]) . "</td>");
        echo("<td>" . htmlspecialchars($row["status"]) . "</td>");
        echo("</tr>");
    }
    if($ledger==null){echo('<td colspan="13">None</td>');}
    ?>




</table>

