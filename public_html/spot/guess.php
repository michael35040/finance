<?php
// configuration
require("../includes/config.php");
$id = $_SESSION["id"]; //get id from session

//CONTEST #1 FOR WHEN WE HAVE MULTIPLE CONTESTS/EVENTS
$event = 1;
$availableguesses=3;


//SEE IF USER NEEDS TO MAKE A GUESS
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
  if (isset($_POST["clear"]))
  {
    if (query("TRUNCATE TABLE `spot`") === false){echo("Clear Spot Database Failure");}
  }
  
  if (isset($_POST["newguess"])) 
  {
    //POST DATA TO LOCAL
    $newguess = $_POST["newguess"];
  
  
    //CHECK TO MAKE SURE GUESS IS VALID
      if (preg_match("/^([0-9.]+)$/", $newguess) == false) {apologize("You submitted an invalid price. Failure #1. $newguess");}
    ////CURRENCY CHECK
      //ACCEPTS NEGATIVE NUMBER. REMOVE "-?" AT THE BEGINNING TO STOP
      //ACCEPTS ONLY ONE DECIMAL "0.7". IF YOU WANT IT TO ALWAYS BE TWO REPLACE "{1,2}" WITH {2}
      if (preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $newguess) == false) {apologize("You submitted an invalid price. Failure #2. $newguess");}
    //POSITIVE CHECK
      if ($newguess < 0) {apologize("Price must be positive!");}
    
      if ($newguess >384400){apologize("Maximum value is 384,400.00. 384,400km is the distance to da moon!");}


    //SEE IF USER IS AUTHORIZED
    $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (id=?)", $id); // query database for user
    $numberguesses = $countQ[0]["total"];
    if($numberguesses>=$availableguesses){apologize("User has no available guesses!");}
    
    //CHECK TO MAKE SURE PRICE ISNT TAKEN
    $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (price=?)", $newguess); // query database for user

  
      //INSERT TO DB
    if (query("INSERT INTO spot (id,price,event) VALUES (?,?,?)", $id, $newguess, $event) === false) {apologize("Unable to insert guess!");}
  
  } //isset
} //if post




//PULL DB QUERY OF CURRENT GUESSES
  //PULLS ALL GUESSES, AT THE MOMENT WE ARE JUST PULLING IT FOR EACH NUMBER
  $guesses =	query("SELECT id, price, name, date FROM spot WHERE event = ? ORDER BY price ASC", $event);



//PULL NY SPOT
    // Include the library
    require('simple_html_dom.php');
    // Retrieve the DOM from a given URL
    $html = file_get_html('http://www.kitco.com/mobile/');
    // Extract all text from a given cell
    $silver["bid"] = $html->find('td[align="center"]', 9)->plaintext.'<br><hr>'; 
    $silver["ask"] = $html->find('td[align="center"]', 10)->plaintext.'<br><hr>';
    $silver["change"] = $html->find('td[align="center"]', 12)->plaintext.'<br><hr>'; 


  $spot=$silver["bid"];
  
/*
    $gold["bid"] = $html->find('td[align="center"]', 4)->plaintext.'<br><hr>'; 
    $gold["ask"] = $html->find('td[align="center"]', 5)->plaintext.'<br><hr>'; 
    $gold["change"] = $html->find('td[align="center"]', 7)->plaintext.'<br><hr>'; 
    $platinum["bid"] = $html->find('td[align="center"]', 14)->plaintext.'<br><hr>'; 
    $platinum["ask"] = $html->find('td[align="center"]', 15)->plaintext.'<br><hr>'; 
    $platinum["change"] = $html->find('td[align="center"]', 17)->plaintext.'<br><hr>';
    $palladium["bid"] = $html->find('td[align="center"]', 19)->plaintext.'<br><hr>'; 
    $palladium["ask"] = $html->find('td[align="center"]', 20)->plaintext.'<br><hr>';
    $palladium["change"] = $html->find('td[align="center"]', 22)->plaintext.'<br><hr>';
    $rhodium["bid"] = $html->find('td[align="center"]', 24)->plaintext.'<br><hr>'; 
    $rhodium["ask"] = $html->find('td[align="center"]', 25)->plaintext.'<br><hr>';  
    $rhodium["change"] = $html->find('td[align="center"]', 27)->plaintext.'<br><hr>';
*/


//SHOW AVAIALBE GUESSES
  ?>
