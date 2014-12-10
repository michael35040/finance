<!DOCTYPE html>




<html lang="en">



<head>



<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>

<script src="js/jquery.js"></script>

<script src="js/bootstrap.js"></script>

<script src="js/scripts.js"></script>

<link href="css/bootstrap.css" rel="stylesheet"/>

<link href="css/styles.php" rel="stylesheet" media="screen"/>

<meta name="viewport" content="width=device-width, initial-scale=1">



</head>








<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>

<div id="container" style="height: 400px; min-width: 310px"></div>










<script>
    $(document).ready(function() {

        var options = {
            chart: {
                renderTo: 'container',
                type: 'spline'
            },
            series: [{}]
        };

        $.getJSON('data.php', function(data) {
            options.series[0].data = data;
            var chart = new Highcharts.Chart(options);
        });

    });

    /*

    $(function () {

        //$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function (data) {
        $.getJSON('data.php', function (data) {
            // Create the chart
            $('#container').highcharts('StockChart', {


                rangeSelector : {
                    selected : 1
                },

                title : {
                    text : 'AAPL Stock Price'
                },

                series : [{
                    name : 'AAPL',
                    data : data,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });
        });

    });

*/

</script>



</html>