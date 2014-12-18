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
        text-align: center;
    }
</style>




<table class="table table-condensed  table-bordered" >
<thead>
    <tr   class="active" >
        <th colspan="3">Reference</th>
    </tr>
    <tr   class="active" >
        <th></th>
        <th>Troy Ounces (X**)</th>
        <th>Grams (X**G)</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>Gold</td><!--metal-->
        <td>XAU</td><!--ozt-->
        <td>XAUG</td><!--g-->
    </tr>
    <tr>
        <td>Silver</td><!--metal-->
        <td>XAG</td><!--ozt-->
        <td>XAGG</td><!--g-->
    </tr>
    <tr>
        <td>Platinum</td><!--metal-->
        <td>XPT</td><!--ozt-->
        <td>XPTG</td><!--g-->
    </tr>
    <tr>
        <td>Palladium</td><!--metal-->
        <td>XPD</td><!--ozt-->
        <td>XPDG</td><!--g-->
    </tr>
</tbody>    
</table>

<table class="table table-condensed  table-bordered" >
    <thead>
        <tr class="active">
            <th colspan="3">Units of Measure</th>
        </tr>
        <tr class="active">
            <th>Abr.</th>
            <th>Name</th>
            <th>Conv.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>mg</td>
            <td>milligrams</td>
            <td>0.001g</td>
        </tr>
        <tr>
            <td>g</td>
            <td>gram</td>
            <td>1g</td>
        </tr>
        <tr>
            <td>ozt</td>
            <td>troy ounce</td>
            <td>31.1034768g</td>
        </tr>
        <tr>
            <td>kg</td>
            <td>kilograms</td>
            <td>1,000g</td>
        </tr>
        <tr>
            <td>Mg</td>
            <td>megagrams</td>
            <td>1,000,000g</td>
        </tr>
    </tbody>
</table>

<table class="table table-condensed  table-bordered" >
<thead>
    <tr   class="active" >
        <th>Notes</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>Bullion is stored with LBMA member companies.</td><!--notes-->
    </tr>    
    <tr>
        <td>All weights displayed are fine weight. Ounces are Troy.</td><!--notes-->
    </tr>    
    <tr>
        <td>Totals are rounded to two decimal places for display.</td><!--notes-->
    </tr>
</tbody>
</table>











