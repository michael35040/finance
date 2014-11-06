
<?php
require("../includes/config.php");
require("../includes/config.php");  // configuration

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
orderbook($symbol);
}
else
{
  ?>
  
  
<form action="information.php"  class="symbolForm" method="post"   >
    <fieldset>

                        <table>
                            <tr>
                                <td>
                                    <div class="input-group" >
                                        <!--
                                            <input list="symbol" placeholder="Symbol" name="symbol" maxlength="8" class="form-control"  required>
                                            <datalist id="symbol">
                                            -->
                                        <select name="symbol"  class="form-control"  required>
                                            <?php
                                            if (empty($stocks)) {
                                                echo("<option value=' '>No Stocks Held</option>");
                                            } else {
                                                echo ('<option class="select-dash" disabled="disabled">-Assets (Owned/Locked)-</option>');
                                                foreach ($stocks as $stock) {
                                                    $symbol = $stock["symbol"];
                                                    $quantity = $stock["quantity"];
                                                    $lockedStock = $stock["locked"];
                                                    echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                                                }
                                            }
                                            if (empty($assets)) {
                                                echo("<option value=' '>No Assets</option>");
                                            } else {
                                                echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                                                foreach ($assets as $asset) {
                                                    $symbol = $asset["symbol"];
                                                    echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                                                }
                                            }
                                            ?>
                                        </select>
                                            <!--
                                            </datalist>
                                            -->

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



  
  
  <?php
} //else !post

?>
