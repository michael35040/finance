
<style>
    .hiddenRow {
        padding: 0 !important;
    }

</style>


<table class="table table-condensed table-striped table-bordered table-hover" id="assets" style="border-collapse:collapse;">
    <thead>

    <tr class="success"><td colspan="4" style="font-size:20px; text-align: center;">ASSETS</td>

    <tr class="active"><!-- active warning danger info success -->
        <th width="25%">Symbol</th>
        <th width="25%">Price</th>
        <th width="25%">Volume</th>
        <th width="25%">Market Cap</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;
    if(!empty($assets))
    {
        foreach ($assets as $asset)
        {
            $i++;
            echo('<tr data-toggle="collapse" data-target="#demo' . $i . '" class="accordion-toggle" >');
            echo('<td><span class="glyphicon glyphicon-chevron-down"></span>&nbsp;&nbsp;&nbsp;&nbsp;' . htmlspecialchars($asset["symbol"]) . ' </td>');
            echo('<td >' . $unitsymbol . htmlspecialchars(number_format($asset["price"], 2, ".", ",")) . '</td>');
            echo('<td >' . htmlspecialchars(number_format($asset["volume"], 0, ".", ",")) . '</td>');
            echo('<td >' . $unitsymbol . htmlspecialchars(number_format($asset["marketcap"], 2, ".", ",")) . '</td>');
            echo('</tr>');
            echo('<div  class="hiddenRow">');
            echo('<tr class="accordian-body collapse" id="demo' . $i . '">');
            echo('<td colspan="1">' . htmlspecialchars($asset["name"]) . '
                <br>' . htmlspecialchars($asset["url"]) . '
                <br><form><button type="submit" class="btn btn-primary btn-xs" formmethod="post" formaction="information.php" name="symbol" value="' . $asset["symbol"] . '"><span class="glyphicon glyphicon glyphicon-info-sign"> Information</span></button></form></td>');
            echo('<td >' . $unitsymbol . htmlspecialchars(number_format($asset["bid"], 2, ".", ",")) . ' - Bid
                <br>' . $unitsymbol . htmlspecialchars(number_format($asset["ask"], 2, ".", ",")) . ' - Ask
                <br>' . $unitsymbol . htmlspecialchars($asset["avgprice"], 2, ".", ",") . ' - Avg. Price (30d)</td>');
            echo('<td >' . htmlspecialchars(number_format($asset["public"], 0, ".", ",")) . ' - Publicly Held
                <br>' . htmlspecialchars(number_format($asset["issued"], 0, ".", ",")) . ' - Issued (' . htmlspecialchars(number_format($asset["userid"], 0, ".", ",")) . ')
                <br>' . htmlspecialchars($asset["date"]) . ' - Listed</td>');
            echo('<td >Dividend: ' . htmlspecialchars(number_format($asset["dividend"], 2, ".", ",")) . '
                <br>Rating: ' . htmlspecialchars($asset["rating"]) . '
                <br>Type: ' . htmlspecialchars(ucfirst($asset["type"])) . '</td>');
            echo('</tr>');
        }
        echo("<tr><td colspan='3'><strong>Market Value</strong></td><td><strong>" . $unitsymbol . htmlspecialchars(number_format($indexMarketCap, 2, ".", ",")) . "</strong></td></tr>");
    }
    if($i==0)
    {
        echo("<tr><td colspan='4'><i>No assets</i></td></tr>");
    }
    ?>
    </tbody>
</table>



<?php //echo(var_dump(get_defined_vars())); ?>
