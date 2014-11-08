<?php

// configuration
//require("../includes/config.php");
/*
$allAssets =	query("SELECT * FROM assets ORDER BY symbol ASC");

$assets = []; //to send to next page

$indexMarketCap = 0;
$indexValue = 0;
foreach ($allAssets as $row)		// for each of user's stocks
{
    $asset = [];
    $asset["symbol"] = $row["symbol"]; //set variable from stock info
    $asset["name"] = $row["name"]; //set variable from stock info
    $asset["date"] = $row["date"]; //date listed on exchange
    $asset["owner"] = $row["owner"];
    $asset["fee"] = $row["fee"];
    $asset["issued"] = $row["issued"]; //shares issued

    $public =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", $asset["symbol"]);	  // query user's portfolio
    if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
    $publicQuantity = $public[0]["quantity"]; //shares held
    $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE symbol =? AND side='a'", $asset["symbol"]);	  // query user's portfolio
    $askQuantity = $askQuantity[0]["quantity"]; //shares trading
    $asset["public"] = $askQuantity+$publicQuantity;

    $asset["url"] = $row["url"]; //webpage
    $asset["type"] = $row["type"]; //type of asset (shares, commodity)
    $asset["rating"] = $row["rating"]; //my rating
    $asset["description"] = $row["description"]; //description of asset
    $bid =	query("SELECT price FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $asset["symbol"], 'b');
    if(empty($bid)){$bid=0;}
    $asset["bid"] = $bid[0]["price"]; //stock price per share
    $ask =	query("SELECT price FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $asset["symbol"], 'a');
    if(empty($ask)){$ask=0;}
    $asset["ask"] = $ask[0]["price"]; //stock price per share
    $volume =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE symbol =? GROUP BY DAY(date) ORDER BY uid ASC ", $asset["symbol"]);	  // query user's portfolio
    if(empty($volume[0]["quantity"])){$volume[0]["quantity"]=0;}
    if(empty($volume[0]["price"])){$volume[0]["price"]=0;}
    $asset["volume"] = $volume[0]["quantity"];
    $asset["avgprice"] = $volume[0]["price"];
    $trades = query("SELECT price FROM trades WHERE symbol = ? ORDER BY uid DESC LIMIT 0, 1", $asset["symbol"]);	  // query user's portfolio
    if(empty($trades[0]["price"])){$trades[0]["price"]=0;}
    $asset["price"] = $trades[0]["price"]; //stock price per share
    $asset["marketcap"] = ($asset["price"] * $asset["issued"]);
    //$dividend =	query("SELECT SUM(quantity) AS quantity FROM history WHERE type = 'dividend' AND symbol = ?", $asset["symbol"]);	  // query user's portfolio
    $asset["dividend"]=0; //until we get real ones
    //$asset["dividend"] = $dividend["dividend"]; //shares actually held public
    $indexMarketCap = $indexMarketCap+$asset["marketcap"];
    $indexValue = $indexValue+$asset["price"];
    $assets[] = $asset;
}
    //apologize(var_dump(get_defined_vars()));

*/
?>







