

<script>
    function commify(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }
    function fee_show_value(x)
    {
        x=x.toFixed(0);
        document.getElementById("fee_slider_value").innerHTML=x;
    }
    function issued_show_value(x)
    {
        x=commify(x);
        document.getElementById("issued_slider_value").innerHTML=x;
    }
    function rating_show_value(x)
    {
        document.getElementById("rating_slider_value").innerHTML=x;
    }
    function dividend_show_value(x)
    {
        x=x.toFixed(2);
        document.getElementById("dividend_slider_value").innerHTML=x;
    }
</script>
<form action="admin_offering.php"  method="post"
      oninput="
          feeAmount.value=commify(parseFloat(parseFloat(issued.value)*parseFloat(fee.value)).toFixed(0));
          "
      onclick="
            feeAmount.value=commify(parseFloat(parseFloat(issued.value)*parseFloat(fee.value)).toFixed(0));
          ">
    <table class="table table-condensed table-striped table-bordered" id="assets" style="border-collapse:collapse; width:100%;">
        
        
        <tr>
            <td>Offering</td>
            <td>
                <input type="radio" name="offering" value="initial" id="initial" required> Initial<br>
                <input type="radio" name="offering" value="followon" id="followon" required> Follow-on<br>
                <div id="infoText" style="color:red;"></div>

            </td>
        </tr>            
        
        <tr>
            <td style="width:20%">Symbol</td>
            <td style="width:80%">
            <input type="text" name="symbol"  list="symbol" required>
                <datalist id="symbol">
                    <?php
                        foreach ($assets as $asset) {
                            $symbol = $asset["symbol"];
                            echo("<option value='" . $symbol . "'> " . $symbol . "</option>");
                        }

                    ?>
                </datalist>



            </td>
        </tr>

        <tr>
            <td>Owner User ID #</td>
            <td><input type="number" min="1"  id="userid" name="userid"  max="100000000"  placeholder="ex: 134" required></td>
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

        <tr id="nameTR">
            <td>Company Name</td>
            <td><input type="text" name="name"  maxlength="60" id="name" placeholder="ex: Acme Inc." required></td>
        </tr>

        <tr id="typeTR">
            <td>Type</td>
            <td>
                <input type="radio"  id="type" name="type" value="stock" required> Stock<br>
                <input type="radio"  id="type1" name="type" value="commodity" required> Commodity<br>
            </td>
        </tr>            



        <tr id="urlTR">
            <td>Webpage URL</td>
            <td><input type="url" id="url" name="url" maxlength="60" placeholder="http://abcd.com" value="http://"></td>
        </tr>


        <tr id="descriptionTR">
            <td>Description</td>
            <td>
           <!-- <input type="text" id="description" name="description" maxlength="500" placeholder="ex: Makes special gadgets" > -->
            <textarea rows="4" cols="50" type="text" id="description" name="description" maxlength="500" placeholder="ex: Makes special gadgets"></textarea>
            </td>
        </tr>

        <tr>
        
        
        <tr id="rating_sliderTR">
            <td>Rating (1-10)</td>
            <td>
                <input id="rating_slider""  type="range"  name="rating" min="1" value="1" max="10" step="1" style="width:100%"
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

<script>


document.getElementById("followon").addEventListener("click", function () {

    document.getElementById("name").disabled = true;
    document.getElementById('name').value='';
    document.getElementById("nameTR").style.opacity = 0; //1 visible //0 invisible

    document.getElementById("type").disabled = true;
    document.getElementById('type').value='';
    document.getElementById("type1").disabled = true;
    document.getElementById('type1').value='';
    document.getElementById("typeTR").style.opacity = 0; //1 visible //0 invisible

    document.getElementById("url").disabled = true;
    document.getElementById('url').value='';
    document.getElementById("urlTR").style.opacity = 0; //1 visible //0 invisible

    document.getElementById("description").disabled = true;
    document.getElementById('description').value='';
    document.getElementById("descriptionTR").style.opacity = 0; //1 visible //0 invisible

    document.getElementById("rating_slider").disabled = true;
    document.getElementById('rating_slider').value='';
    document.getElementById("rating_sliderTR").style.opacity = 0; //1 visible //0 invisible

    document.getElementById('infoText').innerHTML = 'Only requires <b>"symbol"</b>, <b>"issued"</b> and <b>"fee"</b>';

}, false);

document.getElementById("initial").addEventListener("click", function () {

    document.getElementById("name").disabled = false;
    document.getElementById('name').value='';
    document.getElementById("nameTR").style.opacity = 1; //1 visible //0 invisible

    document.getElementById("type").disabled = false;
    document.getElementById('type').value='';
    document.getElementById("type1").disabled = false;
    document.getElementById('type1').value='';
    document.getElementById("typeTR").style.opacity = 1; //1 visible //0 invisible
    document.getElementById("type").checked = false;
    document.getElementById("type1").checked = false;

    document.getElementById("url").disabled = false;
    document.getElementById('url').value='';
    document.getElementById("urlTR").style.opacity = 1; //1 visible //0 invisible

    document.getElementById("description").disabled = false;
    document.getElementById('description').value='';
    document.getElementById("descriptionTR").style.opacity = 1; //1 visible //0 invisible

    document.getElementById("rating_slider").disabled = false;
    document.getElementById('rating_slider').value='1';
    document.getElementById("rating_sliderTR").style.opacity = 1; //1 visible //0 invisible

    document.getElementById('infoText').innerHTML = '';

}, false);


    </script>
