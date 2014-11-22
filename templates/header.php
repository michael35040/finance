<!DOCTYPE html>
<html lang="en">
<style>

    .sitelogo
    {
        margin-top:10px;
        margin-left: auto;
        margin-right: auto;
        text-align:center;
        width:100%;
    }
    .sitelogo td
    {
        background-color:transparent;
        width:33%;
    }
    .sitenamefont {
        font-family: Roboto, Helvetica, sans-serif;
        font-size:xx-large;
        text-shadow: 1px 1px 5px #000;
        /*
        font-family:Georgia, "Times New Roman", Times, serif;
        font-size: 15px;
        */
    }
    .titlefont {
        font-family: Roboto, Helvetica, sans-serif;
        font-size:xx-large;
        text-shadow: 1px 1px 5px #000;
        text-align:right;
    }
    .navigationBar .btn-default
    {
        color: #444;
        background-color: #ffffff; /*#d1d1d1;*/
        border-color: #f8f8f8;
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






    <table class="sitelogo">
        <tr>
            <td>
                <div class="sitenamefont" align="left">
                    <?php echo(htmlspecialchars($sitename)); ?>
                <img src="img/logo/<?php //echo($ranimg); ?>1.png" width="24" style="vertical-align:middle;" />&nbsp;
                </div><!--sitenamefont-->
            </td>
       <!-- </tr>
        <tr>  -->

       <!-- </tr> <tr>-->
            <td>
                <div align="right">

    <!-- Menu in style.css -->
    <?php
    //SHOW ON LOG IN ARGUMENT FOR MENU AND INFORMATION
    if (isset($_SESSION["id"]))
    {
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
        @$approved = $accounts[0]['approved'];	//convert array from query to value
        //0 approved
        //1 unapproved
        //2 pending - not yet implemented

        include("menu.php");

    } //if active==1
    ?>







</div> <!--top-->



<?php
//var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
//include("banner.php");
 } //bracket for the show on log in argument
?>

        </div>
    </td>
    <td>
        <div class="titlefont">
            <?php if (isset($title))
            { echo("" . htmlspecialchars($title) . "");
            } ?>
        </div><!--titlefont-->
    </td>
    </tr>
    </table>

    <?php
    if (isset($_SESSION["id"]))
    {
?>

    <div id="middle" style="text-align:center"> <!--placing it here it only shows up when logged on so no box on login screen-->
<?php  } //bracket for the show on log in argument
?>