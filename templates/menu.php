
    <div class="navigationBar" align="right">
        <div class="btn-group">

            <div class="btn-group">
                <div class="input-group">
                    <button id="bankButton" type="button" class="btn btn-default  btn-sm   dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-home"></span>
                        &nbsp; HOME &nbsp;
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="accounts.php">Accounts</a></li>
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="transfer.php">Transfer</a></li>
                        <li><a href="history.php">History</a></li>
                        <li><a href="update.php">Update</a></li>
                        <!--<li><a href="transfer.php">Transfer </a></li><li><a href="loan.php">Loan</a></li><?php //if ($loan < 0) { //-0.00000001 ?><li><a href="loanpay.php">Pay Loan</a></li> --><?php //} ?>
                    </ul>
                </div>
            </div>

            <div class="btn-group">
                <div class="input-group">
                    <button id="exchangeButton" type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-stats"></span>
                        &nbsp; EXCHANGE &nbsp;
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="order2.php">Order (Quick)</a></li>
                        <li><a href="order.php">Order</a></li>
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
                            &nbsp; ADMIN &nbsp;
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
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <div class="btn-group">
                <div class="input-group">
                    <a href="logout.php"><button type="button" class="btn btn-danger  btn-sm ">
                            <span class="glyphicon glyphicon-off"></span>
                            &nbsp; LOG OUT &nbsp;</button></a>
                </div>
            </div>




        </div><!--btn-group-->
    </div><!--navigationBar-->


