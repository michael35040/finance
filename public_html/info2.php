
<?php
// configuration
require("../includes/config.php");


$id = $_SESSION["id"]; //get id from session


// apologize(var_dump(get_defined_vars()));

function ownership($symbol)
{
$ownership = query("
 SELECT 
 	SUM(orderbook.quantity) AS orderbook, 
    portfolio.quantity AS portfolio, 
    (COALESCE(SUM(orderbook.quantity),0)+COALESCE(portfolio.quantity,0)) AS total, 
    portfolio.id 
 FROM portfolio
 LEFT JOIN 
	orderbook ON portfolio.id = orderbook.id and 
    orderbook.symbol =? and 
    orderbook.side='a' 
WHERE portfolio.symbol =? 
GROUP BY portfolio.id 
	", $symbol, $symbol);

 return($ownership);
}

$ownership = ownership('A');
// apologize(var_dump(get_defined_vars()));
?>



<table>
<tr>
<th>ID</th>
<th>Orderbook</th>
<th>Portfolio</th>
<th>Total</th>
</tr>
<?php 

foreach ($ownership as $owner)
{ 
    echo("<tr>");
    echo("<td>" . $owner['id'] . "</td>");
    echo("<td>" . $owner['orderbook'] . "</td>");
    echo("<td>" . $owner['portfolio'] . "</td>");
    echo("<td>" . $owner['total'] . "</td>");
    echo("</tr>");
}
?>
</table>




<!--
need to create another table
if owned on a certain date, create a table of who can vote and how much their vote counts for
this is to prevent voters voting twice or complications when buying or selling during sell
-->

<div class="panel panel-primary"> <!--success VOTING -->
    <!-- Default panel contents -->
    <div class="panel-heading">VOTING</div>
    <table class="table">
        <thead>
        <tr class="active">
            <th>Ticket</th>
            <th>Vote</th>
            <th>Result (Y/N)</th>
            <th>Status</th>
            <th>Voted/Total</th>
            <th>Description</th>
            <th>Vote Date</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>#1</td>
            <td><button>YES</button> / <button>NO</button></td><!--if own--><!--if already voted-->
            <td>4,500 (45%)/ 5,500 (55%)</td>
            <td>Closed</td>
            <td>10,000/20,000</td>
            <td>Conduct secondary offering of 5 million.</td>
            <td>06 NOV 14</td>

        </tr>
        </tbody>
    </table>
</div><!--panel-primary VOTING-->












<div class="panel panel-primary"> <!--success VOTING -->
    <!-- Default panel contents -->
    <div class="panel-heading">DIVIDENDS</div>
    <table class="table">
        <thead>
        <tr class="active">
            <th>Date</th>
            <th>Total</th>
            <th># of Shares</th>
            <th>Dividend per Share</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>06 NOV 14</td>
            <td>$100,000.00</td>
            <td>10,000,000</td>
            <td>$0.10</td>
        </tr>
        <tr>
            <td>02 FEB 14</td>
            <td>$200,000.00</td>
            <td>10,000,000</td>
            <td>$0.20</td>
        </tr>
        </tbody>
    </table>
</div><!--panel-primary VOTING-->














<div class="panel panel-primary"> <!--success ANNOUNCEMENT -->
    <!-- Default panel contents -->
    <div class="panel-heading">ANNOUNCEMENT</div>
    <table class="table">
        <thead>
        <tr class="active">
            <th>Date</th>
            <th>Announcement</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>03 NOV 14</td>
            <td>Vote coming on 10 Nov 14 for second issue offering. (+)</td>
        </tr>
        </tbody>
    </table>
</div><!--panel-primary ANNOUNCEMENT-->









<div class="panel panel-primary"> <!--success OFFERING -->
    <!-- Default panel contents -->
    <div class="panel-heading">OFFERING</div>
    <table class="table">
        <thead>
        <tr class="active">
            <th>Date</th>
            <th>Type</th>
            <th>Number of Shares</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>03 NOV 14</td>
            <td>Initial (PO)</td>
            <td>10,000,000</td>
        </tr>
        </tbody>
    </table>
</div><!--panel-primary OFFERING-->




