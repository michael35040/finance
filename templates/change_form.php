<style>
    .changeForm {
        text-align: center;
        width: 500px;
        padding: 0px;
        position:relative;
        margin-left: auto;
        margin-right: auto;
    }
</style>


<form action="change.php"  class="changeForm" name="change_form" method="post">
    <fieldset>

        <div class="control-group">

            <div id="usernameMenu" style="opacity:1;">
                <span class="input-group-addon">
                    <INPUT TYPE="radio" NAME="change" VALUE="username" id="usernameRadio" required>
                    <span class="glyphicon glyphicon-user"></span> New Username</span>
                <input class="form-control" id="usernameInput" name="username" placeholder="Username" type="text" maxlength="31"  autofocus required  />
            </div><!--usernameMenu-->

            <div id="emailMenu" style="opacity:1;">
                <span class="input-group-addon">
                    <INPUT TYPE="radio" NAME="change" VALUE="email" id="emailRadio">
                    <span class="glyphicon glyphicon-envelope"></span> New Email</span>
                <input class="form-control" id="emailInput" name="email" placeholder="Email" type="email" maxlength="31" required/>
            </div><!--menuEmail-->

            <div id="phoneMenu" style="opacity:1;">
                <span class="input-group-addon">
                    <INPUT TYPE="radio" NAME="change" VALUE="phone" id="phoneRadio" >
                    <span class="glyphicon glyphicon-earphone"></span> New Phone</span>
                <input class="form-control" id="phoneInput" name="phone" placeholder="Phone" type="tel" maxlength="20" required/>
            </div><!--menuPhone-->

            <div id="newpasswordMenu" style="opacity:1;">
                <span class="input-group-addon">
                    <INPUT TYPE="radio" NAME="change" VALUE="newpassword" id="newpasswordRadio" required>
                    <span class="glyphicon glyphicon-lock"></span> New Password
                </span>
                <input class="form-control"  id="newpasswordInput" name="password" placeholder="Password" type="password" maxlength="31" required/>
            </div><!--menuPassword-->

            <span class="input-group-addon">
                <div id="confirmationText"><span class="glyphicon glyphicon-star"></span> Re-type Confirmation</div>
            </span>
            <input class="form-control"  id="confirmation" name="confirmation" placeholder="Confirmation" type="text" maxlength="31" required/>

            <span class="input-group-addon">
                <span class="glyphicon glyphicon-lock"></span> Current Password</span>
            <input class="form-control"  id="password" name="password" placeholder="Password" type="password" maxlength="31" required/>

            <BR>
            <button id="clear" class="btn btn-primary">CLEAR</button>
            <button type="reset" class="btn btn-danger">SUBMIT</button>
            <br>  <br>
        </div><!--control Group-->


    </fieldset>
</form>


<script>
    //EMAIL
    document.getElementById("emailRadio").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 0;
        document.getElementById("phoneRadio").disabled = true;
        document.getElementById('phoneInput').value='';

        document.getElementById("newpasswordMenu").style.opacity = 0;
        document.getElementById("newpasswordRadio").disabled = true;
        document.getElementById('newpasswordInput').value='';

        document.getElementById("usernameMenu").style.opacity = 0;
        document.getElementById("usernameRadio").disabled = true;
        document.getElementById('usernameInput').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-envelope"></span> Email';
    }, false);

    //PHONE    
    document.getElementById("phoneRadio").addEventListener("click", function () {
        document.getElementById("emailMenu").style.opacity = 0;
        document.getElementById("emailRadio").disabled = true;
        document.getElementById('emailInput').value='';

        document.getElementById("newpasswordMenu").style.opacity = 0;
        document.getElementById("newpasswordRadio").disabled = true;
        document.getElementById('newpasswordInput').value='';

        document.getElementById("usernameMenu").style.opacity = 0;
        document.getElementById("usernameRadio").disabled = true;
        document.getElementById('usernameInput').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-earphone"></span> Re-type Phone';
    }, false);

    //PASSWORD    
    document.getElementById("newpasswordRadio").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 0;
        document.getElementById("phoneRadio").disabled = true;
        document.getElementById('phoneInput').value='';

        document.getElementById("emailMenu").style.opacity = 0;
        document.getElementById("emailRadio").disabled = true;
        document.getElementById('emailInput').value='';

        document.getElementById("usernameMenu").style.opacity = 0;
        document.getElementById("usernameRadio").disabled = true;
        document.getElementById('usernameInput').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-lock"></span> Re-type New Password';
    }, false);

    //USERNAME    
    document.getElementById("usernameRadio").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 0;
        document.getElementById("phoneRadio").disabled = true;
        document.getElementById('phoneInput').value='';

        document.getElementById("newpasswordMenu").style.opacity = 0;
        document.getElementById("newpasswordRadio").disabled = true;
        document.getElementById('newpasswordInput').value='';

        document.getElementById("emailMenu").style.opacity = 0;
        document.getElementById("emailRadio").disabled = true;
        document.getElementById('emailInput').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-user"></span> Re-type New Username';
    }, false);

    //CLEAR    
    document.getElementById("clear").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 1;
        document.getElementById("phoneRadio").disabled = false;
        document.getElementById('phoneInput').value='';

        document.getElementById("newpasswordMenu").style.opacity = 1;
        document.getElementById("newpasswordRadio").disabled = false;
        document.getElementById('newpasswordInput').value='';

        document.getElementById("emailMenu").style.opacity = 1;
        document.getElementById("emailRadio").disabled = false;
        document.getElementById('emailInput').value='';

        document.getElementById("usernameMenu").style.opacity = 1;
        document.getElementById("usernameRadio").disabled = false;
        document.getElementById('usernameInput').value='';

        document.getElementById("phoneRadio").checked = false;
        document.getElementById("newpasswordRadio").checked = false;
        document.getElementById("emailRadio").checked = false;
        document.getElementById("usernameRadio").checked = false;

        document.getElementById('confirmation').value='';
        document.getElementById('password').value='';

        document.getElementById('confirmationText').innerHTML = '<span class="glyphicon glyphicon-star"></span> Re-type Confirmation';
    }, false);

</script>
