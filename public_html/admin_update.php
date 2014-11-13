<?php

require("../includes/config.php");  // configuration  

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

if( isset($_POST['symbol']) )
{
    @$symbol = $_POST["symbol"];
    @$newSymbol = $_POST["newSymbol"];
    @$name = $_POST["name"];
    @$userid = $_POST["userid"]; //owner or chief executive
    @$owner = $_POST["owner"]; //email of owner or chief executive
    @$url = $_POST["url"];
    @$type = $_POST["type"]; //share or commodity
    @$rating = $_POST["rating"]; //1 - 10
    @$description = $_POST["description"];
 
    try {$message = updateSymbol($symbol, $newSymbol, $userid, $name, $type, $owner, $url, $rating, $description);}
    catch(Exception $e) {echo 'Message: ' .$e->getMessage();}

    redirect("assets.php", ["title" => $message]); // render success form

}
else
{
$assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC"); // query user's portfolio
//render("admin_update_form.php", ["title" => "Update Form", "assets" => $assets]); // render buy form //***/to remove C/***/
//         apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error

?>
<form action="admin_update.php" class="symbolForm" method="post" >
<fieldset>
<table>
<tr>
<td>
<div class="input-group" >
<select name="symbol" class="form-control" required>
<?php
if (empty($assets)) {
echo("<option value=' '>No Assets</option>");
} else {
echo (' <option class="select-dash" disabled="disabled">-All Assets-</option>');
foreach ($assets as $asset) {
$symbol = $asset["symbol"];
echo("<option value='" . $symbol . "'> " . $symbol . "</option>");
}
}
?>
</select>

<span class="input-group-btn">
<button type="submit" class="btn btn-info">
<b> SUBMIT </b>
</button>
</span>
</div><!-- /input-group -->
</td>
</tr>
</table>
</fieldset>
</form>
<br> <br>
<?php } //else !post ?>
