<style>
    #middle
    {
        background-color:transparent;
        border:0;
        text-shadow: 2px 2px 5px #fff;
    }
    .changeForm {
        text-shadow: 2px 2px 5px #fff;
        display: inline-block;
        text-align: center;
        width:25%;
        padding: 0px;
        position:relative;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<?php
$email = $userinfo[0]["email"];
$phone = $userinfo[0]["phone"];
?>


<form action="update.php"  class="changeForm" name="change_form" method="post">
    <fieldset>
        <h3>Update Account Information</h3>

        <div class="control-group">

            <div id="emailMenu" style="opacity:1;">
                <span class="input-group-addon">
                    <INPUT TYPE="radio" NAME="change" VALUE="email" id="emailRadio" required/>
                    <span class="glyphicon glyphicon-envelope"></span> New Email</span>
                <input class="form-control" id="emailInput" name="email" value="<?php echo(htmlspecialchars($email)); ?>" type="email" maxlength="31" />
            </div><!--menuEmail-->

            <div id="phoneMenu" style="opacity:1;">
                <span class="input-group-addon">
                    <INPUT TYPE="radio" NAME="change" VALUE="phone" id="phoneRadio" required/>
                    <span class="glyphicon glyphicon-earphone"></span> New Phone</span>
                <input class="form-control" id="phoneInput" name="phone" value="<?php echo(htmlspecialchars($phone)); ?>" type="tel" maxlength="20" />
            </div><!--menuPhone-->

            <div id="newpasswordMenu" style="opacity:1;">
                <span class="input-group-addon">
                    <INPUT TYPE="radio" NAME="change" VALUE="newpassword" id="newpasswordRadio" required>
                    <span class="glyphicon glyphicon-lock"></span> New Password
                </span>
                <input class="form-control"  id="newpasswordInput" name="password" placeholder="Password" type="password" maxlength="31" />
            </div><!--menuPassword-->

            <span class="input-group-addon">
                <div id="confirmationText"><span class="glyphicon glyphicon-star"></span> Re-type Confirmation</div>
            </span>
            <input class="form-control"  id="confirmation" name="confirmation" placeholder="Confirmation" type="text" maxlength="31" required/>

            <span class="input-group-addon">
                <span class="glyphicon glyphicon-lock"></span> Current Password</span>
            <input class="form-control"  id="password" name="password" placeholder="Password" type="password" maxlength="31" required/>

            <BR>
            <button type="reset" id="clear" class="btn btn-primary">CLEAR</button>
            <button type="submit" class="btn btn-danger">SUBMIT</button>
            <br>  <br>
        </div><!--control Group-->


    </fieldset>
</form>


<script>
    //EMAIL
    document.getElementById("emailRadio").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 1; //1 visible //0 invisible
        document.getElementById("phoneRadio").disabled = true;
        document.getElementById("phoneInput").disabled = true;
        document.getElementById('phoneInput').value='';

        document.getElementById("newpasswordMenu").style.opacity = 1;
        document.getElementById("newpasswordRadio").disabled = true;
        document.getElementById("newpasswordInput").disabled = true;
        document.getElementById('newpasswordInput').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-envelope"></span> Re-type New Email';
    }, false);

    //PHONE    
    document.getElementById("phoneRadio").addEventListener("click", function () {
        document.getElementById("emailMenu").style.opacity = 1;
        document.getElementById("emailRadio").disabled = true;
        document.getElementById("emailInput").disabled = true;
        document.getElementById('emailInput').value='';

        document.getElementById("newpasswordMenu").style.opacity = 1;
        document.getElementById("newpasswordRadio").disabled = true;
        document.getElementById("newpasswordInput").disabled = true;
        document.getElementById('newpasswordInput').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-earphone"></span> Re-type New Phone';
    }, false);

    //PASSWORD    
    document.getElementById("newpasswordRadio").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 1;
        document.getElementById("phoneRadio").disabled = true;
        document.getElementById("phoneInput").disabled = true;
        document.getElementById('phoneInput').value='';

        document.getElementById("emailMenu").style.opacity = 1;
        document.getElementById("emailRadio").disabled = true;
        document.getElementById("emailInput").disabled = true;
        document.getElementById('emailInput').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-lock"></span> Re-type New Password';
    }, false);


    //CLEAR    
    document.getElementById("clear").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 1; //reset to 1
        document.getElementById("phoneRadio").disabled = false;
        document.getElementById("phoneInput").disabled = false;
        document.getElementById('phoneInput').value='';

        document.getElementById("newpasswordMenu").style.opacity = 1; //reset to 1
        document.getElementById("newpasswordRadio").disabled = false;
        document.getElementById("newpasswordInput").disabled = false;
        document.getElementById('newpasswordInput').value='';

        document.getElementById("emailMenu").style.opacity = 1; //reset to 1
        document.getElementById("emailRadio").disabled = false;
        document.getElementById("emailInput").disabled = false;
        document.getElementById('emailInput').value='';

        document.getElementById("phoneRadio").checked = false;
        document.getElementById("newpasswordRadio").checked = false;
        document.getElementById("emailRadio").checked = false;
        document.getElementById("usernameRadio").checked = false;

        document.getElementById('confirmation').value='';
        document.getElementById('password').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-star"></span> Re-type Confirmation';
    }, false);

</script>
