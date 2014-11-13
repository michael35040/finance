<?php
if(!isset($_POST['symbol']) )
{ redirect('admin_update.php'); }

$symbol=$_POST["symbol"];
 $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
$countOwnersRows = count($symbolCheck);
if ($countOwnersRows != 1) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Symbol does not exsist."); }

$assetinfo = query("SELECT * FROM asset WHERE symbol=?", $symbol);

$name = $assetinfo[0]["name"];
$userid = $assetinfo[0]["userid"];
$owner = $assetinfo[0]["owner"];
$url = $assetinfo[0]["url"];
$description = $assetinfo[0]["description"];
$rating = $assetinfo[0]["rating"];

?>

<form action="admin_update.php"  method="post"

    <table class="table table-condensed table-striped table-bordered" id="assets" style="border-collapse:collapse; width:100%;">
        <tr>
            <td style="width:20%">Symbol</td>
            <td style="width:80%">
            <input type="text" name="symbol" maxlength="8" placeholder="ex: ABCD" value="<?php echo($symbol); ?>" disabled required></td>
        </tr>
        <tr>
            <td style="width:20%">New Symbol (only if changing)</td>
            <td style="width:80%">
            <input type="text" name="newSymbol" maxlength="8" placeholder="New Symbol" ></td>
        </tr>        
        <tr>
            <td>Name</td>
            <td><input type="text" name="name"  maxlength="60"  value="<?php echo($name); ?>"  placeholder="ex: Acme Inc." ></td>
        </tr>

        <tr>
            <td>Owner User ID #</td>
            <td><input type="number" name="userid"  min="1" max="100000000"  placeholder="ex: 134"  value="<?php echo($userid); ?>"  ></td>
        </tr>
        
        <tr>
            <td>Type</td>
            <td>
                <input type="radio" name="type" value="stock" > Stock<br>
                <input type="radio" name="type" value="commodity" > Commodity<br>
            </td>
        </tr>            

        <tr>
            <td>Owner Email</td>
            <td><input type="email" name="owner" maxlength="60" placeholder="ex: owner@abcd.com"  value="<?php echo($owner); ?>" ></td>
        </tr>
        
        <tr>
            <td>Webpage URL</td>
            <td><input type="url" name="url" maxlength="60" placeholder="ex: abcd.com"  value="<?php echo($url); ?>" ></td>
        </tr>


        <tr>
            <td>Description</td>
            <td><input type="text" name="description" maxlength="60" placeholder="ex: Makes special gadgets"  value="<?php echo($description); ?>"></td>
        </tr>

        <tr>
        
        
        <tr>
            <td>Rating (1-10)</td>
            <td>
                <input id="rating_slider" type="range"  name="rating" min="1" value="1" max="10" step="1"  value="<?php echo($rating); ?>" style="width:100%"
                       onchange="rating_show_value(this.value);"
                       >
                <br><span id="rating_slider_value" style="color:black;"> value="<?php echo($rating); ?>"</span>
            </td>
        </tr>        
        
            <td colspan="2">    <br>
                <button type="submit" class="btn btn-info">
                    <b> UPDATE </b>
                </button></td>
        </tr>
    </table>


</form>