<table class="table table-condensed  table-bordered" >
    <tr   class="active" >
        <th>Asset</th>
        <th>Obligations</th>
        <th>Assets</th>
    </tr>
    <?php
    //OBLIGATIONS UNITS
    $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id<>1 AND side='b')");	  // query user's portfolio
    if($bidLocked[0]["total"]==null){$bidLocked[0]["total"]=0;}
    $obligationsLocked = ($bidLocked[0]["total"]); //shares trading
    $accounts =	query("SELECT SUM(units) as units FROM accounts WHERE id<>1");	 //query db
    if($accounts[0]["units"]==null){$accounts[0]["units"]=0;}
    $obligationsUnits = ($accounts[0]["units"]);
    $totalObligations = $obligationsLocked + $obligationsUnits;

    //ASSETS UNITS
    $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=1 AND side='b')");	  // query user's portfolio
    if($bidLocked[0]["total"]==null){$bidLocked[0]["total"]=0;}
    $assetsLocked = ($bidLocked[0]["total"]); //shares trading
    $accounts =	query("SELECT SUM(units) as units FROM accounts WHERE id=1");	 //query db
    if($accounts[0]["units"]==null){$accounts[0]["units"]=0;}
    $assetsUnits = ($accounts[0]["units"]);
    $totalAssets = $assetsLocked + $assetsUnits;


    ?>
    <tr>
        <td><?php echo($unittype); ?></td>
        <td><?php echo(number_format(getPrice($totalObligations),$decimalplaces,".",",")); ?></td>
        <td><?php echo(number_format(getPrice($totalAssets),$decimalplaces,".",",")); ?></td>
    </tr>

    <?php
    $obligationMV = 0;
    $assetMV = 0;

    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio
    foreach ($assets as $row)		// for each of user's stocks
    {
        $symbol = $row["symbol"];

        //pull obligations from port and ob db.
        $obligationPortfolio =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE (symbol =? AND id<>1)", $symbol);	  // query user's portfolio
            if(empty($obligationPortfolio[0]["quantity"])){$obligationPortfolio[0]["quantity"]=0;}
            $totalPortfolio = $obligationPortfolio[0]["quantity"]; //shares held
        $obligationOrderbook =	query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a' AND id<>1)", $symbol);	  // query user's portfolio
            if(empty($obligationOrderbook[0]["quantity"])){$obligationOrderbook[0]["quantity"]=0;}
            $totalOrderbook = $obligationOrderbook[0]["quantity"]; //shares held
        $obligations = ($totalPortfolio+$totalOrderbook);

        //pull assets total from db
        $assets = 1000000; //until we create the 'assets' db.
        /*
        //ASSETS DB MODEL
        //UID // ITEMS (# OF ITEMS) // DESCRIPTION (i.e. 100ozt SILVER BAR) // SERIAL (OR ADDRESS) // QUANTITY (GRAMS) // DEPOSITORY //
        
        $asset =	query("SELECT SUM(quantity) AS quantity FROM assets WHERE (symbol =?)", $symbol);	  // query user's portfolio
            if(empty($asset[0]["quantity"])){$asset[0]["quantity"]=0;}
            $assets = $assetPortfolio[0]["quantity"]; //shares held
        */
                    
            //if(empty($obligationOrderbook[0]["price"])){$AskPrice=0;} //returning 0...
        $askPrice =	query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a' AND id=1)", $symbol);	  // query user's portfolio
            if(empty($askPrice[0]["price"])){$askPrice[0]["price"]=0;}
        $askPrice = $askPrice[0]["price"];
        $obligationMV = ($AskPrice*$obligations) + $obligationMV;
        $assetMV = ($AskPrice*$assets) + $assetMV;
        ?>

        <tr>
            <td><?php echo($symbol); ?></td>
            <td><?php echo(number_format($obligations,$decimalplaces,".",",")); ?></td>
            <td><?php echo(number_format($assets,$decimalplaces,".",",")); ?></td>
        </tr>
    <?php
    }

    $obligationMV = $obligationMV+$totalObligations;
    $assetMV = $assetMV+$totalAssets;
    ?>

    <tr   class="active" >

        <td><strong>TOTAL</strong></td>
        <td><strong><?php echo(number_format(getPrice($obligationMV),$decimalplaces,".",",")); ?></strong></td>
        <td><strong><?php echo(number_format(getPrice($assetMV),$decimalplaces,".",",")); ?></strong></td>

    </tr>

</table>

















<table class="table table-condensed  table-bordered" >
<thead>
    <tr   class="active" >
        <th></th>
        <th colspan="2">Assets (Bullion Reserve SPT)</th>
        <th colspan="2">Liabilities (In Circulation)</th>
    </tr>
    <tr   class="active" >
        <th>Metal</td>
        <th>Fine Troy Ounces (ozt)</th>
        <th>Fine Grams (g)</th>
        <th>Fine Troy Ounces (ozt)</th>
        <th>Fine Grams (g) </th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>Gold</td><!--metal-->
        <td></td><!--ozt asset-->
        <td></td><!--g asset-->
        <td></td><!--ozt liability-->
        <td></td><!--g liability-->
    </tr>
    <tr>
        <td>Silver</td><!--metal-->
        <td></td><!--ozt asset-->
        <td></td><!--g asset-->
        <td></td><!--ozt liability-->
        <td></td><!--g liability-->
    </tr>
    <tr>
        <td>Platinum</td><!--metal-->
        <td></td><!--ozt asset-->
        <td></td><!--g asset-->
        <td></td><!--ozt liability-->
        <td></td><!--g liability-->
    </tr>
    <tr>
        <td>Palladium</td><!--metal-->
        <td></td><!--ozt asset-->
        <td></td><!--g asset-->
        <td></td><!--ozt liability-->
        <td></td><!--g liability-->
    </tr>
