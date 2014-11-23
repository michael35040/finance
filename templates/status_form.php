<?php




?>

<style>
    .status table
    {
    }
    .status td
    {
        text-align:left;
        border: 1px solid black;
        padding: 20px;
    }
</style>
<h3>Account Status</h3>
<form action="">
    <table class="status">

        <tr>
            <td><input type="checkbox" name="register" value="true" disabled checked>&nbsp;&nbsp;&nbsp;<b>Register</b></td>
            <td>You have successfully registered</td>
        </tr>

        <tr>
            <td><input type="checkbox" name="activate" value="true" disabled >&nbsp;&nbsp;&nbsp;<b>Activate</b></td>
            <td>Account requires activation</td>
        </tr>

        <tr>
            <td><input type="checkbox" name="fund" value="true" disabled >&nbsp;&nbsp;&nbsp;<b>Fund</b></td>
            <td>Choose one of three ways to fund your account</td>
        </tr>

        <tr>
            <td><input type="checkbox" name="trade" value="true" disabled >&nbsp;&nbsp;&nbsp;<b>Trade</b></td>
            <td>Make your first trade</td>
        </tr>


    </table>

</form>
<br><br>

<?php
//ONLY SHOW LOG OUT BUTTON IF ACCOUNT IS NOT ACTIVATED SINCE MENU IS NOT SHOWN
$users = query("SELECT active FROM users WHERE id = ?", $_SESSION["id"]);
@$active = $users[0]["active"];
if($active!=1)//session_destroy();
{ ?>

    <div class="btn-group">
        <div class="input-group">
            <a href="logout.php"><button type="button" class="btn btn-danger  btn-sm ">
                    <span class="glyphicon glyphicon-off"></span>
                    Log Out</button></a>
        </div>
    </div>
    <br> <br>

<?php } ?>