<script language="JavaScript1.2">

    //var screenWidth = window.screen.width, screenHeight = window.screen.height;
    //var screenWidthwidth = document.getElementById('middle').offsetWidth;
    var screenWidthwidth = document.getElementById('middle').style.width;
    var marqueewidth=screenWidth


    //Specify the marquee's width (in pixels)
    //var marqueewidth="500px";

    //Specify the marquee's height
    var marqueeheight="25px"
    //Specify the marquee's marquee speed (larger is faster 1-10)
    var marqueespeed=3
    //Specify initial pause before scrolling in milliseconds
    var initPause=0
    //Specify start with Full(1)or Empty(0) Marquee
    var full=1
    //configure background color:
    var marqueebgcolor="#DEFDD9"
    //Pause marquee onMousever (0=no. 1=yes)?
    var pauseit=1

    //Specify the marquee's content (don't delete <nobr> tag)
    //Keep all content on ONE line, and backslash any single quotations (ie: that\'s great):

    var marqueecontent='<nobr><font face="Arial" size="2"><?php //echo($sitename);

                    echo("INDEX&nbsp;");
                    echo($unitsymbol . number_format($indexValue, 0, ".", ","));
                    echo("&nbsp;&nbsp;|&nbsp;&nbsp;");
                    //echo($unitsymbol . number_format($indexMarketCap, 0, ".", ","));
                    foreach ($assets as $asset)
                    {
                        echo($asset["symbol"] . "&nbsp;");
                        echo($unitsymbol . number_format($asset["price"], 2, ".", ","));
                        echo("&nbsp;&nbsp;|&nbsp;&nbsp;");
                        //" " . $unitsymbol . number_format($asset["marketcap"], 0, ".", ",")
                    }
                    ?></font></nobr>'


    ////NO NEED TO EDIT BELOW THIS LINE////////////
    var copyspeed=marqueespeed
    var pausespeed=(pauseit==0)? copyspeed: 0
    var iedom=document.all||document.getElementById
    if (iedom)
        document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+marqueecontent+'</span>')
    var actualwidth=''
    var cross_marquee, cross_marquee2, ns_marquee
    function populate(){
        if (iedom){
            var initFill=(full==1)? '8px' : parseInt(marqueewidth)+8+"px"
            actualwidth=document.all? temp.offsetWidth : document.getElementById("temp").offsetWidth
            cross_marquee=document.getElementById? document.getElementById("iemarquee") : document.all.iemarquee
            cross_marquee.style.left=initFill
            cross_marquee2=document.getElementById? document.getElementById("iemarquee2") : document.all.iemarquee2
            cross_marquee2.innerHTML=cross_marquee.innerHTML=marqueecontent
            cross_marquee2.style.left=(parseInt(cross_marquee.style.left)+actualwidth+8)+"px" //indicates following #1
        }
        else if (document.layers){
            ns_marquee=document.ns_marquee.document.ns_marquee2
            ns_marquee.left=parseInt(marqueewidth)+8
            ns_marquee.document.write(marqueecontent)
            ns_marquee.document.close()
            actualwidth=ns_marquee.document.width
        }
        setTimeout('lefttime=setInterval("scrollmarquee()",30)',initPause)
    }
    window.onload=populate

    function scrollmarquee(){
        if (iedom){
            if (parseInt(cross_marquee.style.left)<(actualwidth*(-1)+8))
                cross_marquee.style.left=(parseInt(cross_marquee2.style.left)+actualwidth+8)+"px"
            if (parseInt(cross_marquee2.style.left)<(actualwidth*(-1)+8))
                cross_marquee2.style.left=(parseInt(cross_marquee.style.left)+actualwidth+8)+"px"
            cross_marquee2.style.left=parseInt(cross_marquee2.style.left)-copyspeed+"px"
            cross_marquee.style.left=parseInt(cross_marquee.style.left)-copyspeed+"px"
        }
        else if (document.layers){
            if (ns_marquee.left>(actualwidth*(-1)+8))
                ns_marquee.left-=copyspeed
            else
                ns_marquee.left=parseInt(marqueewidth)+8
        }
    }

    if (iedom||document.layers){
        with (document){
            document.write('<table border="0" cellspacing="0" cellpadding="0"><td>')
            if (iedom){
                write('<div style="position:relative;width:'+marqueewidth+';height:'+marqueeheight+';overflow:hidden">')
                write('<div style="position:absolute;width:'+marqueewidth+';height:'+marqueeheight+';background-color:'+marqueebgcolor+'" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">')
                write('<div id="iemarquee" style="position:absolute;left:0px;top:3px;display:inline;"></div>')
                write('<div id="iemarquee2" style="position:absolute;left:0px;top:3px;display:inline;"></div>')
                write('</div></div>')
            }
            else if (document.layers){
                write('<ilayer width='+marqueewidth+' height='+marqueeheight+' name="ns_marquee" bgColor='+marqueebgcolor+'>')
                write('<layer name="ns_marquee2" left=0 top=3 onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed"></layer>')
                write('</ilayer>')
            }
            document.write('</td></table>')
        }
    }
</script>
