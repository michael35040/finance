
<style>
.nobutton button
    {
        padding:0;
        font-weight: 100;
        border:0;
        background:transparent;
    }
.table, th
    {
        background:white;
        text-align: center;
    }




/*BELOW FOR PICTURE RADIO*/
    label > input{ /* HIDE RADIO */
      display:none;
    }
    label > input + img{ /* IMAGE STYLES */
      cursor:pointer;
      border:2px solid transparent;
    }
    label > input:checked + img{ /* (CHECKED) IMAGE STYLES */
      border:2px solid #f00;
    }  
/*ABOVE FOR PICTURE RADIO*/
    
  </style>
  





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




<br>
<hr>
<br>
<br>


  <label>
    <input type="radio" name="symbol1" value="USD" />
    <img src="http://placehold.it/200x100/0F0/fff&text=USD">
  </label>
  
  <label>
    <input type="radio" name="symbol1" value="XBT"/>
    <img src="http://placehold.it/200x100/35d/fff&text=XBT">
  </label>
  
  <label>
    <input type="radio" name="symbol1" value="XAG" />
    <img src="http://placehold.it/200x100/CCC/fff&text=XAG">
  </label>
  
  <label>
    <input type="radio" name="symbol1" value="XAU" />
    <img src="http://placehold.it/200x100/ffd700/fff&text=XAU">
  </label>
 
 
<br>
<hr>
<br>
<br>
<img src="http://placehold.it/200x100/0F0/fff&text=<?php echo($symbol); ?>">
<img src="placeholder.php?size=50x25&bg=ffd700&fg=fff&text=XAU" alt="XAU" />
<img src="placeholder.php?size=100x50&bg=ffd700&fg=fff&text=XAU GOLD" alt="XAU" />
<img src="placeholder.php?size=200x100&bg=ffd700&fg=fff&text=XAU GOLD" alt="XAU" />
<br>
<hr>
<br>
<br>

<?php

                        if (empty($stocks)) {
                            echo("<option value=' '>No Stocks Held</option>");
                        } else 
                        {
                            foreach ($stocks as $stock) {
                                $symbol = $stock["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                $quantity = $stock["quantity"];
                                $quantity = htmlspecialchars($quantity);
                                $lockedStock = $stock["locked"];
                                $lockedStock = htmlspecialchars($lockedStock);
                                //echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                                ?>
                                  <label>
                                    <input type="radio" name="symbol1" value="<?php echo($symbol); ?>" />
                                    <img src="http://placehold.it/200x100/0F0/fff&text=<?php echo($symbol); ?>">
                                    <br><?php echo(number_format($quantity, 0, '.', ',') . "/" . number_format($lockedStock, 0, '.', ',')); ?>
                                  </label>
                                <?php

                            }
                        }
                        
echo ('<hr>');                        
                        
                        if (empty($assets)) {
                            echo("<option value=' '>No Assets</option>");
                        } else 
                        {
                            
                            foreach ($assets as $asset) {
                                $symbol = $asset["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                //echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                                ?>
                              <label>
                                <input type="radio" name="symbol2" value="<?php echo($symbol); ?>" />
                                <img src="http://placehold.it/200x100/0F0/fff&text=<?php echo($symbol); ?>">
                              </label>
                            <?php
                            }
                        }
                        ?>







