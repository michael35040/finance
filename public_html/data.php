<?php
// Connect to MySQL
$link = mysql_connect( 'localhost', 'root', '' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'bank', $link );
if ( !$db ) {
  die ( 'Error selecting database \'test\' : ' . mysql_error() );
}

// Fetch the data

$query = "
  SELECT *
  FROM orders
  ORDER BY date ASC"
  ;
  
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows

$prefix = '';
echo "[\n";
//for each row
while ( $row = mysql_fetch_assoc( $result ) ) 
{
  echo $prefix . " {\n";
  echo '  "date": "' . $row['date'] . '",' . "\n";
  echo '  "value": ' . number_format($row['price'],2,".",",") . ',' . "\n";
  echo '  "volume": ' . $row['size'] . '' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";
//end of chart  



/*
//for extra gap at end of chart since it was partially cutting it off
$epoch = strtotime($lastdate);
$epoch += (60*.5);
$dt = gmdate('Y-m-d H:i:s', $epoch); //('Y-m-d H:i:sP')
//$dt = date('Y-m-d H:i:s', $epoch);
echo $prefix . " {\n";
echo '  "date": "' . $dt . '",' . "\n";
echo '  "value": ' . 0 . ',' . "\n";
echo '  "volume": ' . 0 . '' . "\n";
echo " }";
$prefix = ",\n";
echo "\n]";
//end of extra gap fix
*/








//random data
/*
$prefix = '';
echo("[\n");
for ($i = 0; $i < 1000; $i++) 
{
	
	$time = new DateTime();
	$time = $time->getTimestamp();
	$time += ($i *1000 * 60 * 5);
	$date = gmdate('Y-m-d H:i:s', $time); //('Y-m-d H:i:sP')
	$a = (rand(50, 100));
//	$a = ((rand(0,1) * (40 + $i) ) + 100 + $i);
	$b = (rand(1, 25));
	echo $prefix . " {\n";
	echo '  "date": "' . $date . '",' . "\n";
	echo '  "value": ' . $a . ',' . "\n";
	echo '  "volume": ' . $b . '' . "\n";
	echo " }";
	$prefix = ",\n";
}
echo "\n]";
*/


// Close the connection
mysql_close($link);
?>
