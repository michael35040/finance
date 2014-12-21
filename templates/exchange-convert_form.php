
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
      border:5px solid transparent; /*5px solid transparent*/
    }
    label > input:checked + img{ /* (CHECKED) IMAGE STYLES */
      border:5px solid #000; /*f00*/
    }  
/*ABOVE FOR PICTURE RADIO*/
    
  </style>
  





<?php
function colorize($symbol)
{
    $color = '888888';
    if($symbol == 'CNY'){$color = 'FF3300';} //red
    if($symbol == 'EUR'){$color = '000099';} //official euro blue
    if($symbol == 'GBP'){$color = '3355dd';} //blue
    if($symbol == 'INR'){$color = '663300';} //brown
    if($symbol == 'JPY'){$color = 'FF9999';} //white
    if($symbol == 'USD'){$color = '85bb65';} //green 85bb65 00ff00 336600
    if($symbol == 'XBT'){$color = 'ffa500';} //orange ffa500
    if($symbol == 'XAG'){$color = 'cccccc';} //gray
    if($symbol == 'XAU'){$color = 'ffd700';} //gold

    return($color);
/*CONSTANTS
$unittype = "USD";
$unitdescription = "U.S. Dollar";
$unitdescriptionshort = "Dollar";
$unitsymbol = "$";
$decimalplaces = 2;
*/

    
/*ASSETS
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








<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn" data-toggle="modal" data-target="#myModal">
    Rates
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Conversion Rates</h4>
            </div>
            <div class="modal-body">
                <p>Rates are based on top ask. Prices are dynamic.</p>

                <table class="table table-condensed  table-bordered" style="font-size:8px;">
                    <?php
                    $assetcount = count($assets);
                    ?>
                    <thead>
                    <tr><td></td>
                        <?php     //apologize(var_dump(get_defined_vars()));

                        $a1=0;

                        foreach($assets as $asset){
                            $a1++;
                            echo('<td>' . $asset["symbol"] . '</td>');
                            $symbolRow[$a1] = $asset["symbol"];
                        }



                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($assets as $asset)
                    {
                        echo('<tr><td>' . $asset["symbol"] . '</td>');
                        $i=0;
                        while($assetcount>$i){$i++; echo('<td>' . number_format(conversionRate($asset["symbol"],$symbolRow[$i]),2,".",",") . '</td>');}
                        echo('</tr>');
                    } ?>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





















<h3>QUANTITY</h3>

<form action="exchange-convert.php" method="post">
    <fieldset>


<input type="number" id="quantity" placeholder="Quantity" name="quantity" min="1" required>



<hr>
<h3>FROM</h3>


<!--UNITS-->
<label>
<input type="radio" name="symbol1" value="<?php echo($unittype); ?>" />
<img src="placeholder.php?height=100&width=200&text=<?php echo($unittype); ?>&name=<?php echo($unitdescription); ?>&quantity=<?php echo($units); ?>&price=<?php echo("1"); ?>&backgroundcolor=<?php $color = colorize($unittype); echo($color); ?>&fontcolor=ffffff" alt="<?php echo($unittype); ?>" />
</label>

                                <?php

                        if (empty($stocks)) {
                            echo("<option value=''>No Assets Held</option>");
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
                                $name = $stock["name"];
                                //echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                                if($quantity>0)
                                {
                                ?>
                                  <label>
                                    <input type="radio" name="symbol1" value="<?php echo($symbol); ?>" />
                                      <img src="placeholder.php?height=100&width=200&text=<?php echo($symbol); ?>&name=<?php echo($name); ?>&price=<?php echo("1"); ?>&quantity=<?php echo($quantity); ?>&price=<?php echo($price); ?>&backgroundcolor=<?php echo($color); ?>&fontcolor=ffffff" alt="<?php echo($symbol); ?>" />
                                  </label>
                                <?php
                                }
                            }
                        }
?>
        <br>






<hr>
<h3>TO</h3>



        <?php

                        if (empty($assets)) {
                            echo("<option value=' '>No Assets</option>");
                        } else 
                        {
                            
                            foreach ($assets as $asset) {
                                $symbol = $asset["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                $color = colorize($symbol);
                                $name = htmlspecialchars($asset["name"]);

                                //echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                                ?>
                              <label>
                                <input type="radio" name="symbol2" value="<?php echo($symbol); ?>" />
                                  <img src="placeholder.php?height=100&width=200&text=<?php echo($symbol); ?>&name=<?php echo($name); ?>&backgroundcolor=<?php echo($color); ?>&fontcolor=ffffff" alt="<?php echo($symbol); ?>" />
                              </label>
                            <?php
                            }
                        }
                        ?>
        <br>





<hr>

        <div style="font-size: xx-small; color:red;">
            Prices are dynamic and subject to change.<br>
            <?php $commission*=100; echo(number_format($commission, 2, '.', ',') . "% Commission"); ?>
        </div>


        <button type="submit" class="btn btn-primary">SUBMIT</button>

        <br>
        <br>


    </fieldset>
</form>










<a href="exchange-advance.php">
<button type="button" class="btn btn-danger btn-xs">Advanced
</button>
</a>








