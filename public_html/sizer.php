<?php
error_reporting(-1);


if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if (isset($_POST["event"])){$event=$_POST["event"];}
    $currentstackvalueozt=$_POST["currentstackvalue"];
    $movement=$_POST["movement"];
    $movement=$movement*-1;
    $newpurchaseozt=$_POST["newpurchaseozt"];
    $newpurchasepriceozt=$_POST["newpurchasepriceozt"];


        echo("
        Current Value: " . $currentstackvalueozt . " | 
        Movement: " . $movement . " | 
        New Purchase: " . $newpurchaseozt . " ozt |
        New Purchase: $" . $newpurchasepriceozt
        );


//Purchase Price Total
$newpurchaseprice=$newpurchasepriceozt*$newpurchaseozt;
        
$i=0;
$currentstacksize=0;
$calcmovement=-100;


//$stackArray = array("orange", "banana");
$stackArray = array();
$a=0;

//while ($movement != $calcmovement)
while ($movement >= $calcmovement) 
{
    //Calculate the Value of the Current Stack
    $currentstackvalue=$currentstacksize*$currentstackvalueozt;
    $currentstackvalue=round($currentstackvalue, 2);

    //Calculate the Size of the New Stack from Old Stack and New Purchase
    $newstacksize=$currentstacksize+$newpurchaseozt;
    
    //Calculate the New Value of the Stack
    $newstackvalue=($currentstackvalue+$newpurchaseprice);
    $newstackvalue=round($newstackvalue, 2);
    
    $newstackvalueozt=($currentstackvalue+$newpurchaseprice)/$newstacksize;
    $newstackvalueozt=round($newstackvalueozt, 2);

    //Calculate Movement
    $calcmovement=$newstackvalueozt-$currentstackvalueozt;
    $calcmovement=round($calcmovement, 2);
    
    //If Movement equals New Movement, Stop While Loop
    if($movement==$calcmovement)
    {
               
               
               /*
                echo("      Stack Size: " . $newstacksize . " oz |
                    Stack Value: $" . $newstackvalue . " |
                    Stack Value: $" . $newstackvalueozt . "/oz |
                    Movement: $" . $calcmovement . 
                    "<br>"
                );
                */

array_push($stackArray, $newstacksize);
$a++;

    }
    
    if($movement<$calcmovement){break;}


    
    if($i==10000){break;}
    
    //Increase the Stack Size
    $currentstacksize++;
    $i++;    
}



//print_r($stackArray);
$count=count($stackArray);
$end=$count-1;

$rangeStart=$stackArray[0];
$rangeEnd=$stackArray[$end];

echo("<br><br><b>Estimated Stack Size: " . $rangeStart . "-" . $rangeEnd . " troy ounces.</b><br><br>");


} //if post
?>
 <form method="post" action="sizer.php">
                            
  
  Reverse Compute Size of Current Stack<br>
  Current Price of Stack:
  $<input type="number" name="currentstackvalue" min="0.01" step="0.01" max="100">/ozt (ex: 19.91)
  <br>
  
  New Purchase Size:
  <input type="number" name="newpurchaseozt" min="0.01" step="0.01" max="10000">/ozt (ex: 20)
  <br>
  
  New Purchase Price
  <input type="number" name="newpurchasepriceozt" min="0.01" step="0.01" max="10000">/ozt (ex: 18.00)
  <br>

  Movement if Purchase: 
  $-<input type="number" name="movement" min="0.01" step="0.01" max="100"> (ex: 0.05)
  <br>


  <button type="submit" >Submit</button>
 </form>
