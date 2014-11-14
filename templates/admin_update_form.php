<?php
@$symbol=$assetinfo[0]["symbol"];
@$name = $assetinfo[0]["name"];
@$userid = $assetinfo[0]["userid"];
@$url = $assetinfo[0]["url"];
@$description = $assetinfo[0]["description"];
@$rating = $assetinfo[0]["rating"];
@$type = $assetinfo[0]["type"];
?>

<script>
    function rating_show_value(x)
    {
        document.getElementById("rating_slider_value").innerHTML=x;
    }
</script>
<form action="admin_update.php"  method="post">

    <h3>Update</h3>
<table class="table table-condensed table-striped table-bordered" id="assets" style="border-collapse:collapse; width:100%;">
    <tr>
        <td style="width:50%">Update</td>
        <td style="width:50%">
            <input type="radio" name="update"  value="yes" checked>
        </td>
    </tr>

    <tr>
        <td>Symbol</td>
        <td><select  name="symbol" required><option value="<?php echo($symbol); ?>" selected><?php echo($symbol); ?></option></select></td>
    </tr>
    <tr>
        <td>New Symbol (only if changing)</td>
        <td>
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
            <input type="radio" name="type" value="stock" <?php if($type=='stock'){echo("checked");} ?> > Stock<br>
            <input type="radio" name="type" value="commodity" <?php if($type=='commodity'){echo("checked");} ?> > Commodity<br>
        </td>
    </tr>

    <tr>
        <td>Webpage URL</td>
        <td><input type="url" name="url" maxlength="60" placeholder="ex: abcd.com"  value="<?php echo($url); ?>" ></td>
    </tr>


    <tr>
        <td>Description</td>
        <td>
      <!--  <input type="text" name="description" maxlength="500" placeholder="ex: Makes special gadgets"  value="<?php //echo($description); ?>"> -->
        <textarea rows="4" cols="50" name="description" maxlength="500" ><?php echo($description); ?></textarea>
        </td>
    </tr>

    <tr>


    <tr>
        <td>Rating (1-10)</td>
        <td>
            <input id="rating_slider" type="range"  name="rating" min="1" max="10" step="1"  value="<?php echo($rating); ?>" style="width:100%"
                   onchange="rating_show_value(this.value);"
                >
            <br><span id="rating_slider_value" style="color:black;"><?php echo($rating); ?></span>
        </td>
    </tr>

    <td colspan="2">    <br>
        <button type="submit" class="btn btn-info">
            <b> UPDATE </b>
        </button></td>
    </tr>
</table>


</form>
