
<style>
    .hiddenRow {
        padding: 0 !important;
    }

</style>
<table class="table table-condensed table-striped table-bordered" id="assets" style="border-collapse:collapse;">
    <thead>
    <tr class="success"><td colspan="4"><font color="black" size="+1">ASSETS</font></td></tr> <!--blank row breaker-->
    <tr class="active">
        <th width="40%">Symbol</th>
        <th width="20%">Price</th>
        <th width="20%">Volume</th>
        <th width="20%">Market Cap</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;
    foreach ($assets as $asset)
    {
        $i++;
        echo('<tr data-toggle="collapse" data-target="#demo' . $i . '" class="accordion-toggle">');
            echo('<td>' . htmlspecialchars($asset["symbol"]) . '</td>');
            echo('<td >' . $unitsymbol . number_format($asset["price"], 2, ".", ",") . '</td>');
            echo('<td >' . number_format($asset["volume"], 0, ".", ",") . '</td>');
            echo('<td >' . $unitsymbol . number_format($asset["marketcap"], 2, ".", ",") . '</td>');
        echo('</tr>');
        echo('<div  class="hiddenRow">');
        echo('<tr class="accordian-body collapse" id="demo' . $i . '">');
        echo('<td colspan="1">' . htmlspecialchars($asset["name"]) . '
            <br>' . htmlspecialchars($asset["url"]) . '
            <br>Type: ' . htmlspecialchars(ucfirst($asset["type"])) . '</td>');
        echo('<td >' . $unitsymbol . number_format($asset["bid"], 2, ".", ",") . ' - Bid
            <br>' . $unitsymbol . number_format($asset["ask"], 2, ".", ",") . ' - Ask
            <br>' . $unitsymbol . number_format($asset["avgprice"], 2, ".", ",") . ' - Avg. Price (30d)</td>');
        echo('<td >' . number_format($asset["public"], 0, ".", ",") . ' - Publicly Held
            <br>' . number_format($asset["issued"], 0, ".", ",") . ' - Issued
            <br>' . htmlspecialchars($asset["date"]) . ' - Listed</td>');
        echo('<td >Dividend: ' . number_format($asset["dividend"], 2, ".", ",") .
            '<br>Rating: ' . htmlspecialchars($asset["rating"]) . '</td>');
        echo('</tr>');
        echo('</div>');
    }
    if($i==0)
    {
    echo("<tr colspan='4'><td>No public assets</td></tr>");
    }
    ?>
    </tbody>
</table>



<?php //echo(var_dump(get_defined_vars())); ?>
