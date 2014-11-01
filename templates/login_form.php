<style>

    a:link {color:white;}      /* unvisited link */
    a:visited {color:white;}  /* visited link */
    a:hover {color:white;}  /* mouse over link */
    a:active {color:white;}  /* selected link */

    .panel-group
    {
        color:black;
    }

    .info, .info th
    {
        height: auto;
        border: 0px solid black;
        padding: 10px;
        color:black;
        font-style:normal;
        font-weight: normal !important;
        font-size:12px;
        text-align: center;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
        position: relative;
        width: 20%;
        background-color: white;
        opacity:.96;
        filter:alpha(opacity=96); /* For IE8 and earlier */
        text-shadow: 0px 0px 0px black; /* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
    }
    .info td
    {
        padding-left: 10px;
        padding-right: 10px;
        /*padding:7px;*/
        border-right: 0px solid black;
    }

    .bstable
    {
        display: inline-table;
        float:left;
        align:center;
    }

    .row
    {   text-align: center;
        width: 50%;
        margin: 0 auto;
    }
</style>

<form action="login.php" name="login_form" method="post">
    <fieldset>

        <div class="row">

            <div class="col-lg-6" style="width:100%;">
                <div class="input-group input-group-sm" style="text-align:center">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input class="form-control" name="username" placeholder="Username" type="text" autofocus required  />

                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input class="form-control" name="password" placeholder="Password" type="password" required/>

                <span class="input-group-btn">
                <button type="submit" class="btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-off"></span>
                    <b> LOG IN </b>
                </button>
                </span>

                </div>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

    </fieldset>
</form>
<br>

<a href="register.php" class="btn btn-success btn-sm">
    <span class="glyphicon glyphicon-pencil"></span>
    <b> &nbsp;  REGISTER </b>
</a>

<br /><br />
<!--btn-primary/-info/-warning/-danger/-success/default/ -->
<!--btn-sm/-btn-medium-->










<div class="panel-group" id="accordion">
    <div class="panel panel-default" id="panel1" style="background-color: transparent; padding: 0; border:0">
        <div class="panel-heading" style="background-color: transparent; padding: 0">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-warning btn-sm" >
                    <span class="glyphicon glyphicon-stats"></span>
                    <b> &nbsp;  EXCHANGE </b>
                </a>

            </h4>
        </div><!--panel title-->
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body" style=" border:0">
























<table class="info" style="width:100%" align="center" cellpadding="10px">
    <tr>
        <th style="font-size:25px">Proven</th>
        <th style="font-size:25px">Fair</th>
        <th style="font-size:25px">Markets</th>
        <th style="font-size:25px">Secure</th>
        <th style="font-size:25px">Insured</th>
    </tr>

    <tr>
        <td style="width:20%;" ><i class="fa fa-globe fa-4x"></i></td>
        <td style="width:20%;" ><i class="fa fa-exchange fa-4x"></i></td>
        <td style="width:20%;"  rowspan="2">

            <table class="bstable" border="1" cellspacing="0" cellpadding="0"  style="width:50%; text-align:center;" />
    <tr>
        <td colspan="2" bgcolor="#CCCCCC" style="width:100%;" >
            <font color="black" size="+1"><b>Bid</b></font><!--Bid are Buyers when you are Selling, ie your sell price-->
        </td>
    </tr>

    <tr>
        <td ><b><u>Qty</u></b></td>
        <td ><b><u>Price</u></b></td>
    </tr>


    <?php

    foreach ($bidGroup as $order)
    {
        $quantity = $order["quantity"];
        $price = $order["price"];
        echo("<tr><td>" . number_format($quantity,0,".",",") . "</td><td>" . number_format($price,2,".",",") . "</td></tr>");
    }
    ?>
</table>

<table class="bstable" style="width:50%;" border="1" cellspacing="0" cellpadding="0" align="center" >

    <tr>
        <td colspan="2" bgcolor="#000000" style="width:100%;" >
            <font color="white" size="+1"><b>Ask</b></font><font color="white"> <!--Ask are Sellers when you are Buying, ie your Buy price--></font>
        </td>
    </tr>

    <tr>
        <td ><b><u>Price</u></b></td>
        <td ><b><u>Qty</u></b></td>
    </tr>

    <?php
    foreach ($askGroup as $order)
    {
        $price = $order["price"];
        $quantity = $order["quantity"];
        echo("<tr><td>" . number_format($price,2,".",",") . "</td><td>" . number_format($quantity,0,".",",") . "</td></tr>");
    }
    ?>

</table>

Buyer's Bid/Seller's Ask.</td>

<td width="20%"><i class="fa fa-shield fa-4x"></i></td>
<td width="20%"><i class="fa fa-umbrella fa-4x"></i></td>
</tr>

<tr>
    <td>Our proven technology platform is powered by   one of Wall Streets fastest exchange engine  deployed by some of Wall Street's largest proprietary trading firms and institutions.</td>
    <td>Our fair market state-of-the-art exchange order book matching engine orders based on price/time priority allowing for transparent markets. No fees to transfer money in and out.
    </td>
    <td>Our secured system uses two-factor authentication, critical information stored on air-gap remote terminals, multi-tiered multi-firewall architecture allows safe transactions of multiple assets</td>
    <td>Our system and exchange has insurance coverage against loss from disasters or theft so that you can rest easy knowing your finances are in good hands.</td>
</tr>

<!--tr>
    <td colspan="5">
        <iframe id="chart" seamless="seamless" class="chart" name="chart" frameBorder="0" src="chart.php">Browser not compatible.</iframe>
    </td>
</tr-->

</table>




<!--COLLAPSE ACCORDIAN-->
            </div><!--panel body-->
        </div><!--panel heading-->
    </div><!--panel default-->
</div><!--panel group-->
<!--COLLAPSE ACCORDIAN-->









<a href="mailto:me@gmail.com" class="btn btn-danger btn-sm">
    <span class="glyphicon glyphicon-envelope"></span>
    <b> &nbsp; CONTACT </b>
</a>
<!--end buttons-->