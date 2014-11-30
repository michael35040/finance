
    <div class="navigationBar" align="right">
        <div class="btn-group">

            <div class="btn-group">
                <div class="input-group">
                    <button id="bankButton" type="button" class="btn btn-default  btn-sm   dropdown-toggle" data-toggle="dropdown">
                        BANKING
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="history.php">History</a></li>
                        <li><a href="update.php">Update</a></li>
                        <li><a href="status.php">Status</a></li>
                        <li><a href="assets.php">Assets</a></li>
                        <li><a href="information.php">Information</a></li>

                        <!--<li><a href="transfer.php">Transfer </a></li><li><a href="loan.php">Loan</a></li><?php //if ($loan < 0) { //-0.00000001 ?><li><a href="loanpay.php">Pay Loan</a></li> --><?php //} ?>
                    </ul>
                </div>
            </div>


            <div class="btn-group">
                <div class="input-group">
                    <button id="exchangeButton" type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown">
                        EXCHANGE
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="order.php">Order</a></li>
                        <li><a href="order2.php">Order 2</a></li>
                        <li><a href="orders.php">Orders</a></li>
                        <li><a href="trades.php">Trades</a></li>

                    </ul>
                </div>
            </div>


            <?php if ($_SESSION["id"] == $adminid) { //ADMIN MENU FOR ADMIN?>

                <div class="btn-group">
                    <div class="input-group">
                        <button id="adminButton" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            <!--<span class="glyphicon glyphicon-home"></span>&nbsp;-->
                             ADMIN
                            <!--<span class="caret"></span>-->
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="admin.php">Dashboard</a></li>
                            <li><a href="admin_activate.php">Activate </a></li>
                            <li><a href="admin_users.php">Users </a></li>
                            <li><a href="admin_offering.php">Offering </a></li>
                            <li><a href="admin_update.php">Update </a></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <div class="btn-group">
                <div class="input-group">
                    <a href="logout.php"><button type="button" class="btn btn-danger  btn-sm ">LOG OUT</button></a>
                </div>
            </div>




        </div><!--btn-group-->
    </div><!--navigationBar-->


