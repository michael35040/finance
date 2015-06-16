<?php
echo('<font color="red">');
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if (isset($_POST["event"])){$event=$_POST["event"];}
    $a=$_POST["a"];
    $b=$_POST["b"];
    $c=$_POST["c"];
    $d=$_POST["d"];
    $d=round($d, 5);
    //CHECKS
    if($d<0 && $c>$a){ echo("Invalid numbers.<br>'Movement' (D) must be positive if the value of the 'New Purchaes Price' (C) is higher than 'Current Price of Stack' (A).");}
    if($d>0 && $c<$a){ echo("Invalid numbers.<br>'Movement' (D) must be negative (-) if the value of the 'New Purchaes Price' (C) is lower than 'Current Price of Stack' (A).");}
    //SOLVE FOR X    
    $x=((-$a*$b)+($b*$c)-($b*$d))/$d;
    echo("Estimated size of stack: " . $x . "<hr>Current Value: " . $a . " | Movement: " . $d . " | New Purchase: " . $b . " ozt | New Purchase: $" . $c );
} //if post
echo('</font>');
?>
 <form method="post" action="sizer.php">
  <h1>Reverse Compute Size of Current Stack</h1>
  <b>A.) Current Price of Stack ($/per ounce):</b>
  <br>$<input type="number" name="a" min="0.01" step="0.01" max="100">/ozt 
  <br>(ex: 20.00)
  <br>
  Price per troy ounce of the stack. If you have 100 ozt and you spent $2,000, then your price per ounce is $20 ($2,000/100ozt).
  <hr>

  <b>B.) New Purchase Size (ounces):</b>
  <br><input type="number" name="b" min="0.01" step="0.01" max="10000"> ozt 
  <br>(ex: 20)
  <br>
  The size of the purchase. If you are buying a roll of American Silver Eagles, then it would be 20.
  <hr>
  
  <b>C.) New Purchase Price ($/per ounce):</b>
  <br><input type="number" name="c" min="0.01" step="0.01" max="10000">/ozt 
  <br>(ex: 22.00)
  <br>
  The price per ounce of the new purchase. If you are buying a roll of Eagles for $440, then it would be $22 ($440/20ozt).
  <hr>

  <b>D.) Movement ($/per ounce):</b>
  <br>$<input type="number" name="d" min="-100" step="0.00001" max="100"> 
  <br>(ex: 0.33)
  <br>
  *Ensure you use the negative (-) sign if it decreases the cost. No need to use the plus (+) sign for positive numbers.<br>
  This value is the amount of change for the price per ounce. If you had 100ozt at $20/ozt ($2,000 total) and you bought 20ozt for $22/ozt ($440 total), the new price per ounce would be $20.33 ($2,440/120ozt). The difference between the original $20 and the new is an increase (+) of $0.33.
  <br>
  If you only have a percent (ie. 4%), then take the value of 'New Purchase Size' (A) and multiply this by the percent given (ie. 4%) and you will get the value for this field.
  <hr>

  <button type="submit" >Submit</button>
 </form>
