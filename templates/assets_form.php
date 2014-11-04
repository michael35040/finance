
<style>
    .hiddenRow {
        padding: 0 !important;
    }

</style>
<table class="table table-condensed table-striped table-bordered" id="assets" style="border-collapse:collapse;">
    <thead>
    <tr><td colspan="8"><font color="black" size="+1">ASSETS</font></td></tr> <!--blank row breaker-->
    <tr>
        <th>Symbol/ Name</th>
        <th>Price/ Avg. Price</th>
        <th>Bid/ Date</th>
        <th>Ask/ Dividend</th>
        <th>Volume/ URL</th>
        <th>Issued/ URL</th>
        <th>Public/ Type</th>
        <th>Market Cap/ Rating</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;
    foreach ($assets as $asset)
    {
        $i++;
        echo('<tr data-toggle="collapse" data-target="#demo' . $i . '" class="accordion-toggle">');
            echo('<td>' . htmlspecialchars($asset["symbol"]) . '</td>');
            echo('<td class="info">' . $unitsymbol . number_format($asset["price"], 2, ".", ",") . '</td>');
            echo('<td class="warning">' . $unitsymbol . number_format($asset["bid"], 2, ".", ",") . '</td>');
            echo('<td class="warning">' . $unitsymbol . number_format($asset["ask"], 2, ".", ",") . '</td>');
            echo('<td class="active">' . number_format($asset["volume"], 0, ".", ",") . '</td>');
            echo('<td class="danger">' . number_format($asset["issued"], 0, ".", ",") . '</td>');
            echo('<td class="danger">' . number_format($asset["public"], 0, ".", ",") . '</td>');
            echo('<td class="success">' . $unitsymbol . number_format($asset["marketcap"], 2, ".", ",") . '</td>');
        echo('</tr>');
        echo('</div>');
        echo('<div  class="hiddenRow">');
        echo('<tr class="accordian-body collapse" id="demo' . $i . '">');
            echo('<td colspan="1">&nbsp;' . htmlspecialchars($asset["name"]) . '</td>');
            echo('<td colspan="1">&nbsp;' . $unitsymbol . number_format($asset["avgprice"], 2, ".", ",") . '</td>');
            echo('<td colspan="1">&nbsp;' . htmlspecialchars($asset["date"]) . '</td>');
            echo('<td colspan="1">&nbsp;' . number_format($asset["dividend"], 2, ".", ",") . '</td>');
            echo('<td colspan="2">&nbsp;' . htmlspecialchars($asset["url"]) . '</td>');
            //echo('<td colspan="1">&nbsp;' . htmlspecialchars($asset["url"]) . '</td>');
            echo('<td colspan="1">&nbsp;' . htmlspecialchars(ucfirst($asset["type"])) . '</td>');
            echo('<td colspan="1">&nbsp;' . htmlspecialchars($asset["rating"]) . ' Stars</td>');
        echo('</tr>');
        echo('</div>');
    }
    ?>
    </tbody>
</table>



<?php //echo(var_dump(get_defined_vars())); ?>