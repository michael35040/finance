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
        width: 90%;


    }
</style>

<h2 class="form-signin-heading" style="text-shadow: 1px 1px 5px #000;">Please register</h2>
<img src="captcha.php" />
<br>

<div class="container">
<form id="reg" action="register.php" method="post">
    <fieldset>


        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></span>
            <input class="form-control" name="captcha" placeholder="Captcha # (Above)" type="text" maxlength="4" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input class="form-control" name="fname" placeholder="First Name" type="text" maxlength="60" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input class="form-control" name="lname" placeholder="Last Name" type="text" maxlength="60" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input class="form-control" name="email" placeholder="Email" type="email" maxlength="60" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
        <input class="form-control" name="address" placeholder="Street Address" type="text" maxlength="60" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
        <input class="form-control" name="city" placeholder="City" type="text" maxlength="60" />
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
            <select class="form-control" name="region"><option value="">State/Region</option>
                <option value="AL"> Alabama</option>
                <option value="AK"> Alaska</option>
                <option value="AZ"> Arizona</option>
                <option value="AR"> Arkansas</option>
                <option value="CA"> California</option>
                <option value="CO"> Colorado</option>
                <option value="CT"> Connecticut</option>
                <option value="DC"> District of Columbia</option>
                <option value="DE"> Delaware</option>
                <option value="FL"> Florida</option>
                <option value="GA"> Georgia</option>
                <option value="HI"> Hawaii</option>
                <option value="ID"> Idaho</option>
                <option value="IL"> Illinois</option>
                <option value="IN"> Indiana</option>
                <option value="IA"> Iowa</option>
                <option value="KS"> Kansas</option>
                <option value="KY"> Kentucky</option>
                <option value="LA"> Louisiana</option>
                <option value="ME"> Maine</option>
                <option value="MD"> Maryland</option>
                <option value="MA"> Massachusetts</option>
                <option value="MI"> Michigan</option>
                <option value="MN"> Minnesota</option>
                <option value="MS"> Mississippi</option>
                <option value="MO"> Missouri</option>
                <option value="MT"> Montana</option>
                <option value="NE"> Nebraska</option>
                <option value="NV"> Nevada</option>
                <option value="NH"> New Hampshire</option>
                <option value="NJ"> New Jersey</option>
                <option value="NM"> New Mexico</option>
                <option value="NY"> New York</option>
                <option value="NC"> North Carolina</option>
                <option value="ND"> North Dakota</option>
                <option value="OH"> Ohio</option>
                <option value="OK"> Oklahoma</option>
                <option value="OR"> Oregon</option>
                <option value="PA"> Pennsylvania</option>
                <option value="RI"> Rhode Island</option>
                <option value="SC"> South Carolina</option>
                <option value="SD"> South Dakota</option>
                <option value="TN"> Tennessee</option>
                <option value="TX"> Texas</option>
                <option value="UT"> Utah</option>
                <option value="VT"> Vermont</option>
                <option value="VA"> Virginia</option>
                <option value="WA"> Washington</option>
                <option value="WV"> West Virginia</option>
                <option value="WI"> Wisconsin</option>
                <option value="WY"> Wyoming</option>
                <option value="AS"> American Samoa</option>
                <option value="FM"> Federated States of Micronesia</option>
                <option value="MH"> Marshall Islands</option>
                <option value="MP"> Northern Mariana Islands</option>
                <option value="PW"> Palau</option>
                <option value="PR"> Puerto Rico</option>
                <option value="VI"> Virgin Islands</option>
                <option value="GU"> Guam</option>
                <option value="AB"> Alberta</option>
                <option value="BC"> British Columbia</option>
                <option value="MB"> Manitoba</option>
                <option value="NB"> New Brunswick</option>
                <option value="NL"> Newfoundland and Labrador</option>
                <option value="NS"> Nova Scotia</option>
                <option value="ON"> Ontario</option>
                <option value="PE"> Prince Edward Island</option>
                <option value="QC"> Quebec</option>
                <option value="SK"> Saskatchewan</option>
                <option value="NT"> Northwest Territories</option>
                <option value="NU"> Nunavut</option>
                <option value="YT"> Yukon</option>
            </select>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
        <input class="form-control" name="zip" placeholder="Postal Code" type="number" maxlength="10" max="999999999" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
        <input class="form-control" name="phone" placeholder="Phone" type="tel" maxlength="15" required/>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
            <select class="form-control" name="question"><option value="">Security Question</option>
                <option value="What is your maternal grandmother&#39;s maiden name?">What is your maternal grandmother&#39;s maiden name?</option>
                <option value="What was the last name of your favorite teacher?">What was the last name of your favorite teacher?</option>
                <option value="In what city did you meet your spouse/significant other?">In what city did you meet your spouse/significant other?</option>
                <option value="What is your father&#39;s middle name?">What is your father&#39;s middle name?</option>
                <option value="In what city were you born?">In what city were you born?</option>
                <option value="What was the model of your first car?">What was the model of your first car?</option>
                <option value="What is the name of your pet?">What is the name of your pet?</option>
            </select>
        </div>

        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-star-empty"></span></span>
        <input class="form-control" name="answer" placeholder="Security Answer" type="text" maxlength="60" required/>
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




