<?php
// configuration
//require("../includes/config.php");
//apologize(var_dump(get_defined_vars()));
$SBallAssets =	query("SELECT symbol, issued FROM assets ORDER BY symbol ASC");

$SBassets = []; //to send to next page

$SBindexMarketCap = 0;
$SBindexValue = 0;
foreach ($SBallAssets as $SBrow)		// for each of user's stocks
{
    $SBasset = [];
    $SBasset["symbol"] = $SBrow["symbol"]; //set variable from stock info
    $SBasset["issued"] = $SBrow["issued"]; //set variable from stock info

    $SBtrades = query("SELECT price FROM trades WHERE symbol = ? ORDER BY uid DESC LIMIT 0, 1", $SBasset["symbol"]);	  // query user's portfolio
    if(empty($SBtrades[0]["price"])){$SBtrades[0]["price"]=0;}
    $SBasset["price"] = $SBtrades[0]["price"]; //stock price per share
    $SBasset["marketcap"] = ($SBasset["price"] * $SBasset["issued"]);
    $SBindexMarketCap = $SBindexMarketCap+$SBasset["marketcap"];
    $SBindexValue = $SBindexValue+$SBasset["price"];
    $SBassets[] = $SBasset;
}

//BANNER 1
?>
    <style type="text/css"><!--
        #marqueeborder {
            color: #000;
            background-color: transparent;
            font-family:"Lucida Console", Monaco, monospace;
            position:relative;
            height:20px;
            overflow:hidden;
            font-size: 0.8em;
        }
        #marqueecontent {
            position:absolute;
            left:0px;
            line-height:20px;
            white-space:nowrap;
        }
        .stockbox {
            margin:0 20px; /*top, right, bottom, left */
        }
        .stockbox a {
            color: #ccc;
            text-decoration : underline;
        }
        --></style>

    <script type="text/javascript">

        // Original script by Walter Heitman Jr, first published on http://techblog.shanock.com

        // Set an initial scroll speed. This equates to the number of pixels shifted per tick
        var scrollspeed=2;
        var pxptick=scrollspeed;

        function startmarquee(){
            // Make a shortcut referencing our div with the content we want to scroll
            marqueediv=document.getElementById("marqueecontent");
            // Get the total width of our available scroll area
            marqueewidth=document.getElementById("marqueeborder").offsetWidth;
            // Get the width of the content we want to scroll
            contentwidth=marqueediv.offsetWidth;
            // Start the ticker at 50 milliseconds per tick, adjust this to suit your preferences
            // Be warned, setting this lower has heavy impact on client-side CPU usage. Be gentle.
            lefttime=setInterval("scrollmarquee()",20);
        }

        function scrollmarquee(){
            // Check position of the div, then shift it left by the set amount of pixels.
            if (parseInt(marqueediv.style.left)>(contentwidth*(-1)))
                marqueediv.style.left=parseInt(marqueediv.style.left)-pxptick+"px";
            // If it's at the end, move it back to the right.
            else
                marqueediv.style.left=parseInt(marqueewidth)+"px";
        }

        window.onload=startmarquee;

    </script>

    <div id="marqueeborder" onmouseover="pxptick=0" onmouseout="pxptick=scrollspeed">
        <div id="marqueecontent">




            <?php //echo($sitename);
function banner($price)
{
    if($price!=0)
    {
        $change=$price/mt_rand(3,100);
        $change=number_format($change,2,".",",");
        $posneg=(mt_rand(1,10));
    }
    else //($SBasset["price"]==0)
    {
        $posneg=5;
    }
    if($posneg>6)
    {echo('<span style="color: #009900;"> &#x25B2; ' . $change . '</span></span>');} //up
    elseif($posneg<5)
    {echo('<span style="color: #ff0000;"> &#x25BC; ' . $change . '</span></span>');}//down
    else
    {$change=0; echo('<span style="color: #000000;"> &#x25C4; &#x25BA; ' . $change . '</span></span>');}//even
}




            //MARKET INDEX
            echo('<span class="stockbox">');
            //echo("INDEX MARKET CAP.&nbsp;");echo($unitsymbol . number_format($SBindexMarketCap, 2, ".", ",")); 
            echo("INDEX&nbsp;");
            echo($unitsymbol . number_format($SBindexValue, 2, ".", ",")); // number_format($SBindexMarketCap, 0, ".", ","));
            banner($SBindexValue);//CHANGE AND ARROWS


            //EACH SHARE
            foreach ($SBassets as $SBasset)
            {
                echo('<span class="stockbox">');
                echo($SBasset["symbol"] . "&nbsp;");
                echo($unitsymbol . number_format($SBasset["price"], 2, ".", ","));
                banner($SBasset["price"]);//CHANGE AND ARROWS
            }
            ?>

        </div>
    </div>

