<style>
    .info
    {
        overflow:auto;
        display:block;
        height: auto;
        padding-bottom: 0px; /* must be same height as the footer */
        margin-bottom: 10px;
        color:black;
        font-style:normal;
        font-weight: normal !important;
        color:black;
        font-size:12px;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
        position: relative;
        width: 100%;
        background-color: white;
        opacity:.96;
        filter:alpha(opacity=96); /* For IE8 and earlier */
        text-shadow: 0px 0px 0px black; /* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
    }

    .chart
    {
        /*	background-color: white; */
        overflow:hidden;
        overflow-x:hidden;
        overflow-y:hidden;
        height:600px;
        width:100%;
        position:relative;
        top:0px;
        left:0px;
        right:0px;
        bottom:0px;
        font-style:normal;
        font-weight:normal;
        text-align:left;
        line-height:normal;
        z-index: 0;
        opacity:.98;
        filter:alpha(opacity=98); /* For IE8 and earlier */
        background-color: white;

    }

    .bstable
    {
        display: inline-table;
        float:left;
        align:center;
    }

</style>


<form action="login.php" name="login_form" method="post">
    <fieldset>
        <div class="input-append">

            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                <input class="input-small" id="inputIcon" name="username" placeholder="Username" type="text" autofocus required  />
            </div><!--input-prepend-->

            <div class="input-prepend">
                <span class="add-on"><i class="icon-star"></i></span>
                <input class="input-small" id="inputIcon" name="password" placeholder="Password" type="password" required/>
            </div><!--input-prepend-->

            <button type="submit" class="btn btn-info"><i class="icon-off"></i><b> LOG IN </b></button>

        </div><!--input-append-->
        <!--end form-->
    </fieldset>
</form>

        <a href="register.php" class="btn btn-success btn-medium"><i class="fa fa-pencil"></i> &nbsp; REGISTER</a>
<br /><br />
<!--btn-primary/-info/-warning/-danger/-success/default/ -->

<!-- 2 rows (row/collapse-group) for collapse -->
<div class="row" style="margin-left: 0px;"><!--margin overrides bootstrap default of -30 for @media-->
    <div class="collapse-group">
        <!--add <div class="collapse"> to anything you want to collapse-->
        <!--2 row end-->

        <a href="" class="btn btn-warning btn-medium"><i class="fa fa-line-chart"></i> &nbsp; EXCHANGE</a>
        <!--end buttons-->


        <div class="collapse">
            <br />

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




            <!--COLLAPSE BOTTOM-->
        </div><!--collapse-->
    </div><!--collapse-group-->
</div><!--row-->
<script>
    $('.row .btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('.collapse-group').find('.collapse');
        $collapse.collapse('toggle');
    });
</script>
<!--COLLAPSE BOTTOM-->

</br>
<a href="mailto:me@gmail.com" class="btn btn-danger btn-medium"><i class="fa fa-envelope-o"></i> &nbsp; CONTACT</a>
<!--end buttons-->
