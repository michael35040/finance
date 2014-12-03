<?php
// configuration
require("../includes/config.php");
//require("../includes/constants.php");


// if form was submitted  -- validate and insert int database
if ($_SERVER["REQUEST_METHOD"] == "POST")
{      //   var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
    if(!ctype_digit($_POST["captcha"])){apologize("Incorrect captcha input!");}
    $code=$_SESSION["code"];
    $captcha=(int)$_POST["captcha"];
    if($code!=$captcha){apologize("Incorrect captcha!"); exit(); }
    // else($code===$captcha){echo("Correct captcha!"); exit(); }

    $fname = $_POST["fname"];
    $fname = sanatize("alphabet", $fname);

    $lname = $_POST["lname"];
    $lname = sanatize("alphabet", $lname);

    $email = $_POST["email"];
    $email = sanatize("email", $email);

    $address = $_POST["address"];
    $address = sanatize("address", $address);

    $city = $_POST["city"];
    $city = sanatize("alphabet", $city);

    $region = $_POST["region"]; //state
    $region = sanatize("alphabet", $region);

    @$zip = (int)$_POST["zip"];
    $zip = sanatize("quantity", $zip);

    $phone = $_POST["phone"];
    $phone = sanatize("phone", $phone);

    $birth = $_POST["birth"];
    $birth = sanatize("date", $birth);

    $answer = $_POST["answer"];


    $question = $_POST["question"];
    $password = $_POST["password"];
    $confirmation = $_POST["confirmation"];


    // validate submission
    if (empty($password) || empty($confirmation)) { apologize("You must provide a password and re-type it in the confirmation box."); }
    if ($password != $confirmation) { apologize("Password missmatch."); }
    if (empty($fname)) { apologize("You must provide a First Name."); }
    if (empty($lname)) { apologize("You must provide a Last Name."); }
    if (empty($email)) { apologize("You must provide an Email."); }
    if (empty($address)) { apologize("You must provide an Address."); }
    if (empty($city)) { apologize("You must provide a City."); } //not mandatory
    if (empty($region)) { apologize("You must provide a State/Region."); }
    if (empty($zip)) { apologize("You must provide a Postal Code."); }
    if (empty($phone)) { apologize("You must provide a Phone Number."); }
    if (empty($question)) { apologize("You must provide a Security Question."); }
    if (empty($answer)) { apologize("You must provide a Security Answer."); }
    if (empty($password)) { apologize("You must provide a Password."); }
    if (empty($confirmation)) { apologize("You must provide a Password Confirmation."); }
    if (empty($birth)) { apologize("You must provide a date."); }



//NEW METHOD
    /* Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP.
         For that reason, the length of the result from using this identifier can change over time. Therefore, it is recommended to store the result in a database
         column that can expand beyond 60 characters (255 characters would be a good choice). */
    /**
     * In this case, we want to increase the default cost for BCRYPT to 12.
     * Note that we also switched to BCRYPT, which will always be 60 characters.
     */
    $options = ['cost' => 12,];
    $password = password_hash($password, PASSWORD_BCRYPT, $options);



//OLD METHOD
    /*
    $password = generate_hash($password); //generate blowfish hash from functions.php
    if (strlen($password) != 60) { apologize("Invalid password configuration."); }  // The hashed pwd should be 60 characters long. If it's not, something really odd has happened
    */

    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')):
    { $ipaddress = getenv('HTTP_CLIENT_IP'); }
    elseif(getenv('HTTP_X_FORWARDED_FOR')):
    { $ipaddress = getenv('HTTP_X_FORWARDED_FOR'); }
    elseif(getenv('HTTP_X_FORWARDED')):
    { $ipaddress = getenv('HTTP_X_FORWARDED'); }
    elseif(getenv('HTTP_FORWARDED_FOR')):
    { $ipaddress = getenv('HTTP_FORWARDED_FOR'); }
    elseif(getenv('HTTP_FORWARDED')):
    { $ipaddress = getenv('HTTP_FORWARDED'); }
    elseif(getenv('REMOTE_ADDR')):
    { $ipaddress = getenv('REMOTE_ADDR'); }
    else:
    { $ipaddress = 'UNKNOWN'; }
    endif;


    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit



//INSERTS INTO HISTORY for user
    $quantity = 1; //admins id, will appear on the inital deposit as counterparty id.
    //$initialunits set in finance.php
    $neginitialunits = ($initialunits * -1); //initial deposit
    $transaction = 'LOAN'; //for listing on history

//$now = time(); //get current time in unix seconds
    //UPDATE USERS FOR USER
    if (query("
        INSERT INTO users (email, fname, lname, birth, address, city, region, zip, phone, question, answer, password, ip, fails, active, last_login)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())",
            $email, $fname, $lname, $birth, $address, $city, $region, $zip, $phone, $question, $answer, $password, $ipaddress, 0, 0) === false)
    {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Email already in use. #1");
    }

    $rows = query("SELECT LAST_INSERT_ID() AS id"); //this takes the id to the next page
    $id = $rows[0]["id"]; //sets sql query to var
    $_SESSION["id"] = $rows[0]["id"]; //generate session id
    $_SESSION["email"] = $email;

    if (query("INSERT INTO accounts (id, units, loan, rate, approved) VALUES(?, ?, ?, ?, ?)", $id, $initialunits, $neginitialunits, $loanrate, 0) === false)
    {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Email already in use. #2");
    }


    if ($initialunits != 0)
    {
        //UPDATE HISTORY FOR USER
        if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'LOAN', $unittype, $quantity, $neginitialunits) === false)
        {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Database Failure. #2");
        }
        if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", $id, 'DEPOSIT', $unittype, $quantity, $initialunits) === false)
        {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Database Failure. #3");
        }

        //UPDATE HISTORY and USERS FOR ADMIN //user id, will appear on the inital deposit for admin
        if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", 1, 'LOAN', $unittype, $id, $initialunits) === false)
        {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Database Failure. #4");
        }
        if (query("INSERT INTO history (id, transaction, symbol, quantity, price) VALUES (?, ?, ?, ?, ?)", 1, 'DEPOSIT', $unittype, $id, $neginitialunits) === false)
        {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Database Failure. #5");
        }
        if (query("UPDATE accounts SET units = (units - ?) WHERE id = 1", $initialunits) === false)
        {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Database Failure. #6");
        }
        if (query("UPDATE accounts SET loan = (loan + ?) WHERE id = 1", $initialunits) === false)
        {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Database Failure. #7");
        }


    } //initial deposit != 0

    $ipaddress = $_SERVER["REMOTE_ADDR"];

