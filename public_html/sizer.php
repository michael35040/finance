<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if (isset($_POST["event"])){$event=$_POST["event"];}
    $currentstackvalue=$_POST["currentstackvalue"];
    $movement=$_POST["movement"];
    $newpurchaseozt=$_POST["newpurchaseozt"];
    $newpurchasepriceozt=$_POST["newpurchasepriceozt"];
}

//Purchase Price Total
$newpurchaseprice=$newpurchasepriceozt*$newpurchaseozt;
        
$currentstacksize=0;
while ($movement != $calcmovement)
{
    //Calculate the Value of the Current Stack
    $currentstackvalue=$currentstacksize*$currentstackprice;
    
    //Calculate the Size of the New Stack from Old Stack and New Purchase
    $newstacksize=$currentstacksize+$newpurchaseozt;
    
    //Calculate the New Value of the Stack
    $newstackvalue=($currentstackvalue+$newpurchaseprice)/$newstacksize;
    
    //Calculate Movement
    $calcmovement=$newstackvalue-$currentstackvalue;
    
    
    //If Movement equals New Movement, Stop While Loop
    if($movement==$calcmovement)
    {
        echo($currentstacksize);
        break;
    }
    
    //Increase the Stack Size
    $currentstacksize++;
        
}
?>
 <form method="post" action="sizer.php">
                            
  
  Current Stack Price per Troy Ounce:
  <input type="number" name="currentstackvalue" min="0.01" step="0.01" max="100">
  <br>
  
  Movement if New Purchase:
  <input type="number" name="movement" min="0.01" step="0.01" max="100">
  <br>
  
  New Purchase Troy Ounce:
  <input type="number" name="newpurchaseozt" min="0.01" step="0.01" max="10000">
  <br>
  
  New Purchase Price Per Ounce
  <input type="number" name="newpurchasepriceozt" min="0.01" step="0.01" max="10000">
  <br>

  <button type="submit" >Submit</button>
 </form>
