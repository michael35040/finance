<form action="admin_us.php"  method="post"

    <table class="table table-condensed table-striped table-bordered" id="assets" style="border-collapse:collapse; width:100%;">
        <tr>
            <td style="width:20%">Symbol</td>
            <td style="width:80%">
            <input type="text" name="symbol" maxlength="8" placeholder="ex: ABCD" required></td>
        </tr>
        <tr>
            <td style="width:20%">New Symbol (only if changing)</td>
            <td style="width:80%">
            <input type="text" name="newSymbol" maxlength="8" placeholder="New Symbol" ></td>
        </tr>        
        <tr>
            <td>Name</td>
            <td><input type="text" name="name"  maxlength="60"  placeholder="ex: Acme Inc." ></td>
        </tr>

        <tr>
            <td>Owner User ID #</td>
            <td><input type="number" name="userid"  min="1" max="100000000"  placeholder="ex: 134" ></td>
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
                    <b> UPDATE </b>
                </button></td>
        </tr>
    </table>


</form>