</tbody>    
</table>







<table class="table table-condensed  table-bordered" >
<thead>
    <tr   class="active" >
        <th colspan="17">Bullion Reserve Special Purpose Trust</th>
    </tr>
    <tr   class="active" >
        <th colspan="17">Summary by Repository</th>
    </tr>
    <tr   class="active" >
        <th colspan="1"></th>
        <th colspan="4">XAU</th>
        <th colspan="4">XAG</th>
        <th colspan="4">XPT</th>
        <th colspan="4">XPD</th>
    </tr>
    <tr   class="active" >
        <th>Repository</th>
        <!--XAU-->
        <th>#</th><!--Number of Items-->
        <th>ozt</th><!--Fine Troy Ounces-->
        <th>g</th><!--Fine Grams-->
        <th>%</th><!--Portion of Total -->
        <!--XAG-->
        <th>#</th><!--Number of Items-->
        <th>ozt</th><!--Fine Troy Ounces-->
        <th>g</th><!--Fine Grams-->
        <th>%</th><!--Portion of Total -->
        <!--XPT-->
        <th>#</th><!--Number of Items-->
        <th>ozt</th><!--Fine Troy Ounces-->
        <th>g</th><!--Fine Grams-->
        <th>%</th><!--Portion of Total -->
        <!--XPD-->
        <th>#</th><!--Number of Items-->
        <th>ozt</th><!--Fine Troy Ounces-->
        <th>g</th><!--Fine Grams-->
        <th>%</th><!--Portion of Total -->
    </tr>
</thead>
<tbody>
    <tr>
        <td>Brinks</td>
        <!--XAU-->
        <td>120</td>
        <td>48,133.55</td>
        <td>1,497,120.76</td>
        <td>61.58%</td>
        <!--XAG-->
        <td>120</td>
        <td>48,133.55</td>
        <td>1,497,120.76</td>
        <td>61.58%</td>
        <!--XPT-->
        <td>120</td>
        <td>48,133.55</td>
        <td>1,497,120.76</td>
        <td>61.58%</td>
        <!--XPD-->
        <td>120</td>
        <td>48,133.55</td>
        <td>1,497,120.76</td>
        <td>61.58%</td>
    </tr>
    <tr>
        <td>Transguard</td>
        <!--XAU-->
        <td>230</td>
        <td>28,430.95</td>
        <td>884,301.39</td>
        <td>36.38%</td>
        <!--XAG-->
        <td>230</td>
        <td>28,430.95</td>
        <td>884,301.39</td>
        <td>36.38%</td>
        <!--XPT-->
        <td>230</td>
        <td>28,430.95</td>
        <td>884,301.39</td>
        <td>36.38%</td>
        <!--XPD-->
        <td>230</td>
        <td>28,430.95</td>
        <td>884,301.39</td>
        <td>36.38%</td>
    </tr>
    <tr>
        <td>MAT Securitas Express AG</td>
        <!--XAU-->
        <td>4</td>
        <td>1,593.73</td>
        <td>49,570.54</td>
        <td>2.04%</td>
        <!--XAG-->
        <td>4</td>
        <td>1,593.73</td>
        <td>49,570.54</td>
        <td>2.04%</td>
        <!--XPT-->
        <td>4</td>
        <td>1,593.73</td>
        <td>49,570.54</td>
        <td>2.04%</td>
        <!--XPD-->
        <td>4</td>
        <td>1,593.73</td>
        <td>49,570.54</td>
        <td>2.04%</td>
    </tr>
    <tr class="active">
        <td>TOTAL</td>
        <!--XAU-->
        <td>354</td>
        <td>78,158.23</td>
        <td>2,430,992.69</td>
        <td>100.00%</td>
        <!--XAG-->
        <td>354</td>
        <td>78,158.23</td>
        <td>2,430,992.69</td>
        <td>100.00%</td>
        <!--XPT-->
        <td>354</td>
        <td>78,158.23</td>
        <td>2,430,992.69</td>
        <td>100.00%</td>
        <!--XPD-->
        <td>354</td>
        <td>78,158.23</td>
        <td>2,430,992.69</td>
        <td>100.00%</td>
    </tr>
