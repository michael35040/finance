
<table class="table table-condensed  table-bordered" >
    <tr   class="success" ><td colspan="7"  style="font-size:20px; text-align: center;">HISTORY (<?php echo(strtoupper($tabletitle)); ?>) &nbsp;
            <?php
            //	Display link to all history as long as your not already there
            if (isset($title))
            {
                if ($title !== "All History")
                {
                    echo('
<form>
<span class="input-group-btn">
    <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="history.php" name="history" value="all">
        <span class="glyphicon glyphicon-plus-sign"></span> Show All
    </button>
</span>
</form>
	');
                }
                else
                {
                    echo('
<form>
<span class="input-group-btn">
    <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="history.php" name="history" value="limit">
        <span class="glyphicon glyphicon-minus-sign"></span> Last 10
    </button>
</span>
</form>
	');
                }
            }

            ?>


        </td></tr> <!--blank row breaker-->
    <tr   class="active" >

            <th>Transaction #</th>
            <th>Transaction</th>
            <th>Date/Time (Y/M/D)</th>
            <th>Symbol</th>
            <th>Quantity or Counterparty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>

    <?php
	    foreach ($history as $row)
        {   
            echo("<tr>");
            echo("<td>" . htmlspecialchars($row["uid"]) . "</td>");
            echo("<td>" . htmlspecialchars($row["transaction"]) . "</td>");			
            echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
            echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
            echo("<td>" . htmlspecialchars($row["quantity"]) . "</td>");
            echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["price"],2,".",",")) . "</td>");
            echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["total"],2,".",",")) . "</td>");
            echo("</tr>");
        }
    if($history==null){echo('<td colspan="7">None</td>');}
    ?>





    <tr   class="active" >
        <th>History #</th>
        <th>Type</th>
        <th>Date/Time (Y/M/D)</th>
        <th colspan="4">Description</th>
    </tr>

    <?php
    foreach ($error as $row)
    {
        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["uid"]) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["type"])) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        echo("<td colspan='4'>" . htmlspecialchars($row["description"]) . "</td>");
        echo("</tr>");
    }
    if($error==null){echo('<td colspan="7">None</td>');}

    ?>
</table>
