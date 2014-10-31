<!DOCTYPE html>
<html>
<head>
    <?php require("../includes/constants.php"); //global finance constants
    ?>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script>

    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
    <link href="css/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet"/><!--extra icons-->
    <link href="css/styles.php" rel="stylesheet" media="screen"/>

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




        <style>
            .sitenamefont {
                font-family:Arial;
                font-family:Georgia, "Times New Roman", Times, serif;
                font-size:xx-large;
                padding-top:10px;
            }
            .titlefont {
                font-family:Arial, Helvetica, sans-serif;
                font-size:large;
                padding-top:10px;
            }

            .table {margin-bottom:0;} /*set to 20 in bootstrap*/

        </style>


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

        <ul id="nav" align="left">

            <li><a href="index.php"><i class="fa fa-bank"></i> Bank</a>
                <ul class="mainmenu">
                    <li><a href="index.php">Accounts</a></li>
                    <li><a href="history.php">History</a></li>
                    <li><a href="transfer.php">Transfer </a></li><!--<i class="icon-gift"></i>-->
                    <li><a href="loan.php">Loan</a><?php if ($loan < 0) { //-0.00000001 ?>
                            <ol>
                                <li><a href="loanpay.php">Pay</a></li>
                            </ol>
                        <?php } ?>
                    </li>

                    <li><a href="change.php">Edit</a>


                </ul>
            </li>

            <li><a href="exchange.php"><i class="fa fa-line-chart"></i> Exchange</a>
                <ul class="mainmenu">
                    <li><a href="exchange.php">Exchange</a></li>
                    <li><a href="information.php">Information</a></li>
                    <li><a href="test.php">Test &#9776; </a>
                        <ul>
                            <li><a href="_process.php">Process</a></li>
                            <li><a href="_clear_all.php">Clear All</a></li>
                            <li><a href="_clear_orderbook.php">Clear Orders</a></li>
                            <li><a href="_clear_trades.php">Clear Trades</a></li>
                            <li><a href="_randomOrders.php">Random Orders</a></li>
                        </ul>
                    </li>

                </ul>
            </li>

            <?php
            //ADMIN MENU FOR ADMIN
            if ($_SESSION["id"] == $adminid)
            {
                ?>
                <li><a href=""><i class="fa fa-star-o"></i> Admin &#9776;</a>
                    <ul class="mainmenu">

                        <li><a href="deposit.php">Deposit <i class="icon-download-alt"></i></a></li>
                        <li><a href="withdraw.php">Withdraw <i class="icon-share"></i></a></li>
                        <li><a href="users.php">Users <i class="icon-search"></i></a></li>
                    </ul>
                </li>
            <?php } ?>

            <li class="current"><a href="logout.php"><i class="icon-off"></i> Log Out</a></li>
        </ul>







    </div> <!--top-->
    <div id="middle" style="text-align:center"> <!--placing it here it only shows up when logged on so no box on login screen-->







        <table class="table" align="right" width="100">
            <tbody>
            <tr>
                <td style="width:30%"><strong>Name:  </strong><?php echo($username) ?></td>
                <td style="width:10%"><strong>ID:  </strong><?php echo($userid) ?></td>
                <td style="width:30%"><strong>Email: </strong><?php echo($email) ?></td>
                <td style="width:20%"><strong>Time: </strong><?php echo date("Y-m-d H:i:s"); ?></td>



            </tr>
            </tbody>
        </table>
        <?php
        }  //bracket for the show on log in argument
        //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
        ?>
