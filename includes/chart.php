<?php
require("/config.php");  
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        
<?php 
echo("['Date', 'Price', 'Quantity'],"); // ['Year', 'Sales', 'Expenses'],
$trades = query("SELECT * FROM trades ORDER BY date ASC";
foreach ($trades as $trade)	// for each of user's stocks
{ echo("['" . $trade["date"] . "', '" . $trade["price"] . "', '" . $trade["quantity"] . "'],"); }//ex: ['2013',  1000, 400],
?>
        ]);
        var options = {
          title: 'Stock Performance',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
