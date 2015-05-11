<?php
// configuration
require("../includes/config.php");
$id = $_SESSION["id"]; //get id from session

//CONTEST #1 FOR WHEN WE HAVE MULTIPLE CONTESTS/EVENTS
$event = 1;


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
    

/*
    //SEE IF USER IS AUTHORIZED
    $countQ = query("SELECT COUNT(id) AS total, SUM(price) AS value FROM spot WHERE (id=?)", $id); // query database for user
    $numberguesses = $countQ[0]["total"];
    if($numberguesses>3){apologize("User has no available guesses!");}
    
    //CHECK TO MAKE SURE PRICE ISNT TAKEN
    $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (price=?)", $newguess); // query database for user
*/
  
      //INSERT TO DB
    if (query("INSERT INTO ledger (id, price,event) VALUES (?,?,?)", $id, $newguess, $event) === false) {apologize("Unable to insert guess!");}
  
  } //isset
} //if post



//PULL NY SPOT


//PULL DB QUERY OF CURRENT GUESSES
  /*
  //PULLS ALL GUESSES, AT THE MOMENT WE ARE JUST PULLING IT FOR EACH NUMBER
  $guesses =	query("SELECT id, price, name, date FROM spot WHERE event = ? ORDER BY price ASC", $event);
  if(!empty($guesses)) 
  {
    foreach ($guesses as $guess) { 
      echo("");
      if $guess["price"]==$price{$name==$guess["id"];$date==$guess["date"];
    }
  }
  */



//SHOW AVAIALBE GUESSES
  ?>
  
  
    <table class="table table-striped table-condensed table-bordered" >
    <tr class="danger">
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
          echo(number_format($spotprice),2,".",","); 
          //echo(htmlspecialchars($guessdata[0]["price"]));
        ?>
  </td>
  
<?php  
if(!empty($guessdata)){
?>

      <td>
        <?php echo(htmlspecialchars($guessdata["id"] )); ?>
      </td>
      
      <td>
        <?php echo(htmlspecialchars(date('F j, Y, g:ia', strtotime($guess["date"])) )); ?>
      </td>    
<?
}//!empty
else
{ //is empty
?>
<td colspan="2">
  <form method="post" action="guess.php">
    <button type="submit" class="btn btn-danger btn-xs" name="newguess" value="<?php echo($spotprice) ?>">
      GUESS<span class="glyphicon glyphicon-remove-circle"></span>
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
