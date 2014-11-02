<?php header("Content-type: text/css; charset: UTF-8"); ?>

a:link {color:black;}      /* unvisited link */
a:visited {color:black;}  /* visited link */
a:hover {color:black;}  /* mouse over link */
a:active {color:black;}  /* selected link */

form {
display: inline-block;
text-align: center;
}

.table{
text-align: left;
}

html {
position: relative;
min-height: 100%;
}

body {
margin: 0 0 50px; /* bottom = footer height */

background-size: cover;
background-image: url('../img/bg/1.jpg');
background-repeat: no-repeat;
background-attachment: fixed;
background-position: center;
}

#page {
align: center;
width: auto;
padding: 0px 10% 0px 10%; /*top, right, bottom, left */
border:0 solid red;
/*background-color: yellow;*/
}

#top {
font: bold normal .8em/1.5em Arial, Helvetica, sans-serif;
color: white;
/*background-color: green;*/
 /* text-shadow: 1px 1px 5px #000000; #003366 */ /*FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
}

#middle {
border: 1px solid black;
background-color: white;
opacity:.96;
filter:alpha(opacity=96); /* For IE8 and earlier */
color:black;
}

#bottom {
position:absolute;
bottom: 0;
left:0;
height:50px; /*same as body margin bottom*/
width:100%;
right:0;
/*top, right, bottom, left */
text-align:center;
font-weight:bold;
color: white;
/* text-shadow: 0px 0px 3px black; FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
}


<?php

//random image 
//$random = rand(1,2);
//$img = $random;

//$location = ''; // 'ny' or 'fl' or ''
/*
//based off time of day for server
date_default_timezone_set("America/New_York");
$now = date('G');

if ($now > 7 && $now < 20) { //0700-2000 or 7am to 7pm EST
    $img = '2';  //2 day
} else {
    $img = '1';  //1 night
}

*/
?>