//insert into login history table
    if (query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $id, $ipaddress, 's') === false)
    {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Database Failure. #8");
    }



    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");

    //random number to prevent user hitting back and resubmitting multiple regs.
    $_SESSION["code"]=mt_rand(0,9999);

    redirect("status.php");
//apologize("You have successfully registered. Now your account needs to be activated.");


} //POST

//    render("register_form.php", ["title" => "Register"]);
?>






<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Pulwar Register</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>


<style>





    @import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
    @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

    body{
        margin: 0;
        padding: 0;
        background: #fff;

        color: #fff;
        font-family: Arial;
        font-size: 12px;
    }

    .body{
        position: absolute;
        /*
        top: -20px;
        left: -20px;
        right: -40px;
        bottom: -40px;
        */
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 0px;

        width: auto;
        height: auto;
        /*
        background-image: url(http://ginva.com/wp-content/uploads/2012/07/city-skyline-wallpapers-008.jpg);
        */
        background-image: url('img/bg/1.jpg');
        background-size: cover;
        -webkit-filter: blur(5px);
        z-index: 0;

        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;

    }

    .grad{
        position: absolute;
        /*
        top: -20px;
        left: -20px;
        right: -40px;
        bottom: -40px;
        */
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 0px;

        width: auto;
        height: auto;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
        z-index: 1;
        opacity: 0.7;
    }

    .header{
        position: absolute;
        top: calc(50% - 35px);
        left: calc(50% - 255px);
        z-index: 2;
    }

    .header div{
        float: left;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 35px;
        font-weight: 200;
    }

    .header div span{
        color: #5379fa !important;
    }

    .login{
        position: absolute;
        /*
        top: calc(50% - 75px);
        left: calc(50% - 50px);
        */
        top: calc(0% - 0px);
        left: calc(50% - 115px);
        height: 150px;
        width: 350px;
        padding: 10px;
        z-index: 2;
    }

    .login input[type=text]{
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
        text-shadow: 1px 1px 1px black;

    }
    .login input[type=password]{
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
        /*NOT FOR REGISTRATION FORM...
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
        margin-top: 10px;
        */
    }


    .login input[type=submit]{
        width: 316px;
        height: 35px;
        background: red;
        border: 1px solid #fff;
        cursor: pointer;
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 6px;
        margin-top: 10px;
    }

    .login input[type=submit]:hover{
        opacity: 0.8;
    }

    .login input[type=submit]:active{
        opacity: 0.6;
    }

    .login input[type=text]:focus{
        outline: none;
        border: 1px solid rgba(255,255,255,0.9);

    }
    .login input[type=password]:focus{
        outline: none;
        border: 1px solid rgba(255,255,255,0.9);
        /*
        outline: none;
        border: 1px solid rgba(255,255,255,0.9);
        */
    }



    .login input[type=submit]:focus{
        outline: none;
    }

    ::-webkit-input-placeholder{
        color: rgba(255,255,255,0.6);
    }

    ::-moz-input-placeholder{
        color: rgba(255,255,255,0.6);
    }
