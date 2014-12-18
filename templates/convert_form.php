
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
      border:5px solid #000; /*5px solid transparent*/
    }
    label > input:checked + img{ /* (CHECKED) IMAGE STYLES */
      border:5px solid #fff; /*f00*/
    }  
/*ABOVE FOR PICTURE RADIO*/
    
  </style>
  





<?php
function colorize($symbol)
{
    $color = '888888';
    if($symbol == 'CNY'){$color = 'ff0000';} //red
    if($symbol == 'EUR'){$color = '000099';} //official euro blue
    if($symbol == 'GBP'){$color = '3355dd';} //blue
    if($symbol == 'INR'){$color = '663300';} //brown
    if($symbol == 'JPY'){$color = 'ffa500';} //orange
    if($symbol == 'USD'){$color = '00ff00';} //green
    if($symbol == 'XBT'){$color = '000000';} //black
    if($symbol == 'XAG'){$color = 'cccccc';} //gray
    if($symbol == 'XAU'){$color = 'ffd700';} //gold

    return($color);
    
/*
XAU - Gold Ounce AU
XAG - Silver Ounce AG
XBT - Bitcoin NA
USD - US Dollar (United States) $
EUR - Euro (Euro Member Countries) €
GBP - British Pound (United Kingdom) £
INR - Indian Rupee (India) ₹
CHF - Swiss Franc (Switzerland) NA
JPY - Japanese Yen (Japan) ¥
CNY - Chinese Yuan Renminbi (China) ¥
*/
}

?>
<h3>Convert Asset</h3>

<form action="convert.php" method="post">
    <fieldset>


<input type="number" id="quantity" placeholder="Quantity" name="quantity" min="1" required>
<hr>




<?php

                        if (empty($stocks)) {
                            echo("<option value=''>No Stocks Held</option>");
                        } else 
                        {
                            foreach ($stocks as $stock) {
                                $symbol = $stock["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                $quantity = $stock["quantity"];
                                $quantity = htmlspecialchars($quantity);
                                $lockedStock = $stock["locked"];
                                $price=$stock["askprice"];
                                $lockedStock = htmlspecialchars($lockedStock);
                                $color = colorize($symbol);
                                //echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                                if($quantity>0)
                                {
                                ?>
                                  <label>
                                    <input type="radio" name="symbol1" value="<?php echo($symbol); ?>" />
                                      <img src="placeholder.php?height=100&width=200&text=<?php echo($symbol); ?>&quantity=<?php echo($quantity); ?>&price=<?php echo($price); ?>&backgroundcolor=<?php echo($color); ?>&fontcolor=ffffff" alt="<?php echo($symbol); ?>" />

                                      <?php //echo($stock["askprice"]); // echo('<br>' . number_format($quantity, 0, '.', ',')); // . "/" . number_format($lockedStock, 0, '.', ',')
                                      ?>
                                  </label>
                                <?php
                                }
                            }
                        }
?>
        <br>
        <?php
        /*
            if (empty($stocks)) {
                echo("<select name='symbol1'>");
                echo("<option value='' disabled='disabled'>No Stocks Held</option>");
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
        echo("</select>");
        */
        ?>





        <hr>



        <?php

                        if (empty($assets)) {
                            echo("<option value=' '>No Assets</option>");
                        } else 
                        {
                            
                            foreach ($assets as $asset) {
                                $symbol = $asset["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                $color = colorize($symbol);

                                //echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                                ?>
                              <label>
                                <input type="radio" name="symbol2" value="<?php echo($symbol); ?>" />
                                  <img src="placeholder.php?height=100&width=200&text=<?php echo($symbol); ?>&backgroundcolor=<?php echo($color); ?>&fontcolor=ffffff" alt="<?php echo($symbol); ?>" />
                              </label>
                            <?php
                            }
                        }
                        ?>


        <br>
        <?php
        /*
            if (empty($assets)) {
                echo("<select name='symbol2'><option value=''>No Assets</option>");
            } else {
                echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                foreach ($assets as $asset) {
                    $symbol = $asset["symbol"];
                    $symbol = htmlspecialchars($symbol);
                    echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                }
            }
        echo("</select>");
        */
        ?>




<hr>



        <button type="submit" class="btn btn-info">CONVERT</button>


    </fieldset>
</form>

<div style="font-size: xx-small; color:red;">
<?php $commission*=100; echo(number_format($commission, 2, '.', ',') . "% Commission"); ?>
</div>

