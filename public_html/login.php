<?php
require("../includes/config.php");
//print (var_dump(get_defined_vars()));

$ipaddress = getIP();

if (!empty($_SESSION["id"])) {logout(); }    // log out current user, if any


// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // validate submission
    if (empty($_POST["email"])) { apologize("You must provide your email address."); }
    if (empty($_POST["password"])) { apologize("You must provide your password."); }
    // query database for user
    $rows = query("SELECT * FROM users WHERE email = ?", $_POST["email"]);

    // if we found user, check password
    if (count($rows) == 1)
    {
        // first (and only) row
        $row = $rows[0];
        $active = $row["active"];
        $fails = $row["fails"];
        $id = $row["id"];

        //checks attempts for the id before trying password to ensure not bruteforce
        $maxAttempts = 5;
        $attemptsLeft = ($maxAttempts-$fails);

        if ($fails > $maxAttempts) { apologize("Too many incorrect login attempts. Please contact us to unlock your account."); }

        if (password_verify($_POST["password"], $row["password"])) {
            //remember that user's now logged in by storing user's ID in session
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];

            //update users last login
            if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $id, 'Login Success', $ipaddress) === false) {apologize("Failure Login Query #1");}
            if(query("UPDATE users SET last_login = now(), fails = 0, ip = ? WHERE id = ?", $ipaddress, $id) === false){ apologize("Failure Login Query #2"); }
            if(query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $id, $ipaddress, 's') === false){ apologize("Failure Login Query #3"); }//update login success
            redirect("index.php");		// redirect to portfolio
        } //password
        else
        {
            if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $id, 'Login Failure', $ipaddress) === false) {apologize("Failure Login Query #4");}
            if(query("UPDATE users SET fails=(fails+1) WHERE (id = ?)", $id) === false) {apologize("Failure Login Query #5");}//update failed attempts with 1 additional failed attempt
            if(query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", $id, $ipaddress, 'f') === false) {apologize("Failure Login Query #6");}//update login history to track ips
            apologize("Invalid email and/or password. Only " . $attemptsLeft . " attempts left!" );
        }

    } //ROW COUNT
    elseif (count($rows) == 0) {
        if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'Login Failure', $ipaddress) === false) {apologize("Failure Login Query #7");}
        if(query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", 0, $ipaddress, 'f') === false)  {apologize("Failure Login Query #8");}//update login history to track ips
        apologize("Invalid email and/or password.");
    }
    else
    {
        if(query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'Login Failure', $ipaddress) === false) {apologize("Failure Login Query #9");}
        if(query("INSERT INTO login (id, ip, success_fail) VALUES (?, ?, ?)", 0, $ipaddress, 'f') === false)  {apologize("Failure Login Query #10");}//update login history to track ips
        apologize("Invalid email and/or password.");
    }

} //POST


$symbol =	query("SELECT symbol FROM assets ORDER BY symbol ASC LIMIT 0,1");
@$symbol = $symbol[0]["symbol"]; //will be empty if there are no stocks. if(!empty($symbol)) {)

$bidGroup =	query("SELECT `price`, SUM(`quantity`) AS quantity FROM `orderbook` WHERE (side='b' AND symbol=?) GROUP BY `price` ORDER BY `price` DESC LIMIT 5", $symbol);	  // query user's portfolio
$askGroup =	query("SELECT `price`, SUM(`quantity`) AS quantity FROM `orderbook` WHERE (side='a' AND symbol=?) GROUP BY `price` ORDER BY `price` ASC LIMIT 5", $symbol);	  // query user's portfolio

// else render form
//render("login_form.php", ["title" => "Log In", "bidGroup" => $bidGroup, "askGroup" => $askGroup]);

?>



<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Pulwar Log In</title>
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
            top: calc(50% - 75px);
            /*left: calc(50% - 50px);*/
            left: calc(50% - 125px);
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
            margin-top: 10px;
        }

        .login input[type=submit]{
            width: 260px;
            height: 35px;
            background: #5379fa;
            border: 1px solid #fff;
            cursor: pointer;
            border-radius: 2px;
            /*color: #a18d6c;*/
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
    <div>Pulwar<br><span>Log In</span></div>
</div>
<br>

<div class="login">
    <form role="form" action="login.php" method="post">
        <input type="text" placeholder="email" name="email"><br>
        <input type="password" placeholder="password" name="password"><br>
        <input type="submit" value="Log In">
        <br><br>
        <!--
        <a href="register.php"><button style="width:157px;">Not a member?</button></a>
        <a href="info/index.php"><button style="width:156px;">Learn more!</button></a> 
        -->
        <a href="register.php" style="color:white;">Register</a> /
        <a href="info/index.php" style="color:white;">Information</a>

    </form>
</div>







<script src='js/jquery.js'></script>


</body>

</html>