</style>

<script>
    !function(){function e(e,r){return[].slice.call((r||document).querySelectorAll(e))}if(window.addEventListener){var r=window.StyleFix={link:function(e){try{if("stylesheet"!==e.rel||e.hasAttribute("data-noprefix"))return}catch(t){return}var n,i=e.href||e.getAttribute("data-href"),a=i.replace(/[^\/]+$/,""),o=(/^[a-z]{3,10}:/.exec(a)||[""])[0],s=(/^[a-z]{3,10}:\/\/[^\/]+/.exec(a)||[""])[0],l=/^([^?]*)\??/.exec(i)[1],u=e.parentNode,p=new XMLHttpRequest;p.onreadystatechange=function(){4===p.readyState&&n()},n=function(){var t=p.responseText;if(t&&e.parentNode&&(!p.status||p.status<400||p.status>600)){if(t=r.fix(t,!0,e),a){t=t.replace(/url\(\s*?((?:"|')?)(.+?)\1\s*?\)/gi,function(e,r,t){return/^([a-z]{3,10}:|#)/i.test(t)?e:/^\/\//.test(t)?'url("'+o+t+'")':/^\//.test(t)?'url("'+s+t+'")':/^\?/.test(t)?'url("'+l+t+'")':'url("'+a+t+'")'});var n=a.replace(/([\\\^\$*+[\]?{}.=!:(|)])/g,"\\$1");t=t.replace(RegExp("\\b(behavior:\\s*?url\\('?\"?)"+n,"gi"),"$1")}var i=document.createElement("style");i.textContent=t,i.media=e.media,i.disabled=e.disabled,i.setAttribute("data-href",e.getAttribute("href")),u.insertBefore(i,e),u.removeChild(e),i.media=e.media}};try{p.open("GET",i),p.send(null)}catch(t){"undefined"!=typeof XDomainRequest&&(p=new XDomainRequest,p.onerror=p.onprogress=function(){},p.onload=n,p.open("GET",i),p.send(null))}e.setAttribute("data-inprogress","")},styleElement:function(e){if(!e.hasAttribute("data-noprefix")){var t=e.disabled;e.textContent=r.fix(e.textContent,!0,e),e.disabled=t}},styleAttribute:function(e){var t=e.getAttribute("style");t=r.fix(t,!1,e),e.setAttribute("style",t)},process:function(){e("style").forEach(StyleFix.styleElement),e("[style]").forEach(StyleFix.styleAttribute)},register:function(e,t){(r.fixers=r.fixers||[]).splice(void 0===t?r.fixers.length:t,0,e)},fix:function(e,t,n){for(var i=0;i<r.fixers.length;i++)e=r.fixers[i](e,t,n)||e;return e},camelCase:function(e){return e.replace(/-([a-z])/g,function(e,r){return r.toUpperCase()}).replace("-","")},deCamelCase:function(e){return e.replace(/[A-Z]/g,function(e){return"-"+e.toLowerCase()})}};!function(){setTimeout(function(){},10),document.addEventListener("DOMContentLoaded",StyleFix.process,!1)}()}}(),function(e){function r(e,r,n,i,a){if(e=t[e],e.length){var o=RegExp(r+"("+e.join("|")+")"+n,"gi");a=a.replace(o,i)}return a}if(window.StyleFix&&window.getComputedStyle){var t=window.PrefixFree={prefixCSS:function(e,n){var i=t.prefix;if(t.functions.indexOf("linear-gradient")>-1&&(e=e.replace(/(\s|:|,)(repeating-)?linear-gradient\(\s*(-?\d*\.?\d*)deg/gi,function(e,r,t,n){return r+(t||"")+"linear-gradient("+(90-n)+"deg"})),e=r("functions","(\\s|:|,)","\\s*\\(","$1"+i+"$2(",e),e=r("keywords","(\\s|:)","(\\s|;|\\}|$)","$1"+i+"$2$3",e),e=r("properties","(^|\\{|\\s|;)","\\s*:","$1"+i+"$2:",e),t.properties.length){var a=RegExp("\\b("+t.properties.join("|")+")(?!:)","gi");e=r("valueProperties","\\b",":(.+?);",function(e){return e.replace(a,i+"$1")},e)}return n&&(e=r("selectors","","\\b",t.prefixSelector,e),e=r("atrules","@","\\b","@"+i+"$1",e)),e=e.replace(RegExp("-"+i,"g"),"-"),e=e.replace(/-\*-(?=[a-z]+)/gi,t.prefix)},property:function(e){return(t.properties.indexOf(e)?t.prefix:"")+e},value:function(e){return e=r("functions","(^|\\s|,)","\\s*\\(","$1"+t.prefix+"$2(",e),e=r("keywords","(^|\\s)","(\\s|$)","$1"+t.prefix+"$2$3",e)},prefixSelector:function(e){return e.replace(/^:{1,2}/,function(e){return e+t.prefix})},prefixProperty:function(e,r){var n=t.prefix+e;return r?StyleFix.camelCase(n):n}};!function(){var e={},r=[],n=getComputedStyle(document.documentElement,null),i=document.createElement("div").style,a=function(t){if("-"===t.charAt(0)){r.push(t);var n=t.split("-"),i=n[1];for(e[i]=++e[i]||1;n.length>3;){n.pop();var a=n.join("-");o(a)&&-1===r.indexOf(a)&&r.push(a)}}},o=function(e){return StyleFix.camelCase(e)in i};if(n.length>0)for(var s=0;s<n.length;s++)a(n[s]);else for(var l in n)a(StyleFix.deCamelCase(l));var u={uses:0};for(var p in e){var f=e[p];u.uses<f&&(u={prefix:p,uses:f})}t.prefix="-"+u.prefix+"-",t.Prefix=StyleFix.camelCase(t.prefix),t.properties=[];for(var s=0;s<r.length;s++){var l=r[s];if(0===l.indexOf(t.prefix)){var c=l.slice(t.prefix.length);o(c)||t.properties.push(c)}}"Ms"!=t.Prefix||"transform"in i||"MsTransform"in i||!("msTransform"in i)||t.properties.push("transform","transform-origin"),t.properties.sort()}(),function(){function e(e,r){return i[r]="",i[r]=e,!!i[r]}var r={"linear-gradient":{property:"backgroundImage",params:"red, teal"},calc:{property:"width",params:"1px + 5%"},element:{property:"backgroundImage",params:"#foo"},"cross-fade":{property:"backgroundImage",params:"url(a.png), url(b.png), 50%"}};r["repeating-linear-gradient"]=r["repeating-radial-gradient"]=r["radial-gradient"]=r["linear-gradient"];var n={initial:"color","zoom-in":"cursor","zoom-out":"cursor",box:"display",flexbox:"display","inline-flexbox":"display",flex:"display","inline-flex":"display",grid:"display","inline-grid":"display","min-content":"width"};t.functions=[],t.keywords=[];var i=document.createElement("div").style;for(var a in r){var o=r[a],s=o.property,l=a+"("+o.params+")";!e(l,s)&&e(t.prefix+l,s)&&t.functions.push(a)}for(var u in n){var s=n[u];!e(u,s)&&e(t.prefix+u,s)&&t.keywords.push(u)}}(),function(){function r(e){return a.textContent=e+"{}",!!a.sheet.cssRules.length}var n={":read-only":null,":read-write":null,":any-link":null,"::selection":null},i={keyframes:"name",viewport:null,document:'regexp(".")'};t.selectors=[],t.atrules=[];var a=e.appendChild(document.createElement("style"));for(var o in n){var s=o+(n[o]?"("+n[o]+")":"");!r(s)&&r(t.prefixSelector(s))&&t.selectors.push(o)}for(var l in i){var s=l+" "+(i[l]||"");!r("@"+s)&&r("@"+t.prefix+s)&&t.atrules.push(l)}e.removeChild(a)}(),t.valueProperties=["transition","transition-property"],e.className+=" "+t.prefix,StyleFix.register(t.prefixCSS)}}(document.documentElement);
</script>

</head>

<body>

<div class="body"></div>
<div class="grad"></div>
<div class="header">
    <div>Pulwar<br><span>Register</span></div>
</div>
<br>

<form role="form" action="register.php"method="post" onsubmit="return ValidateForm(this);">
    <div class="login">

        <script type="text/javascript">
            function ValidateForm(frm) {
                if (frm.fname.value == "") {alert('First Name is required.');frm.fname.focus();return false;}
                if (frm.lname.value == "") {alert('Last Name is required.');frm.lname.focus();return false;}
                if (frm.email.value == "") {alert('Email address is required.');frm.email.focus();return false;}
                if (frm.email.value.indexOf("@") < 1 || frm.email.value.indexOf(".") < 1) {alert('Please enter a valid email address.');frm.email.focus();return false;}
                if (frm.phone.value == "") {alert('Phone is required.');frm.phone.focus();return false;}
                if (frm.address.value == "") {alert('Address is required.');frm.address.focus();return false;}
                if (frm.city.value == "") {alert('City is required.');frm.city.focus();return false;}
                if (frm.region.value == "") {alert('Country is required.');frm.region.focus();return false;}
                if (frm.captcha.value == "") {alert('Enter web form code.');frm.captcha.focus();return false;}
                return true; }

        </script>
        <table border="0" cellpadding="5" cellspacing="0" width="600">
            <tr>
                <td>
                    <input id="FirstName" name="fname"  placeholder="first name"  type="text" maxlength="60" style="width:146px; border:1px solid #999999" required />
                    <input id="LastName" name="lname"  placeholder="last name" type="text" maxlength="60" style="width:146px; border:1px solid #999999" required />
                </td>
            </tr><tr>
                <td><input id="email" name="email"  placeholder="email"  type="text" maxlength="60" style="width:306px; border:1px solid #999999" required /></td>
            </tr><tr>
                <td><input id="Phone" name="phone" placeholder="phone"  type="text" maxlength="43" style="width:306px; border:1px solid #999999" required /></td>
            </tr><tr>
                <td><input name="password" placeholder="Password" type="password" maxlength="31" style="width:306px; border:1px solid #999999" required /></td>
            </tr><tr>
                <td><input name="confirmation" placeholder="Password Confirmation" type="password" maxlength="31" style="width:306px; border:1px solid #999999" required /></td>
            </tr><tr>
                <td><input id="address" name="address" placeholder="address"  type="text" maxlength="120" style="width:306px; border:1px solid #999999" required /></td>
            </tr><tr>
                <td><input id="city" name="city" placeholder="city"  type="text" maxlength="120" style="width:306px; border:1px solid #999999" required /></td>
            </tr><tr>
                <td><input id="Zip" name="zip" placeholder="zip"  type="text" maxlength="30" style="width:306px; border:1px solid #999999" required /></td>
            </tr><tr>
                <td>
                    <select class="form-control" name="region" style="width:317px; border:1px solid #999999" required /><option value=null>State/Region</option>
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
                </td>
            </tr><tr>
                <td>
                    <select class="form-control" name="question" style="width:317px; border:1px solid #999999" required /><option value=null>Security Question</option>
                    <option value="What is your maternal grandmother&#39;s maiden name?">What is your maternal grandmother&#39;s maiden name?</option>
                    <option value="What was the last name of your favorite teacher?">What was the last name of your favorite teacher?</option>
                    <option value="In what city did you meet your spouse/significant other?">In what city did you meet your spouse/significant other?</option>
                    <option value="What is your father&#39;s middle name?">What is your father&#39;s middle name?</option>
                    <option value="In what city were you born?">In what city were you born?</option>
                    <option value="What was the model of your first car?">What was the model of your first car?</option>
                    <option value="What is the name of your pet?">What is the name of your pet?</option>
                    </select>
                </td>
            </tr><tr>
                <td><input name="answer" placeholder="Security Answer" type="text" maxlength="60" style="width:306px; border:1px solid #999999" required /></td>
            </tr><tr>

                <td><input  name="birth" placeholder="YYYY-MM-DD (Birthdate)" type="date" style="width:313px; border:1px solid #999999" required /></td>
            </tr><tr>
                <td>
                    <img src="captcha.php" style="width:50px"/>
                    <input name="captcha" placeholder="Captcha #" type="text" maxlength="4" style="width:251px; border:1px solid #999999" required/>
                </td>
            </tr><tr>

                <td><input id="submit" name="submit" type="submit" value="Register" />
                    <br>
                    <a href="login.php" style="color:red;">Already a member?</a>

                </td>

            </tr>

        </table>



    </div>
</form>







<script src='js/jquery.js'></script>


</body>

</html>


























