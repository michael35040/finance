<?php 
header("Content-type: text/css; charset: UTF-8"); 

date_default_timezone_set("America/New_York");
$now = date('G');
//0700-2000 or 7am to 7pm EST
if ($now > 7 && $now < 20) { $img = '1'; }  //day
else { $img = '1'; } //night
?>

a:link {color:black;}      /* unvisited link */
a:visited {color:black;}  /* visited link */
a:hover {color:black;}  /* mouse over link */
a:active {color:black;}  /* selected link */








.table > thead > tr > td.success,
.table > tbody > tr > td.success,
.table > tfoot > tr > td.success,
.table > thead > tr > th.success,
.table > tbody > tr > th.success,
.table > tfoot > tr > th.success,
.table > thead > tr.success > td,
.table > tbody > tr.success > td,
.table > tfoot > tr.success > td,
.table > thead > tr.success > th,
.table > tbody > tr.success > th,
.table > tfoot > tr.success > th {
background-color: #A0A0A0; /*CC9900 dark gold *//*A0A0A0  dark silver*/
}


.table > thead > tr > td.active,
.table > tbody > tr > td.active,
.table > tfoot > tr > td.active,
.table > thead > tr > th.active,
.table > tbody > tr > th.active,
.table > tfoot > tr > th.active,
.table > thead > tr.active > td,
.table > tbody > tr.active > td,
.table > tfoot > tr.active > td,
.table > thead > tr.active > th,
.table > tbody > tr.active > th,
.table > tfoot > tr.active > th {
background-color: #C8C8C8; /*ffd700 light gold*//*C8C8C8   light silver*/
}


td 
{
 background-color:#ffffff; /*fix zooming issue*/
}
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
  
  background-color:#D9DDD5; /*#D0D0D0*/
  /*
  background-size: cover;
  background-image: url('../img/bg/<?php echo($img); ?>.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  */
}

#page {
align: center;
width: auto;
padding: 0px 2% 0px 2%; /*top, right, bottom, left */
/*margin: 0px 0% 0px 0%;*/
border:0 solid black;
/*background-color: white;*/
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




