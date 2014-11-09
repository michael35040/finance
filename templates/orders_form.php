
<table class="table table-condensed  table-bordered">
    <tr class="success">
        <td colspan="9" style="font-size:20px; text-align: center;">Open Orders</td>
    </tr>
    <!--blank row breaker-->
    <tr class="active">

        <th>Cancel</th>
        <th>Order #</th>
        <th>Date/Time (Y/M/D)</th>
        <th>Symbol</th>
        <th>Side</th>
        <th>Type</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
    </tr>

    <?php
    foreach ($orders as $row) {
        echo("<tr>");
        echo('<td><form><button type="submit" class="btn btn-danger" formmethod="post" formaction="orders.php" name="uid" value="' . $row["uid"] . '"><span class="glyphicon glyphicon-remove-circle"></span></button></form></td>');
        echo("<td>" . htmlspecialchars($row["uid"]) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["side"])) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["type"])) . "</td>");
        echo("<td>" . htmlspecialchars(number_format($row["quantity"], 0, ".", ",")) . "</td>");
        echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["price"], 2, ".", ",")) . "</td>");
        echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["total"], 2, ".", ",")) . "</td>");
        echo("</tr>");
    }
    ?>

</table>