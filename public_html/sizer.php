<?php
echo('<font color="red">');

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if (isset($_POST["event"])){$event=$_POST["event"];}
    $currentstackpriceperozt=$_POST["currentstackvalue"];
    $newpurchaseozt=$_POST["newpurchaseozt"];
    $newpurchasepriceozt=$_POST["newpurchasepriceozt"];
    $movement=$_POST["movement"];

    /*
    $a=$currentstackpriceperozt;
    $b=$newpurchaseozt;
    $c=$newpurchasepriceozt;
    $d=$movement;
    $d=(((($e*$b)*$a)+($b*$c))/($e*$b))-$a
    //$e='current stack size';
    */
    
    
//CHECK TO MAKE SURE THE MOVEMENT IS CURRENT VALUE
//IF NEGATIVE MOVEMENT, NEW PURCHASE PRICE MUST BE LOWER
if($movement<0 && $newpurchasepriceozt>$currentstackpriceperozt):
{
    echo("Invalid numbers.<br>
        'Movement' (D) must be positive if the value of the 'New Purchaes Price' (C) is higher than 'Current Price of Stack' (A).");
}
elseif($movement>0 && $newpurchasepriceozt<$currentstackpriceperozt):
{
    echo("Invalid numbers.<br>
        'Movement' (D) must be negative (-) if the value of the 'New Purchaes Price' (C) is lower than 'Current Price of Stack' (A).");
}
elseif($currentstackpriceperozt>100):
{
    echo("Please check the 'Current Stack Price of Stack' (A) value is the price per ounce, not the total value.");
}
elseif($newpurchaseozt>100):
{
    echo("Please check the 'New Purchase Pirce' (C) value is the price per ounce, not the total value.");
}
elseif($movement>20):
{
    echo("Please check the 'Movement' (D) value is the price per ounce, not the total value.");
}
else:
{
    echo("
        Current Value: " . $currentstackpriceperozt . " | 
        Movement: " . $movement . " | 
        New Purchase: " . $newpurchaseozt . " ozt |
        New Purchase: $" . $newpurchasepriceozt
    );

    //Purchase Price Total
    $newpurchaseprice=$newpurchasepriceozt*$newpurchaseozt;
            
    $currentstacksize=0;
    $calcmovement=-100;
    
   
    
    //CREATE ARRAY FOR THE POSSIBLE CURRENT STACK SIZE
    $stackArray = array();
    

    //while ($movement != $calcmovement)
    while ($movement != $calcmovement) 
    {
        //Calculate the Value of the Current Stack
            $currentstackvalue=$currentstacksize*$currentstackpriceperozt;
            $currentstackvalue=round($currentstackvalue, 2);
        //Calculate the Size of the New Stack from Old Stack and New Purchase
            $newstacksize=$currentstacksize+$newpurchaseozt;
        //Calculate the New Value of the Stack
            $newstackvalue=($currentstackvalue+$newpurchaseprice);
            $newstackvalue=round($newstackvalue, 2);
            $newstackvalueozt=($currentstackvalue+$newpurchaseprice)/$newstacksize;
            $newstackvalueozt=round($newstackvalueozt, 2);
        //Calculate Movement
            $calcmovement=$newstackvalueozt-$currentstackpriceperozt;
            $calcmovement=round($calcmovement, 2);
        //If Movement equals New Movement, Stop While Loop
            
            //POSSIBLE VALUE, ADD TO ARRAY
            if($movement==$calcmovement){array_push($stackArray, $newstacksize);}
            
            //IF MOVEMENT IS NEGATIVE
            if($movement<0){if($movement<$calcmovement){break;}}
            //IF MOVEMENT IS POSITIVE
            if($movement>0){if($movement>$calcmovement){break;}}
            
            
            if($i==10000){$rangeStart=10000; $rangeEnd='higher'; break;}
        
        //Increase the Stack Size
            $currentstacksize++;
    }
    
    //print_r($stackArray);
    $count=count($stackArray);
    $end=$count-1;
    
    $rangeStart=$stackArray[0];
    $rangeEnd=$stackArray[$end];
    
    echo("<br><br><b>Estimated Stack Size: " . $rangeStart . "-" . $rangeEnd . " troy ounces.</b><br><br>");
    
} //else
endif;
} //if post

echo('</font>');

?>
 <form method="post" action="sizer.php">
                            
  
  <br>
  <h1>Reverse Compute Size of Current Stack</h1>
  <br>
  <b>A.) Current Price of Stack ($/per ounce):</b>
  <br>$<input type="number" name="currentstackvalue" min="0.01" step="0.01" max="100">/ozt 
  <br>(ex: 20.00)
  <br>
  Price per troy ounce of the stack. If you have 100 ozt and you spent $2,000, then your price per ounce is $20 ($2,000/100ozt).
  <hr>
  
  
  <b>B.) New Purchase Size (ounces):</b>
  <br><input type="number" name="newpurchaseozt" min="0.01" step="0.01" max="10000"> ozt 
  <br>(ex: 20)
  <br>
  The size of the purchase. If you are buying a roll of American Silver Eagles, then it would be 20.
  <hr>
  
  <b>C.) New Purchase Price ($/per ounce):</b>
  <br><input type="number" name="newpurchasepriceozt" min="0.01" step="0.01" max="10000">/ozt 
  <br>(ex: 22.00)
  <br>
  The price per ounce of the new purchase. If you are buying a roll of Eagles for $440, then it would be $22 ($440/20ozt).
  <hr>

  <b>D.) Movement ($/per ounce):</b>
  <br>$<input type="number" name="movement" min="-100" step="0.01" max="100"> 
  <br>(ex: 0.33)
  <br>
  *Ensure you use the negative (-) sign if it decreases the cost. No need to use the plus (+) sign for positive numbers.<br>
  This value is the amount of change for the price per ounce. If you had 100ozt at $20/ozt ($2,000 total) and you bought 20ozt for $22/ozt ($440 total), the new price per ounce would be $20.33 ($2,440/120ozt). The difference between the original $20 and the new is an increase (+) of $0.33.
  <br>
  If you only have a percent (ie. 4%), then take the value of 'New Purchase Size' (A) and multiply this by the percent given (ie. 4%) and you will get the value for this field.
  <hr>

  <button type="submit" >Submit</button>
 </form>
