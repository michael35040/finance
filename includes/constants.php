<?php

    /***********************************************************************
	 * finance.php
     *
     *
     * Global finance constants.
     **********************************************************************/
//headers.php & config.php
$adminid = 1;

//header & footer
$sitename = 'Element'; //Pulwar or Element

//index & portfolio
$unittype = "USD"; //USD BTC
$unitsymbol = "$"; //$ b
$unittype2 = 'currency'; //currency or commodity
$unitdescription = "U.S. Dollar"; //U.S. Dollar
$unitdescriptionshort = "Dollar"; //Dollar
$unitdescriptionlong = "$";
//Each unit represents 1 bit of Bitcoin (BTC). Conversion: 1 BTC = 1 million bits; 1 BTC = 100 million satoshi
//$
$decimalplaces = 2;
//grams  &cent;  &micro; &euro; &pound; &yen; &sect;


//EXCHANGE.php/BUY.php/SELL.php
$commission = 00.02; //00.1 = 10%/00.01 = 1%/00.001 = 0.1%
$divisor = 0.01; //increment of exchange

$loud='loud'; //quiet or loud
$environment='test'; // 'live' or 'test' //config.php

//LOAN.php
//THESE ARE UP HERE TO ALSO PASS TO THE FORM
$loanrate = 00.1499; //announced here to pass to the form page, rest of info is on line 60-70
$loanfee = 00.01; //origination fee
$loanlimit = -1000000; //total outstanding loans allowed, wont let users get more loans if their balance is over 
//initial loan based on $initialunits *= -1


//DEPOSIT.php & WITHDRAW.php
$deplimit = 10000000000 ; //deposit limit, only let deposits if user has less than 


//REGISTER.php
$initialunits = 0; //initial deposit for LOAN




?>
