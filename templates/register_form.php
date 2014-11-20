<style>
    a:link {color:white;}      /* unvisited link */
    a:visited {color:white;}  /* visited link */
    a:hover {color:white;}  /* mouse over link */
    a:active {color:white;}  /* selected link */


    #reg {
        min-height: 94%;
        max-heigh: 94%;
        align: center;
        width: auto;
        margin: 0 auto;
        padding: 5px 5% 0px 5%; /*top, right, bottom, left */
        /*   border:5px solid #cccccc; */

        overflow:auto;
        display:block;
        height: auto;
        padding-bottom: 0px; /* must be same height as the footer */
        margin-bottom: 10px;
        
        opacity:.96;
        filter:alpha(opacity=96); /* For IE8 and earlier */
        /*	font-weight:bold; 
        
        background-color: transparent;
        */
        width: 50%;
        color:black;
        left: 0;
        right: 0;
        position: relative;
        
        font: bold normal 1em/2em Arial, Helvetica, sans-serif;
        text-shadow: 0px 0px 0px black; /* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
    }
</style>

<form id="reg" action="register.php" method="post">
    <fieldset>
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span> Email</span>
        <input class="form-control" name="email" placeholder="Email" type="email" maxlength="31" required/>

        <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span> Phone</span>
        <input class="form-control" name="phone" placeholder="Phone" type="tel" maxlength="20" required/>

        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span> Password</span>
        <input class="form-control" name="password" placeholder="Password" type="password" maxlength="31" required/>

        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span> Confirmation</span>
        <input class="form-control" name="confirmation" placeholder="Password Confirmation" type="password" maxlength="31" required/>

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





