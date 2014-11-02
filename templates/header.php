<!DOCTYPE html>
<html lang="en">

<style>
    .sitenamefont {
        font-family:Arial;
        font-family:Georgia, "Times New Roman", Times, serif;
        font-size:xx-large;
        padding-top:10px;
        text-shadow: 1px 1px #000;
    }
    .titlefont {
        font-family:Arial, Helvetica, sans-serif;
        font-size:large;
        padding-top:10px;
        text-shadow: 1px 1px #000;
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
    <link href="css/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet"/><!--extra icons-->
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
        <link rel="shortcut icon" href="..includes/<?php //echo($ranimg); ?>1.ico" />






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
        if (!empty($_SESSION["id"]))
        {
        if (!isset($_SESSION["id"])) { logout(); } //if not set due to error, logout,
        $users =	query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        @$userid = $users[0]["id"];
        @$email = $users[0]["email"];
        @$username = $users[0]["username"];
        // query cash for template
        $accounts =	query("SELECT * FROM accounts WHERE id = ?", $_SESSION["id"]);	 //query db
        @$units = $accounts[0]["units"];
        @$locked = $accounts[0]["locked"];
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
                    Bank
                    <span class="caret"></span>
                </button>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="index.php">Accounts</a></li>
                    <li><a href="history.php">History</a></li>
                    <li><a href="transfer.php">Transfer </a></li><!--<i class="icon-gift"></i>-->
                    <li><a href="loan.php">Loan</a>
                    <?php if ($loan < 0) { //-0.00000001 ?>
                    <li><a href="loanpay.php">Pay Loan</a></li>
                    <?php } ?></li>
                    <li><a href="change.php">Edit Account</a>
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
                    <li><a href="information.php">Information</a></li>

                </ul>
                </div>
            </div>
            <?php if ($_SESSION["id"] == $adminid) { //ADMIN MENU FOR ADMIN?>

            <div class="btn-group">
                <div class="input-group">
                <button id="testButton" type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-cog"></span>
                        Test
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="test.php">Create Orders</a></li>
                    <li><a href="_process.php">Process Orderbook</a></li>
                    <li><a href="_clear_all.php">Clear All</a></li>
                    <li><a href="_clear_orderbook.php">Clear Orders</a></li>
                    <li><a href="_clear_trades.php">Clear Trades</a></li>

                </ul>
                </div>
            </div>

            <div class="btn-group">
                <div class="input-group">
                <button id="adminButton" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-star"></span>
                        Admin
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="deposit.php">Deposit <i class="icon-download-alt"></i></a></li>
                    <li><a href="withdraw.php">Withdraw <i class="icon-share"></i></a></li>
                    <li><a href="users.php">Users <i class="icon-search"></i></a></li>
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




        <table class="table" align="right" width="100">
            <tr>
                <td style="width:30%"><strong>Name:  </strong><?php echo($username) ?></td>
                <td style="width:10%"><strong>ID:  </strong><?php echo($userid) ?></td>
                <td style="width:30%"><strong>Email: </strong><?php echo($email) ?></td>
                <td style="width:20%"><strong>Time: </strong><?php echo date("Y-m-d H:i:s"); ?></td>



            </tr>
        </table>
        <?php
        }  //bracket for the show on log in argument
        //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
        ?>



