
    <div class="navigationBar" align="right">
        <div class="btn-group">

            <div class="btn-group">
                <div class="input-group">
                    <button id="bankButton" type="button" class="btn btn-default  btn-sm   dropdown-toggle" data-toggle="dropdown">
                        <b>MENU</b>
                    <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="account.php">ACCOUNT</a></li>
                        <li><a href="assets.php">ASSETS</a></li>
                        <li><a href="exchange-convert.php">EXCHANGE</a></li>
                        <!--<li><a href="exchange-advance.php">ADVANCE</a></li>-->
                        <!--<li><a href="exchange-quick.php">X-QUICK</a></li>-->
                        <li><a href="orders.php">ORDERS</a></li>
                        <li><a href="trades.php">TRADES</a></li>
                        <li><a href="status.php">STATUS</a></li>
                        <li><a href="information.php">INFORMATION</a></li>
                        <li><a href="history.php">HISTORY</a></li>
                        <li><a href="update.php">UPDATE</a></li>
                        <li><a href="transparency.php">Transparency</a></li>
                        <li><a href="storage.php">Storage</a></li>
                        <!--<li><a href="transfer.php">Transfer </a></li><li><a href="loan.php">Loan</a></li><?php //if ($loan < 0) { //-0.00000001 ?><li><a href="loanpay.php">Pay Loan</a></li> --><?php //} ?>
                    </ul>
                </div>
            </div>


            <?php if ($_SESSION["id"] == $adminid) { //ADMIN MENU FOR ADMIN?>

                <div class="btn-group">
                    <div class="input-group">
                        <button id="adminButton" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            <!--<span class="glyphicon glyphicon-home"></span>&nbsp;-->
                             <b>ADMIN</b>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="admin.php">Dashboard</a></li>
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


