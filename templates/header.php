<!DOCTYPE html>
<html lang="en">

<style>
    .sitenamefont {
        font-family:Arial;
        font-family:Georgia, "Times New Roman", Times, serif;
        font-size:xx-large;
        padding-top:10px;
        text-shadow: 1px 1px 5px #000;
    }
    .titlefont {
        font-family:Arial, Helvetica, sans-serif;
        font-size:large;
        padding-top:10px;
        text-shadow: 0px 0px 2px #000;
    }
    .navigationBar .btn-default
    {
        color: #444;
        background-color: #d1d1d1;
        border-color: #f8f8f8;
    }

    .table {margin-bottom:0;} /*set to 20 in bootstrap*/


</style>
<head>
    <?php require("../includes/constants.php"); //global finance constants  ?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script>



    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/styles.php" rel="stylesheet" media="screen"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div id="page" style="text-align:center">
<div id="top" style="text-align:center">


    <title>
        <?php
        if (isset($title))
        {
            echo(htmlspecialchars($sitename));
            echo(" ");
            echo(htmlspecialchars($title));

        }  ?>
    </title>

    <?php //$ranimg = rand(1,5); ?>
    <link rel="shortcut icon" href="../includes/<?php //echo($ranimg); ?>1.ico" />






    <table align="center" width="">
        <tr>
            <td align="">
                <img src="img/logo/<?php //echo($ranimg); ?>1.png" width="60"/> &nbsp;

            </td>
            <td>
                <div class="sitenamefont">
                    <?php echo(htmlspecialchars($sitename)); ?>
                </div><!--sitenamefont-->
                <div class="titlefont">
                    <!--color="#49afcd"--><?php if (isset($title))
                    { echo("" . htmlspecialchars($title) . "");
                    } ?>
                </div><!--titlefont-->
                <br />
            </td>
        </tr>
    </table>





    <!-- Menu in style.css -->
    <?php
    //SHOW ON LOG IN ARGUMENT FOR MENU AND INFORMATION
    //if (!isset($_SESSION["id"])) { logout(); } //if not set due to error, logout,
    if (!empty($_SESSION["id"]))
    {
    $users =	query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    @$userid = $users[0]["id"];
    @$email = $users[0]["email"];
    @$username = $users[0]["username"];
    // query cash for template
    $accounts =	query("SELECT * FROM accounts WHERE id = ?", $_SESSION["id"]);	 //query db
    @$units = $accounts[0]["units"];
    @$loan = $accounts[0]["loan"];
    @$rate = $accounts[0]["rate"];
    $rate *= 100; //for display as %
    @$approved = $accounts[0]['approved'];	//convert array from query to value
    //0 approved
    //1 unapproved
    //2 pending - not yet implemented
    ?>
    <div class="navigationBar">
        <div class="btn-group">

            <div class="btn-group">
                <div class="input-group">
                    <button id="bankButton" type="button" class="btn btn-default  btn-sm   dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-home"></span>
                        Home
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php">Accounts</a></li>
                        <li><a href="transfer.php">Transfer </a></li><!--<i class="icon-gift"></i>-->
                        <li><a href="loan.php">Loan</a></li>
                        <?php if ($loan < 0) { //-0.00000001 ?>
                        <li><a href="loanpay.php">Pay Loan</a></li>
                        <?php } ?>
                        <li><a href="change.php">Edit Account</a></li>
                    </ul>
                </div>
            </div>

            <div class="btn-group">
                <div class="input-group">
                    <button id="exchangeButton" type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-stats"></span>
                        Exchange
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="exchange.php">Place Order</a></li>
                        <li><a href="orders.php">Orders</a></li>
                        <li><a href="trades.php">Trades</a></li>
                        <li><a href="history.php">History</a></li>
                        <li><a href="assets.php">Assets</a></li>
                        <li><a href="information.php">Information</a></li>


                    </ul>
                </div>
            </div>
            <?php if ($_SESSION["id"] == $adminid) { //ADMIN MENU FOR ADMIN?>

                <div class="btn-group">
                    <div class="input-group">
                        <button id="adminButton" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-star"></span>
                            Admin
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="admin_deposit.php">Deposit </a></li>
                            <li><a href="admin_withdraw.php">Withdraw </a></li>
                            <li><a href="admin_users.php">Users </a></li>
                            <li><a href="admin_offering.php">Offering </a></li>
                            <li><a href="admin_update.php">Update </a></li>
                            <li><a href="_admin.php">Test</a></li>
                            
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <div class="btn-group">
                <div class="input-group">
                    <a href="logout.php"><button type="button" class="btn btn-danger  btn-sm ">
                            <span class="glyphicon glyphicon-off"></span>
                            Log Out</button></a>
                </div>
            </div>


        </div><!--btn-group-->
    </div><!--navigationBar-->






</div> <!--top-->
<div id="middle" style="text-align:center"> <!--placing it here it only shows up when logged on so no box on login screen-->




<table class="table table-condensed" style="margin-bottom:0; text-align: left;">
    <tr>
        <td style="width:25%;"><strong>Name:  </strong><?php echo($username) ?></td>
        <td style="width:25%;"><strong>ID:  </strong><?php echo($userid) ?></td>
        <td style="width:25%;"><strong>Email: </strong><?php echo($email) ?></td>
        <td style="width:25%; text-align:right;"><strong>Time: </strong><?php echo date("Y-m-d H:i:s"); ?></td>
    </tr>
</table>
<?php

//} //bracket for the show on log in argument //



//var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)







// configuration
//require("../includes/config.php");
$SBallAssets =	query("SELECT symbol, issued FROM assets ORDER BY symbol ASC");

$SBassets = []; //to send to next page

$SBindexMarketCap = 0;
$SBindexValue = 0;
foreach ($SBallAssets as $SBrow)		// for each of user's stocks
{
    $SBasset = [];
    $SBasset["symbol"] = $SBrow["symbol"]; //set variable from stock info
    $SBasset["issued"] = $SBrow["issued"]; //set variable from stock info

    $SBtrades = query("SELECT price FROM trades WHERE symbol = ? ORDER BY uid DESC LIMIT 0, 1", $SBasset["symbol"]);	  // query user's portfolio
    if(empty($SBtrades[0]["price"])){$SBtrades[0]["price"]=0;}
    $SBasset["price"] = $SBtrades[0]["price"]; //stock price per share
    $SBasset["marketcap"] = ($SBasset["price"] * $SBasset["issued"]);
    $SBindexMarketCap = $SBindexMarketCap+$SBasset["marketcap"];
    $SBindexValue = $SBindexValue+$SBasset["price"];
    $SBassets[] = $SBasset;
}
//apologize(var_dump(get_defined_vars()));


?>



















    <?php //BANNER 1 ?>

    <style type="text/css"><!--
        #marqueeborder {
            color: #000;
            background-color: transparent;
            font-family:"Lucida Console", Monaco, monospace;
            position:relative;
            height:20px;
            overflow:hidden;
            font-size: 0.8em;
        }
        #marqueecontent {
            position:absolute;
            left:0px;
            line-height:20px;
            white-space:nowrap;
        }
        .stockbox {
            margin:0 20px; /*top, right, bottom, left */
        }
        .stockbox a {
            color: #ccc;
            text-decoration : underline;
        }
        --></style>

    <script type="text/javascript">

        // Original script by Walter Heitman Jr, first published on http://techblog.shanock.com

        // Set an initial scroll speed. This equates to the number of pixels shifted per tick
        var scrollspeed=2;
        var pxptick=scrollspeed;

        function startmarquee(){
            // Make a shortcut referencing our div with the content we want to scroll
            marqueediv=document.getElementById("marqueecontent");
            // Get the total width of our available scroll area
            marqueewidth=document.getElementById("marqueeborder").offsetWidth;
            // Get the width of the content we want to scroll
            contentwidth=marqueediv.offsetWidth;
            // Start the ticker at 50 milliseconds per tick, adjust this to suit your preferences
            // Be warned, setting this lower has heavy impact on client-side CPU usage. Be gentle.
            lefttime=setInterval("scrollmarquee()",20);
        }

        function scrollmarquee(){
            // Check position of the div, then shift it left by the set amount of pixels.
            if (parseInt(marqueediv.style.left)>(contentwidth*(-1)))
                marqueediv.style.left=parseInt(marqueediv.style.left)-pxptick+"px";
            // If it's at the end, move it back to the right.
            else
                marqueediv.style.left=parseInt(marqueewidth)+"px";
        }

        window.onload=startmarquee;

    </script>

    <div id="marqueeborder" onmouseover="pxptick=0" onmouseout="pxptick=scrollspeed">
        <div id="marqueecontent">


            <?php //echo($sitename);
            //MARKET INDEX
            echo('<span class="stockbox">');
            //echo("INDEX MARKET CAP.&nbsp;");echo($unitsymbol . number_format($SBindexMarketCap, 2, ".", ",")); 
            echo("INDEX&nbsp;");
            echo($unitsymbol . number_format($SBindexValue, 2, ".", ",")); // number_format($SBindexMarketCap, 0, ".", ","));
            //CHANGE AND ARROWS
            //$change=(mt_rand(1,200)/100);
            //$posneg=(mt_rand(1,2));
            //if($posneg==1)  {echo('<span style="color: #009900;"> &#x25B2; ' . $change . '</span></span>');}
            //else            {echo('<span style="color: #ff0000;"> &#x25BC; ' . $change . '</span></span>');}

            //EACH SHARE
            foreach ($SBassets as $SBasset)
            {
                echo('<span class="stockbox">');
                echo($SBasset["symbol"] . "&nbsp;");
                echo($unitsymbol . number_format($SBasset["price"], 2, ".", ",")); 
                //CHANGE AND ARROWS
                //$change=(mt_rand(1,200)/100);
                //$posneg=(mt_rand(1,2));
                //if($posneg==1)  {echo('<span style="color: #009900;"> &#x25B2; ' . $change . '</span></span>');} //up
                //else            {echo('<span style="color: #ff0000;"> &#x25BC; ' . $change . '</span></span>');}//down
            }
            ?>

        </div>
    </div>














<?php } //bracket for the show on log in argument
?>
