
<table class="table table-condensed  table-bordered" >
    <tr   class="success" ><td colspan="8"  style="font-size:20px; text-align: center;"><?php echo(strtoupper($title)); ?> &nbsp;
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
        <span class="glyphicon glyphicon-calendar"></span> ALL
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
        <span class="glyphicon glyphicon-calendar"></span> LAST 10
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
    ?>
        <tr >
            <td colspan="6"><strong>Sum of Listed Transactions</strong></td>
            <td><?php
                    //calculate gains/losses
                    $acc = array_shift($history);
                    foreach ($history as $val) {
                        foreach ($val as $key => $val) {
                        $acc[$key] += $val;
                        }
                    }
                    $gainlosses = $acc['total'];
                    echo("<strong>" . $unitsymbol . htmlspecialchars(number_format($gainlosses,2,".",",")) . "</strong>");
                ?></td>
        </tr>

</table>

 <br />  <br />