</tbody>    
</table>



<table class="table table-condensed  table-bordered" >
    <thead>
        <tr class="active">
            <th colspan="3">Currently there are 5,152,000 accounts</th>
        </tr>
        <tr class="active">
            <th colspan="3">System Activity 24h</th>
        </tr>
        <tr class="active">
            <th>New Accounts</th>
            <th>Users Accessing</th>
            <th>Spends</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>194</td>
            <td>10,774</td>
            <td>10,100</td>
        </tr>
    </tbody>
</table>





<table class="table table-condensed  table-bordered" >
    <thead>
        <tr class="active">
            <th colspan="4">Velocity 24h</th>
        </tr>
        <tr class="active">
            <th>Metal</th>
            <th>Spends</th>
            <th>Weight</th>
            <th>USD Equiv.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Gold</td>
            <td>10,097</td>
            <td>26.68 kg</td>
            <td>$827,064.10</td>
        </tr>
        <tr>
            <td>Silver</td>
            <td>3</td>
            <td>145.11 g</td>
            <td>$85.71</td>
        </tr>
    </tbody>
</table>


<table class="table table-condensed  table-bordered" >
    <thead>
        <tr class="active">
            <th colspan="3">Distribution of Spends (XAU) 24h</th>
        </tr>
        <tr class="active">
            <th></th>
            <th>QTY</th>
            <th>Total</th>
        </tr>
    </thead>
    <?php
    function convertgram($total)
    {
        //CONVERT UNIT OF MEASURE TO APPROPRIATE UNIT (mg, g, kg, Mg)
        //everything in grams.
        //miligram
        if($total<1){$number = $total*1000; $unit = 'mg';}
        //gram
        if($total>=1 && $total<1000){$number = $total; $unit = 'g';}
        //kilogram
        if($total>=1000 && $total<1000000){$number = $total/1000; $unit = 'kg';}
        //megagram
        if($total>=1000000){$number = $total/1000000; $unit = 'Mg';}
        
        echo($number . $unit);
        return;
        
        //i.e. convergram($total); 
    }
    ?>
    <tbody>
        <tr>
            <td>0mg-1mg</td>
            <td>748</td>
            <td>407.83mg</td>
        </tr>
        <tr>
            <td>1mg-10mg</td>
            <td>2332</td>
            <td>9.67g</td>
        </tr>
        <tr>
            <td>10mg-100mg</td>
            <td>2407</td>
            <td>103.93mg</td>
        </tr>
        <tr>
            <td>1000mg-1g</td>
            <td>2816</td>
            <td>1.10kg</td>
        </tr>
        <tr>
            <td>1g-10g</td>
            <td>1408</td>
            <td>5.06kg</td>
        </tr>
        <tr>
            <td>10g-100g</td>
            <td>346</td>
            <td>10.58kg</td>
        </tr>
        <tr>
            <td>100g-1kg</td>
            <td>40</td>
            <td>9.83kg</td>
        </tr>
        <tr>
            <td>1kg-10kg</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td>10kg-100kg</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td>100kg-1Mg</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td>1Mg-10Mg</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td>10Mg+</td>
            <td>0</td>
            <td>0</td>
        </tr>
    </tbody>
</table>

