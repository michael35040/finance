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
        display: inline-table;float:left;align:center;
    }

    .row
    {   text-align: center;
        width: 100%; //login bar
        margin: 0 auto;
    }
</style>

<?php if(!empty($info)){echo("<p>" . $info . "</p>");}?>

    <div class="container">
      <form class="form-signin" role="form" action="login.php" name="login_form" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password"  required>

        <span class="input-group-btn">
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                <span class="glyphicon glyphicon-off"></span>
                 Sign in 
            </button>
        </span>
                

        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>

      </form>
    </div> <!-- /container -->





<a href="register.php" class="btn btn-success btn-sm">
<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;Not a member?&nbsp;&nbsp;</a><!--10 chars-->

<!--btn-primary/-info/-warning/-danger/-success/default/ -->
<!--btn-sm/-btn-medium-->
<br>
<br>

<div class="panel-group" id="accordion">
    <div class="panel panel-default" id="panel1" style="padding:0; background-color: transparent; border:0; " >
        <div class="panel-heading" style="padding:0; background-color: transparent; " >
            <h4 class="panel-title"  />
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-warning btn-sm" >
                    <span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;INFORMATION</a><!--10 chars-->

            </h4>
        </div><!--panel title-->
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body" style="border:0; padding-bottom: 0;" >



                    <table class="info" style="width:100%" align="center" cellpadding="10px">
                        <tr>
                            <th style="font-size:25px">Proven</th>
                            <th style="font-size:25px">Fair</th>
                            <th style="font-size:25px">Markets</th>
                            <th style="font-size:25px">Secure</th>
                            <th style="font-size:25px">Fast</th>
                        </tr>

                        <tr>
                            <td style="width:20%;" ><span class="glyphicon glyphicon-globe" style="font-size:40px"></span></td>
                            <td style="width:20%;" ><span class="glyphicon glyphicon-random" style="font-size:40px"></span></td>
                            <td style="width:20%;"  rowspan="2">

                                <table class="table table-condensed table-striped table-bordered" style="border:1px solid black; width:50%; text-align:center;display: inline-table;float:left;align:center;" />
                                    <tr class="info">
                                        <td colspan="2" style="color:white;background-color:#000000;width:100%;padding: 2px;font-size: 150%;" >
                                            <b>BID</b><!--Bid are Buyers when you are Selling, ie your sell price-->
                                        </td>
                                    </tr>

                                    <tr class="active">
                                        <td ><b><u>Qty</u></b></td>
                                        <td ><b><u>Price</u></b></td>
                                    </tr>

                                    <?php
                                    foreach ($bidGroup as $order)
                                    {
                                        $quantity = $order["quantity"];
                                        $price = $order["price"];
                                        echo("<tr><td>" . number_format($quantity,0,".",",") . "</td><td><b>" . number_format($price,2,".",",") . "</b></td></tr>");
                                    }
                                    ?>
                                </table>
                                
                                <table class="table table-condensed table-striped table-bordered" style="border:1px solid black; width:50%; text-align:center;display: inline-table;float:left;align:center;" />
                                    <tr class="danger">
                                        <td colspan="2" style="color:white;background-color:#404040;width:100%;padding: 2px;font-size: 150%;" >
                                            <b>ASK</b>
                                        </td>
                                    </tr>

                                    <tr class="active">
                                        <td ><b><u>Price</u></b></td>
                                        <td ><b><u>Qty</u></b></td>
                                    </tr>

                                    <?php
                                    foreach ($askGroup as $order)
                                    {
                                        $price = $order["price"];
                                        $quantity = $order["quantity"];
                                        echo("<tr><td><b>" . number_format($price,2,".",",") . "</b></td><td>" . number_format($quantity,0,".",",") . "</td></tr>");
                                    }
                                    ?>
                                </table>

                            </td>
                            <td width="20%"><span class="glyphicon glyphicon-lock" style="font-size:40px"></span></td>
                            <td width="20%"><span class="glyphicon glyphicon-flash" style="font-size:40px"></span></td>
                        </tr>

                        <tr>
                            <td>Our platform is powered by an exchange engine deployed by some of Wall Street's most respected trading institutions.</td>
                            <td>Our exchange orderbook matching engine crosses orders on price/time priority allowing for transparent markets.</td>
                            <td>Our system has critical information stored on secured terminals and multi-tiered firewall architecture for safe transactions</td>
                            <td>Our proprietary multiple asset trading system has one of the fastest trade to execution times in the financial industry.</td>
                        </tr>
                        <tr><td colspan="5"><br> </td></tr>
                </table>



            </div><!--panel body-->
        </div><!--panel heading-->
    </div><!--panel default-->
</div><!--panel group-->

