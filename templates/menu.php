
    <div class="navigationBar" align="right">
        <div class="btn-group">

            <div class="btn-group">
                <div class="input-group">
                    <button id="bankButton" type="button" class="btn btn-default  btn-sm   dropdown-toggle" data-toggle="dropdown">
                        <b>MENU</b>
                    <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="order.php">EXCHANGE</a></li>
                        <li><a href="orders.php">ORDERS</a></li>
                        <li><a href="trades.php">TRADES</a></li>
                        <!--<li><a href="status.php">Status</a></li>-->
                        <li><a href="portfolio.php">PORTFOLIO</a></li>
                        <li><a href="assets.php">ASSETS</a></li>
                        <li><a href="information.php">INFORMATION</a></li>
                        <li><a href="history.php">HISTORY</a></li>
                        <li><a href="update.php">UPDATE</a></li>
                        <!--<li><a href="order2.php">Order 2</a></li>-->
                        <!--<li><a href="transfer.php">Transfer </a></li><li><a href="loan.php">Loan</a></li><?php //if ($loan < 0) { //-0.00000001 ?><li><a href="loanpay.php">Pay Loan</a></li> --><?php //} ?>
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
                    <a href="logout.php">
                        <button type="button" class="btn btn-danger  btn-sm ">
                        <b>EXIT</b>
                        <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </a>
                </div>
            </div>




        </div><!--btn-group-->
    </div><!--navigationBar-->


