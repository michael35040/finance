<?php




?>

<!-- Body of web page goes inside container tags -->
<!-- Obtain the latest version of jquery from CDN -->
<script>
    $(document).ready(function() {
        // When the button is clicked..
        $("#btnShowHide1").click(function(){
            // Use JQuery to toggle a Bootstrap "well" div
            $("#showMe1").toggle();
            // Toggle button text based on its current contents
            $(this).text(function(i, text){
                return text === "Show" ? "Hide" : "Show";
            })
            return false;
        })
    });
    $(document).ready(function() {
        // When the button is clicked..
        $("#btnShowHide2").click(function(){
            // Use JQuery to toggle a Bootstrap "well" div
            $("#showMe2").toggle();
            // Toggle button text based on its current contents
            $(this).text(function(i, text){
                return text === "Show" ? "Hide" : "Show";
            })
            return false;
        })
    });
    $(document).ready(function() {
        // When the button is clicked..
        $("#btnShowHide3").click(function(){
            // Use JQuery to toggle a Bootstrap "well" div
            $("#showMe3").toggle();
            // Toggle button text based on its current contents
            $(this).text(function(i, text){
                return text === "Show" ? "Hide" : "Show";
            })
            return false;
        })
    });
    $(document).ready(function() {
        // When the button is clicked..
        $("#btnShowHide4").click(function(){
            // Use JQuery to toggle a Bootstrap "well" div
            $("#showMe4").toggle();
            // Toggle button text based on its current contents
            $(this).text(function(i, text){
                return text === "Show" ? "Hide" : "Show";
            })
            return false;
        })
    });
</script>
<style>
    #middle
    {
        background-color:transparent;
        border:0;
        text-shadow: 2px 2px 5px #fff;
    }
    .status table
    {
    }
    .status td
    {
        text-align:left;
        border: 1px solid black;
        padding: 5px;
    }
</style>
<form action="">
    <table class="status">
        <tr>
            <td colspan="2"><strong><?php echo($_SESSION['email'] . " (" . $_SESSION['id'] . ")"); ?></strong></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="register" value="true" disabled checked>&nbsp;&nbsp;&nbsp;<b>Register</b></td>
            <td>
                <div class="container" style="text-align:left;background-color:white;width:500px;">
                    <div id="showMe1" class="well" style="display: none;">
                        Register an account.
                    </div>
                    <div class="form-group">
                        <a id="btnShowHide1" class="btn btn-xs btn-success" href="#" role="button">Show</a>
                    </div>
                </div><!--container-->
            </td>
        </tr>

        <tr>
            <td><input type="checkbox" name="activate" value="true" disabled >&nbsp;&nbsp;&nbsp;<b>Activate</b></td>
            <td>
                <div class="container" style="text-align:left;background-color:white;width:500px;">
                    <div id="showMe2" class="well" style="display: none;">
                        Your account requires activation. An administrator will verify your information and activate your account within 72 hours.
                    </div>
                    <div class="form-group">
                        <a id="btnShowHide2" class="btn btn-xs btn-success" href="#" role="button">Show</a>
                    </div>
                </div><!--container-->

            </td>
        </tr>

        <tr>
            <td><input type="checkbox" name="fund" value="true" disabled >&nbsp;&nbsp;&nbsp;<b>Fund</b></td>
            <td>
                <div class="container" style="text-align:left;background-color:white;width:500px;">
                    <div id="showMe3" class="well" style="display: none;">
                        Before you begin buying and selling on the exchange you will need to fund your account. Please be sure to read and understand the specifics of each account funding option before making the choice that works best for you. Certain methods of funding your account require longer processing times. We have three methods available for depositing funds: Wire Transfer, ACH Transfer, and Check. Due to the non-immediate nature of debit and credit account transfers, as well as the commissions attached to debit and credit of transactions, we only offer trades to accounts funded by the methods listed.
                        Here are the full details on how to add funds to your account, and our customer service team is available to help if you have any questions.<br>
                        <br>
                        There are three account funding options available:<br>
                        <ul>
                            <li>
                                <b>Wire Transfer</b> is the fastest method for funding your account. Wire transfers generally execute the same day, but may take up to one additional business day to post to your account. Your bank may charge a wire fee.
                            </li>
                            <li>
                                <b>ACH (Automated Clearing House) Transfer</b> generally take two to three business days to post to your account. However, the fees to send this type of transfer are normally more affordable than wire fees.
                            </li>
                            <li>
                                <b>Check</b> is the slowest method of funding your account, but also the least expensive. A bank check takes up to 14 business days to post to your account after it is received and processed.
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <a id="btnShowHide3" class="btn btn-xs btn-success" href="#" role="button">Show</a>
                    </div>
                </div><!--container-->


            </td>
        </tr>

        <tr>
            <td><input type="checkbox" name="trade" value="true" disabled >&nbsp;&nbsp;&nbsp;<b>Trade</b></td>
            <td>

                <div class="container" style="text-align:left;background-color:white;width:500px;">
                    <div id="showMe4" class="well" style="display: none;">
                        Make your first trade.
                    </div>
                    <div class="form-group">
                        <a id="btnShowHide4" class="btn btn-xs btn-success" href="#" role="button">Show</a>
                    </div>
                </div><!--container-->
            </td>
        </tr>


        <?php
        //ONLY SHOW LOG OUT BUTTON IF ACCOUNT IS NOT ACTIVATED SINCE MENU IS NOT SHOWN
        $users = query("SELECT active FROM users WHERE id = ?", $_SESSION["id"]);
        @$active = $users[0]["active"];
        if($active!=1)//session_destroy();
        { ?>        <tr>
            <td colspan="2" style="text-align:center;background-color: transparent;border:0;">
                <div class="btn-group">
                    <div class="input-group">
                        <a href="logout.php"><button type="button" class="btn btn-danger  btn-sm ">
                                <span class="glyphicon glyphicon-off"></span>
                                Log Out</button></a>
                    </div>
                </div>
            </td>
        </tr>
            <br> <br>
        <?php } ?>




</form>
<br><br>

