<head>
  <title>SPOT GUESS</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/scripts.js"></script>
  <link href="css/bootstrap.css" rel="stylesheet"/>
  <link href="css/styles.php" rel="stylesheet" media="screen"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>
   table {
     border-collapse: collapse;
     padding:0;
 }
 table, td, th {
     border: 1px solid black;
     padding:0;
     
 }
</style>



Spot (Bid):<?php echo(number_format((float)$silver["bid"],2,".","")); ?><br>
Spot (Ask):<?php echo(number_format((float)$silver["ask"],2,".","")); ?><br>
Spot (Change):<?php echo(number_format((float)$silver["change"],2,".","")); ?><br>

Your Guesses: 
  <?php 
    $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (id=?)", $id); // query database for user
    $numberguesses = $countQ[0]["total"];
    echo($numberguesses); 
    
  ?>
  <br>
Guesses Left: <?php
    $guessesleft=$availableguesses-$numberguesses;
    echo($guessesleft); ?><br>
  
Total Guesses: <?php echo($count); ?><br>

  
<table>
    <tr>
      <td>PRICE</td>
      <td>USER</td>
      <td>DATE</td>
      <td>DISTANCE FROM SPOT</td>
      <td>BELOW NEXT BID</td>
      <td>ABOVE NEXT BID</td>
    </tr>    
<?php
  if(!empty($guesses)) 
  {

/*  
for ($i = 0; $i < count($guesses); $i++) {
     if (isset($guesses[$i + 1])) {
        $thisValue = $guesses[$i]['price'];
        $nextValue = $guesses[$i + 1]['price'];
        $percentageDiff = ($nextValue-$thisValue)/$thisValue;
    }
}
*/

$count=count($guesses);

  $i=0;
  foreach ($guesses as $guess) { 
      
      $distance =           ($guess["price"]-$spot);
      $distancepercentage = 100*(($guess["price"]-$spot)/$spot);

        if($i==0){$prevValue=0;}else{$prevValue = $guesses[$i - 1]['price'];}
        $thisValue = $guesses[$i]['price'];
        if($i>=($count-1)){$nextValue=384400;}else{$nextValue = $guesses[$i + 1]['price'];}
        $percentageDiff = ($nextValue-$thisValue)/$thisValue;

      echo('<tr>
          <td>' . $guess["price"] . '</td>
          <td>' . $guess["name"] . '/' . $guess["id"] . '</td>
          <td>' . $guess["date"] . '</td>
          <td>' . $distance . ' (' . number_format($distancepercentage,2,".",",") . '%)</td>
          <td>' . $prevValue . '</td>
          <td>' . $nextValue . '</td>



        </tr>');
    
    $i++;
    } //foreach


  } //if
?>

    
  </table>
  
  
  
  
  
  
  
    <table class="table table-striped table-condensed table-bordered" >
    <tr class="info">
      <td colspan="3" style="font-size:20px; text-align: center;">SPOT GUESS
      </td>
    </tr>
    <tr>
      <td>PRICE</td>
      <td>USER</td>
      <td>DATE</td>
    </tr>
  <?php
  $spotprice=10;
  while($spotprice<20)
  {
      
  ?>
    <tr>

<?php 
$guessdata =	query("SELECT id, price, name, date FROM spot WHERE (price=? AND event=?)", $spotprice, $event);
?>

  <td>
        <?php 
          echo(number_format($spotprice, 2, ".", ",")); 
          //echo(htmlspecialchars($guessdata[0]["price"]));
        ?>
  </td>
  
<?php  
if(!empty($guessdata)){
?>

      <td>
        <?php echo(htmlspecialchars($guessdata[0]["id"] )); ?>
      </td>
      
      <td>
        <?php echo(htmlspecialchars(date('F j, Y, g:ia', strtotime($guessdata[0]["date"])) )); ?>
      </td>    
<?
}//!empty
else
{ //is empty
?>
<td colspan="2">
  <form method="post" action="guess.php">
    <button type="submit" class="btn btn-success btn-xs" name="newguess" value="<?php echo($spotprice) ?>">
      <span class="glyphicon glyphicon-plus">GUESS</span>
    </button>
  </form>
</td>
      
  <?php
  } //is empty
  ?></tr><?php
  $spotprice=$spotprice+0.01;
  }//while
  ?>


</table>

<hr>


        <form method="post" action="guess.php">
          <button type="submit" class="btn btn-danger btn-xs" name="clear" value="yes">
            <span class="glyphicon glyphicon-remove-circle"></span>CLEAR TABLE
          </button>
        </form>
