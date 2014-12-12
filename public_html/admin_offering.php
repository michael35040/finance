<?php
require("../includes/config.php");  // configuration  

$id = $_SESSION["id"];

if ($id != 1) { apologize("Unauthorized!");}
if ($id == 1) { 

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if(empty($_POST["offering"])){apologize("Please select an listing option");}
    else{$offering = $_POST["offering"];}

    if(empty($_POST["symbol"])){apologize("Please fill out symbol");}
    else{$symbol = $_POST["symbol"];}

    if($offering=='delist')
    {
        try {$message = delist($symbol);}
        catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
    }
    
    
        if(empty($_POST["userid"])){apologize("Please fill out userid");}
        else{$userid = $_POST["userid"];} //owner or chief executive
        
        if(empty($_POST["issued"])){apologize("Please fill out issued");}
        else{$issued = $_POST["issued"];} //current amount of shares made public, issued for IPO
        
        if(empty($fee)){$fee=0;}
        else{$fee = $_POST["fee"];} //fee
        
       // apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
    
        //CHECK TO SEE IF SYMBOL EXISTS
        $userCheck = query("SELECT id FROM users WHERE id =?", $userid);//Checks to see if they already own stock to determine if we should insert or update tables
        $countUserRows = count($userCheck);
        if ($countUserRows != 1) {apologize("User does not exist!"); }
    
        if($offering=='followon')
    {
    
        try {$message = publicOffering2($symbol, $userid, $issued, $fee);}
        catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
    }
    elseif($offering=='reverse')
    {
        try {$message = removeQuantity($symbol, $userid, $issued);}
        catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
    }
    elseif($offering=='delist')
    {
        if(!empty($_POST['delete'])) 
        {
            $symbol = $_POST['delete'];
            try {$message = delist($symbol);}
            catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
        }
    }
    elseif($offering=='initial')
    {
        @$name = $_POST["name"];
        @$type = $_POST["type"]; //share or commodity
        @$url = $_POST["url"];
        @$rating = $_POST["rating"]; //1 - 10
        @$description = $_POST["description"];
    
        try {$message = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description);}
        catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
    }
    else{apologize("Unknown offering type.");}
    
    //redirect("assets.php", ["title" => "Success"]); // render success form
    redirect("assets.php", ["title" => $message]); // render success form
      
}
else
{
    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC"); // query user's portfolio
    render("admin_offering_form.php", ["title" => "Public Offering", "assets" => $assets]); // render buy form //***/to remove C/***/
}
//         apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
} //$id ==1
?>
