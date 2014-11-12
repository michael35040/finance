<?php
require("../includes/config.php");  // configuration  

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    @$symbol = $_POST["symbol"];
    @$name = $_POST["name"];
    @$userid = $_POST["userid"]; //owner or chief executive
    @$owner = $_POST["owner"]; //owner or chief executive
    @$fee = $_POST["fee"]; //fee?
    @$issued = $_POST["issued"]; //current amount of shares made public, issued for IPO
    @$url = $_POST["url"];
    @$type = $_POST["type"]; //share or commodity
    @$rating = $_POST["rating"]; //1 - 10
    @$description = $_POST["description"];

    //CHECK TO SEE IF PUBLIC>ISSUED

    //SQL UPDATE

    //issued=issued+issued
    //if isset fee=(fee*issued)+(fee*issued)


//try {publicOffering($symbol, $name, $userid, $issued, $type, $owner, $fee, $url, $rating, $description);}
//catch(Exception $e) {echo 'Message: ' .$e->getMessage();}


redirect("assets.php", ["title" => "Success"]); // render success form
  
} //post
else //!post
{ ?>
    <form action="admin_po.php"  method="post"
      oninput="
          feeAmount.value=commify(parseFloat(parseFloat(issued.value)*parseFloat(fee.value)).toFixed(0));
          "
      onclick="
            feeAmount.value=commify(parseFloat(parseFloat(issued.value)*parseFloat(fee.value)).toFixed(0));
          "
          >
    <table class="table table-condensed table-striped table-bordered" id="assets" style="border-collapse:collapse; width:100%;">

        <tr>
            <td style="width:20%">Symbol</td>
            <td style="width:80%"><input type="text" name="symbol" maxlength="8" placeholder="ex: ABCD" required></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name"  maxlength="60"  placeholder="ex: Acme Inc." required></td>
        </tr>
        <tr>
            <td>Owner User ID #</td>
<td><input type="number" name="userid"  min="1" max="100000000"  placeholder="ex: 134" required></td>
        </tr>

        <tr>
            <td>Type</td>
            <td>
                <input type="radio" name="type" value="stock" required> Stock<br>
                <input type="radio" name="type" value="commodity" required> Commodity<br>
            </td>
        </tr>


        <tr>
            <td>Issued</td>
            <td>
                <input id="issued" type="range" name="issued" min="10000" value="10000" max="1000000"  step="1000" style="width:100%"
                       onclick="issued_show_value(this.value);"
                       oninput="issued_show_value(this.value);"
                       onchange="issued_show_value(this.value);"
                       required>
                <br><span id="issued_slider_value" style="color:black;">10,000</span>
            </td>
        </tr>


        <tr>
            <td>Fee %</td>
            <td>
                <input id="fee" type="range" name="fee" min="0" value="0" max=".5"  step=".01" style="width:100%"
                       onclick="fee_show_value(this.value*100);"
                       oninput="fee_show_value(this.value*100);"
                       onchange="fee_show_value(this.value*100);"
                           >
                <br><output name="feeAmount" for="fee">0</output>
(<span id="fee_slider_value" style="color:black;">0</span>%)
            </td>
        </tr>

        <tr>
            <td>Owner Email</td>
            <td><input type="email" name="owner" maxlength="60" placeholder="ex: owner@abcd.com"></td>
        </tr>

        <tr>
            <td>Webpage URL</td>
            <td><input type="url" name="url" maxlength="60" placeholder="ex: abcd.com" ></td>
        </tr>


        <tr>
            <td>Description</td>
            <td><input type="text" name="description" maxlength="60" placeholder="ex: Makes special gadgets" ></td>
        </tr>

        <tr>


        <tr>
            <td>Rating (1-10)</td>
            <td>
                <input id="rating_slider" type="range"  name="rating" min="1" value="1" max="10" step="1" style="width:100%"
                       onchange="rating_show_value(this.value);"
                           >
                <br><span id="rating_slider_value" style="color:black;">1</span>
            </td>
        </tr>

            <td colspan="2">    <br>
                <button type="submit" class="btn btn-info">
                    <b> ISSUE </b>
                </button></td>
        </tr>
    </table>


</form>
<?php
} //!post
//         apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
?>
