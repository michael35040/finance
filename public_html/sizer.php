<h1>Reverse Compute Size of Current Stack</h1>
<?php
echo('<font color="red">');
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is 

submitted
{
    if (isset($_POST["event"])){$event=$_POST["event"];}
    $a=$_POST["a"]; //Old Cost of Stack ($/ozt)
    $b=$_POST["b"]; //New Purchase 

Size (ozt)
    $c=$_POST["c"]; //New Purchase Price ($/ozt)
    $d=$_POST["d"]; //Movement ($/ozt)
    $d=round($d, 5);
    //CHECKS
    if($d<0 && $c>

$a):{echo("Invalid numbers!<br>'Movement' (D) must be positive if the value of the 'New Purchaes Price' (C) is higher than 'Current Price of Stack' 

(A).<hr>");}
    elseif($d>0 && $c<$a):{echo("Invalid numbers!<br>'Movement' (D) must be negative (-) if the value of the 'New Purchaes Price' (C) is 

lower than 'Current Price of Stack' (A).<hr>");}
    elseif($d==0):{echo("This algorithm requires the movement to be non-zero!<hr>");}
    else:
        

/* Old Stack Size:  x=(b(c-d-a))/d   
$x=($b*($c-$d-$a))/$d;
*/        
/* New Stack Size
d = movement
d = new avg price - old avg price
d = (a*old size + bc)/ x - (a*old size) / (old size)
old size = x - b
d = (a*(x-b) + bc)/ x - (a*(x-b)) / (x-b)
d = (ax - ab + bc)/x - a
d = (bc - ab)/x
x = (bc - ab)/d
$x =(($b*$c)-($a*$b))/$d;
//SIMPLIFY
x=b(c-a)/d
$x=($b*($c-$a))/$d;
*/

//NEW STACK
$x=($b*($c-$a))/$d;
//OLD STACK
$old_stack=$x-$b;
        
        $x=round($x, 2);
        echo("
        Old Stack: " . $old_stack . "<br>
        Old Cost: $" . $a . "/ozt 

(per ounce)<br> 
        Old Cost: $" . ($a*$old_stack) . " (total)<br> 
        New Purchase: " . $b . " ozt <br>
        New Purchase: $" . $c . "/ozt (per ounce)<br>
        

New Purchase: $" . ($b*$c) . " (total)<br> 
        Movement: $" . $d . " <br> 
        New Stack: " . ($x) . "<br>
        New Cost: $" . ($a+$d) . "/ozt (per 

ounce)<br> 
        <hr>
        "
        );
    endif;
} //if post
echo('</font>');
?>
 <form method="post" action="sizer.php">
  <b>A.) Old Cost of Stack ($/per 

ounce):</b>
  <br>$<input type="number" name="a" min="0.01" step="0.01" max="100">/ozt 
  <br>(ex: 19.79)
  <br>
  Price per troy ounce of the stack. 

If you have 196 ozt and you spent $3,878.84, then your price per ounce is $19.79 ($3,878.84/196ozt).
  <hr>

  <b>B.) New Purchase Size (ounces):</b>
  

<br><input type="number" name="b" min="0.01" step="0.01" max="10000"> ozt 
  <br>(ex: 20)
  <br>
  The size of the purchase. If you are buying a roll 

of American Silver Eagles, then it would be 20.
  <hr>
  
  <b>C.) New Purchase Price ($/per ounce):</b>
  <br><input type="number" name="c" 

min="0.01" step="0.01" max="10000">/ozt 
  <br>(ex: 19.25)
  <br>
  The price per ounce of the new purchase. If you are buying a roll of Eagles for $385, 

then it would be $19.25 ($385/20ozt).
  <hr>

  <b>D.) Movement ($/per ounce):</b>
  <br>$<input type="number" name="d" min="-100" step="0.00001" 

max="100"> 
  <br>(ex: -0.05)
  <br>
  *Ensure you use the negative (-) sign if it decreases the cost. No need to use the plus (+) sign for positive 

numbers.<br>
  Up to 5 decimal places.
  This value is the amount of change for the price per ounce. If you had 196ozt at $19.79/ozt ($3,878.84 total) 

and you bought 20ozt for $19.25/ozt ($385 total), the new price per ounce would be $19.74 ($4,263.84/216ozt)($3,878.84+$385/196+20 ozt). The 

difference between the original $19.79 and the new 19.74 is an decrease (-) of $0.05.
  <br>
  If you have the <b>'New Cost of Stack'</b>, simply 

subtract this from <b>'A'</b> and you have this figure.
  <br>
  If you only have a percent (ie. 4%), then take the value of 'New Purchase Size' (A) and 

multiply this by the percent given (ie. 4%) and you will get the value for this field.
  <hr>

  <button type="submit" >Submit</button>
 </form>
