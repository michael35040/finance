<html>

<form action="convert.php" method="post">
    <fieldset>

        <table class="table table-condensed  table-bordered" >
            <thead>
            <tr>
                <th colspan="2">
                    <div  style="font-size:120%;text-align:center;">CONVERT<hr>FROM</div>
                </th>
            </tr>
            </thead>
            <tbody>



            <TR>
                <TD ROWSPAN="1">Quantity</TD>
                <TD>
                    <!--<input type="range" id="quantity" placeholder="Quantity" name="quantity" value=1
                           min="1" max="10000" step="1" style="width:100%;" required> -->
                    <input type="number" id="quantity" placeholder="Quantity" name="quantity" value=1
                           min="1" required>

                </TD>
            </TR>

            <TR>
                <TD ROWSPAN="1">Symbol 1</TD>
                <TD>
                    <select name="symbol1"><?php

                        if (empty($stocks)) {
                            echo("<option value=' '>No Stocks Held</option>");
                        } else {
                            echo ('<option class="select-dash" disabled="disabled">-Assets (Owned/Locked)-</option>');
                            foreach ($stocks as $stock) {
                                $symbol = $stock["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                $quantity = $stock["quantity"];
                                $quantity = htmlspecialchars($quantity);
                                $lockedStock = $stock["locked"];
                                $lockedStock = htmlspecialchars($lockedStock);
                                echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                            }
                        }
                        if (empty($assets)) {
                            echo("<option value=' '>No Assets</option>");
                        } else {
                            echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                            foreach ($assets as $asset) {
                                $symbol = $asset["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                            }
                        }
                        ?></select>
                </TD>
            </TR>

            <TR>
                <td colspan="2">
                    <div  style="font-size:120%;text-align:center;font-weight:bold;">TO</div>
                </td>
            </TR>

            <TR>
                <TD ROWSPAN="1">Symbol 2 </TD>
                <TD>
                    <select name="symbol2"><?php

                        if (empty($stocks)) {
                            echo("<option value=' '>No Stocks Held</option>");
                        } else {
                            echo ('<option class="select-dash" disabled="disabled">-Assets (Owned/Locked)-</option>');
                            foreach ($stocks as $stock) {
                                $symbol = $stock["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                $quantity = $stock["quantity"];
                                $quantity = htmlspecialchars($quantity);
                                $lockedStock = $stock["locked"];
                                $lockedStock = htmlspecialchars($lockedStock);
                                echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                            }
                        }
                        if (empty($assets)) {
                            echo("<option value=' '>No Assets</option>");
                        } else {
                            echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                            foreach ($assets as $asset) {
                                $symbol = $asset["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                            }
                        }
                        ?></select>
                </TD>
            </TR>




            <tr><td colspan="2">
                        <button type="submit" class="btn btn-primary">CONVERT</button>
                </td>
            </tr>

            </tbody>

        </TABLE>




    </fieldset>
</form>

</html>
