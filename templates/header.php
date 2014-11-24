<!DOCTYPE html>
<html lang="en">
<style>
.logobar
{
    width: 100%;
    /*margin-top:10px;*/
}
    .logobar table {
        display:inline-block;

    }
    .logobar td
    {

        background-color:transparent;
        text-align:left;
        width:50%;
        text-shadow: 1px 1px 2px #fff;
        /*
        font-family: Roboto, Helvetica, sans-serif;
        font-weight: 3;
        vertical-align: text-bottom;
        color: gray;
        font-size: large;
        */

        /*****FOR HEADER LOGO*****/
        color: rgb(102, 111, 119);
        cursor: auto;
        font-family: Roboto, Helvetica, sans-serif;
        font-size: 20px;
        font-stretch: normal;
        font-style: normal;
        font-variant: normal;
        font-weight: 500;
        height: auto;
        letter-spacing: 2px;
        /*line-height: 48px;*/
        margin-bottom: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 0px;
        padding-bottom: 0px;
        padding-left: 0px;
        padding-right: 0px;
        padding-top: 10px;
        text-decoration: none;
        text-transform: uppercase;
        vertical-align: baseline;

    }
    .navigationBar .btn-default
    {
        color: #444;
        background-color: #ffffff; /*#d1d1d1;*/
        /*border-color: #f8f8f8;*/
        border-color: #E8F9FA;
    }
    .table {margin-bottom:0;} /*set to 20 in bootstrap*/
</style>
<head>
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


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script>



    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/styles.php" rel="stylesheet" media="screen"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div id="page" style="text-align:center; ">
    <div id="top" style="text-align:center; ">






            <table class="logobar">
                <tr>
                    <td>
                        <?php echo(htmlspecialchars($sitename)); ?>
                        <img src="img/logo/<?php //echo($ranimg); ?>1.png" width="27" style="vertical-align:middle;" />
                        <?php if(isset($title)){echo("" . htmlspecialchars($title) . "");} ?>
                    </td>



            <!-- Menu in style.css -->
            <?php
            //SHOW ON LOG IN ARGUMENT FOR MENU AND INFORMATION
            if (isset($_SESSION["id"]))
            {?>

                        <td>
                            <?php
                            $users =query("SELECT id, email, active FROM users WHERE id = ?", $_SESSION["id"]);
                            @$userid = $users[0]["id"];
                            @$email = $users[0]["email"];
                            @$active = $users[0]["active"];
                            if($active==1)
                            {
                                // query cash for template
                                $accounts =	query("SELECT units, loan, rate, approved FROM accounts WHERE id = ?", $userid);	 //query db
                                @$units = (float)$accounts[0]["units"];
                                @$loan = (float)$accounts[0]["loan"];
                                @$rate = $accounts[0]["rate"];
                                $rate *= 100; //for display as %
                                @$approved = $accounts[0]['approved'];	//convert array from query to value //0 approved//1 unapproved//2 pending - not yet implemented



                                include("menu.php");

                                //include("banner.php");
                            } //if active==1
                            ?>
                        </td>


            <?php
            } //bracket for the show on log in argument
            //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
            ?>



                </tr>
            </table>


        <?php
        if (isset($_SESSION["id"]))
        {
        ?>
    </div><!--top-->
    <div id="middle" style="text-align:center"> <!--placing it here it only shows up when logged on so no box on login screen-->
<?php  } //bracket for the show on log in argument
?>