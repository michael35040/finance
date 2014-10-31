<?php header("Content-type: text/css; charset: UTF-8"); ?>

a:link {color:white;}      /* unvisited link */
a:visited {color:white;}  /* visited link */
a:hover {color:white;}  /* mouse over link */
a:active {color:white;}  /* selected link */



/*sticky footer*/
/* margin bottom = footer height */
/*
html {
position: relative;
min-height: 100%;
}
body {
margin: 0 0 100px;
}
footer {
position: absolute;
left: 0;
bottom: 0;
height: 100px;
width: 100%;
}
*/

html {
position: relative;
min-height: 100%;
}

body {
margin: 0 0 50px; /* bottom = footer height */
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
text-shadow: 1px 1px 5px #000000; /* #003366 */ /*FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
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
text-shadow: 0px 0px 3px black; /* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
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

html, body {
background-color: white;
/*background picture*/
background: url(../img/bg/1.jpg)
no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../img/1.jpg', sizingMethod='scale')";
filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../img/1.jpg', sizingMethod='scale');
/*end background picture*/

}






/*navigation bar*/
a {
color: #333;
}
#nav {
margin: 0;

/*	padding: 7px 6px 0; */
padding: 0px 0px 0;

line-height: 100%;
border-radius: 2em;

-webkit-border-radius: 2em;
-moz-border-radius: 2em;

-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .4);
-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .4);

background: #8b8b8b; /* for non-css3 browsers */
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#a9a9a9', endColorstr='#7a7a7a'); /* for IE */
background: -webkit-gradient(linear, left top, left bottom, from(#a9a9a9), to(#7a7a7a)); /* for webkit browsers */
background: -moz-linear-gradient(top,  #a9a9a9,  #7a7a7a); /* for firefox 3.6+ */

border: solid 1px #6d6d6d;
}
#nav li {
z-index:999; /*makes sure it is on top*/

/*	margin: 0 5px;
padding: 0 0 8px; */

margin: 0 15px; /*width of bar*/
padding: 0 0 0px;	/*bottom of bar*/

float: left;
position: relative;
list-style: none;
}
/* main level link */
#nav a {
font-weight: bold;
color: #e7e5e5;
text-decoration: none;
display: block;

/*	padding:  8px 20px; *//*for around the menu*/
padding:  2px 15px;

margin: 0;
-webkit-border-radius: 1.6em;
-moz-border-radius: 1.6em;
text-shadow: 0 1px 1px rgba(0, 0, 0, .3);
}
/* main level link hover */
#nav .current a, #nav li:hover > a {
background: #d1d1d1; /* for non-css3 browsers */
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ebebeb', endColorstr='#a1a1a1'); /* for IE */
background: -webkit-gradient(linear, left top, left bottom, from(#ebebeb), to(#a1a1a1)); /* for webkit browsers */
background: -moz-linear-gradient(top,  #ebebeb,  #a1a1a1); /* for firefox 3.6+ */

color: #444;
border-top: solid 1px #f8f8f8;
-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .2);
-moz-box-shadow: 0 1px 1px rgba(0, 0, 0, .2);
box-shadow: 0 1px 1px rgba(0, 0, 0, .2);
text-shadow: 0 1px 0 rgba(255, 255, 255, .8);
}
/* sub levels link hover */
#nav ul li:hover a, #nav li:hover li a {
background: none;
border: none;
color: #666;
-webkit-box-shadow: none;
-moz-box-shadow: none;
}
#nav ul a:hover {
background: #0399d4 !important; /* for non-css3 browsers */
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#04acec', endColorstr='#0186ba'); /* for IE */
background: -webkit-gradient(linear, left top, left bottom, from(#04acec), to(#0186ba)) !important; /* for webkit browsers */
background: -moz-linear-gradient(top,  #04acec,  #0186ba) !important; /* for firefox 3.6+ */

color: #fff !important;
-webkit-border-radius: 0;
-moz-border-radius: 0;
text-shadow: 0 1px 1px rgba(0, 0, 0, .1);
}
/* level 2 list */
#nav ul {
background: #ddd; /* for non-css3 browsers */
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#cfcfcf'); /* for IE */
background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#cfcfcf)); /* for webkit browsers */
background: -moz-linear-gradient(top,  #fff,  #cfcfcf); /* for firefox 3.6+ */

display: none;
margin: 0;
padding: 0;
width: 100px; /*width of submenu*/
position: absolute;

/*	top: 35px; *//*distance the menu pops out*/
top: 23px;

left: 0;
border: solid 1px #b4b4b4;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .3);
-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .3);
box-shadow: 0 1px 3px rgba(0, 0, 0, .3);
}
/* dropdown */
#nav li:hover > ul {
display: block;
}
#nav ul li {
float: none;
margin: 0;
padding: 0;
}
#nav ul a {
font-weight: normal;
text-shadow: 0 1px 1px rgba(255, 255, 255, .9);
}
/* level 3+ list */
#nav ul ul {
left: 100px;
top: -3px;
}
/* rounded corners for first and last child */
#nav ul li:first-child > a {
-webkit-border-top-left-radius: 9px;
-moz-border-radius-topleft: 9px;
-webkit-border-top-right-radius: 9px;
-moz-border-radius-topright: 9px;
}
#nav ul li:last-child > a {
-webkit-border-bottom-left-radius: 9px;
-moz-border-radius-bottomleft: 9px;
-webkit-border-bottom-right-radius: 9px;
-moz-border-radius-bottomright: 9px;
}
/* clearfix */
#nav:after {
content: ".";
display: block;
clear: both;
visibility: hidden;
line-height: 0;
height: 0;
}
#nav {
display: inline-block;
}
html[xmlns] #nav {
display: block;
}
* html #nav {
height: 1%;
}
/*end navigation bar*/



/*hides spinner arrows on number input boxes*/
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
display: none;
-webkit-appearance: none;
margin: 0;
}
/*end of hide arrows*/


