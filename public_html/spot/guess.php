<?php

//SEE IF USER IS AUTHORIZED

//SEE IF USER NEEDS TO MAKE A GUESS

//PULL NY SPOT


//PULL DB QUERY OF CURRENT GUESSES
$event = 1;
$guesses =	query("SELECT id, price, name, date FROM spot WHERE event = ? ORDER BY price ASC", $event);


//SHOW AVAIALBE GUESSES
if(!empty($guesses)) 
  {?>
    <table class="table table-striped table-condensed table-bordered" >
    <tr class="danger">
      <td colspan="3" style="font-size:20px; text-align: center;">SPOT GUESS
      </td>
    </tr>
    <tr>
      <td>GUESS</td>
      <td>PRICE</td>
      <td>USER</td>
      <td>DATE</td>
    </tr>
  <?php foreach ($guesses as $guess) 
  { ?>
    <tr>
      <td>
        <form method="post" action="guess.php">
          <button type="submit" class="btn btn-danger btn-xs" name="guess" value="<?php echo($spotprice) ?>">
            <span class="glyphicon glyphicon-remove-circle"></span>
          </button>
        </form>
      </td>

      <td>
        <?php echo(htmlspecialchars($guess["price"] )); ?>
      </td>
      <td>
        <?php echo(htmlspecialchars( $guess["id"] )); ?>
      </td>
      <td>
        <?php echo(htmlspecialchars(date('F j, Y, g:ia', strtotime($guess["date"])) )); ?>
      </td>    
      
      
    </tr>
  <?php
  } //if foreach
  ?>


</table>
<?php 
} //!empty 
else
{
  echo "empty!";
}




//SPIT OUT ALL NUMBERS WITH BOXES
//THOSE AVAILABLE CAN CLICK FOR GUESS
//THOSE TAKEN DISPLAY THOSE WHO GUESS



////////////////
//DB MODEL
//SPOT (unique)
//USERID (int)
//REDDIT NAME (varchar)
//TIMESTAMP (date)


?>
