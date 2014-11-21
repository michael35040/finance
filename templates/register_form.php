<style>
    a:link {color:white;}      /* unvisited link */
    a:visited {color:white;}  /* visited link */
    a:hover {color:white;}  /* mouse over link */
    a:active {color:white;}  /* selected link */

    /*top, right, bottom, left */
    #reg {
        /*
        background-color: transparent;
        border:5px solid #cccccc;
        margin-bottom: 10px;
        opacity:.96;
        padding: 5px 5% 0px 5%;
        min-height: 94%;
        max-heigh: 94%;
        align: center;
        width: auto;
        margin: 0 auto;
        font-weight:bold;
        width: 50%;
        color:black;
        left: 0;
        right: 0;
        position: relative;
        overflow:auto;
        display:block;
        height: auto;
        font: bold normal 1em/2em Arial, Helvetica, sans-serif;
        text-shadow: 0px 0px 0px black; /* FF3.5+, Opera 9+, Saf1+, Chrome, IE10

        */


    }
</style>

<h2 class="form-signin-heading" style="text-shadow: 1px 1px 5px #000;">Please register</h2>
<h4 style="text-shadow: 1px 1px 5px #000;">After registration, account requires activation.</h4>
<div class="container">
<form id="reg" action="register.php" method="post">
    <fieldset>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input class="form-control" name="email" placeholder="Email" type="email" maxlength="31" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
        <input class="form-control" name="phone" placeholder="Phone" type="tel" maxlength="20" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input class="form-control" name="password" placeholder="Password" type="password" maxlength="31" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input class="form-control" name="confirmation" placeholder="Password Confirmation" type="password" maxlength="31" required/>
        </div>

                <span class="input-group-btn">

                <button type="submit" class="btn btn-lg btn-success btn-block">
                    <span class="glyphicon glyphicon-pencil"></span>
                    &nbsp;  REGISTER 
                </button>
                </span>

        <br>
        <br>
        <a href="login.php" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-off"></span>
             &nbsp;  Already a member?
        </a>
        <br />   <br />
    </fieldset>
</form>
</div> <!-- /container -->





