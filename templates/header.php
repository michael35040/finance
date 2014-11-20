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
    .sitelogo td
    {
        background-color:transparent; 
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

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>





    <table class="sitelogo" align="center" width="">
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

    if (isset($_SESSION["id"]))
    {
    $users =	query("SELECT userid, email FROM users WHERE id = ?", $_SESSION["id"]);
    @$userid = $users[0]["id"];
    @$email = $users[0]["email"];

    // query cash for template
    $accounts =	query("SELECT units, loan, rate, approved FROM accounts WHERE id = ?", $userid);	 //query db
    @$units = (float)$accounts[0]["units"];
    @$loan = (float)$accounts[0]["loan"];
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
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="history.php">History</a></li>
                        <li><a href="change.php">Edit Account</a></li>
                        <!--<li><a href="transfer.php">Transfer </a></li><li><a href="loan.php">Loan</a></li><?php //if ($loan < 0) { //-0.00000001 ?><li><a href="loanpay.php">Pay Loan</a></li> --><?php //} ?>
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
                        <li><a href="instatrade.php">Instant Trade</a></li>
                        <li><a href="orders.php">Orders</a></li>
                        <li><a href="trades.php">Trades</a></li>
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
                            <li><a href="admin_activate.php">Activate </a></li>
                            <li><a href="admin_users.php">Users </a></li>
                            <li><a href="admin_offering.php">Offering </a></li>
                            <li><a href="admin_update.php">Update </a></li>
                            <li><a href="_admin.php">Test</a></li>
                            <li><a href="ion/index.html">Ion</a></li>
                            <li><a href="admin/index.html">Admin Dash</a></li>

                            
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

//var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
include("banner.php");
 } //bracket for the show on log in argument
?>
