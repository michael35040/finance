

<?php //BANNER 1 ?>

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
        margin:0 10px;
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
        echo('<span class="stockbox">');
        echo("INDEX&nbsp;");
        echo($unitsymbol . number_format($SBindexValue, 2, ".", ","));
        $change=(mt_rand(1,200)/100);
        $posneg=(mt_rand(1,2));
        if($posneg==1)  {echo('<span style="color: #009900;"> &#x25B2; ' . $change . '</span></span>');}
        else            {echo('<span style="color: #ff0000;"> &#x25BC; ' . $change . '</span></span>');}


        //echo('<span style="color: #009900;">&uarr;0.15</span></span>');
        //echo($unitsymbol . number_format($SBindexMarketCap, 0, ".", ","));
        foreach ($SBassets as $SBasset)
        {
            echo('<span class="stockbox">');
            echo($SBasset["symbol"] . "&nbsp;");
            echo($unitsymbol . number_format($SBasset["price"], 2, ".", ","));
            $change=(mt_rand(1,200)/100);
            $posneg=(mt_rand(1,2));
            if($posneg==1)  {echo('<span style="color: #009900;"> &#x25B2;' . $change . '</span></span>');} //up
            else            {echo('<span style="color: #ff0000;"> &#x25BC;' . $change . '</span></span>');}//down
            //&#x25C4; &#x25BA; //<> even

            //echo('<span style="color: #ff0000;">&darr;0.08</span></span>');
            //" " . $unitsymbol . number_format($asset["SBmarketcap"], 0, ".", ",")
        }
        ?>

    </div>
</div>













<?php //BANNER 1 ?>
<style type="text/css"><!--
    .stockbox {
        margin:0 10px;
    }
    .stockbox a {
        color: #ccc;
        text-decoration : underline;
    }
</style>
<?php //BANNER 2 ?>

<script>
    var tWidth='100%';                  // width (in pixels)
    var tHeight='15px';                  // height (in pixels)
    var tcolour='transparent';               // background colour:
    var moStop=true;                     // pause on mouseover (true or false)
    var fontfamily = 'arial,sans-serif'; // font for content
    var tSpeed=3;                        // scroll speed (1 = slow, 5 = fast)

    // enter your ticker content here (use \/ and \' in place of / and ' respectively)
    var content='<?php //echo($sitename);
            echo('<span class="stockbox">');
            echo("INDEX&nbsp;");
            echo($unitsymbol . number_format($SBindexValue, 2, ".", ","));
            $change=(mt_rand(1,200)/100);
            $posneg=(mt_rand(1,2));
            if($posneg==1)  {echo('<span style="color: #009900;"> &#x25B2; ' . $change . '</span></span>');}
            else            {echo('<span style="color: #ff0000;"> &#x25BC; ' . $change . '</span></span>');}


            //echo('<span style="color: #009900;">&uarr;0.15</span></span>');
             //echo('<span style="color: #ff0000;">&darr;0.08</span></span>');
             //" " . $unitsymbol . number_format($asset["SBmarketcap"], 0, ".", ",")
            //echo($unitsymbol . number_format($SBindexMarketCap, 0, ".", ","));
            foreach ($SBassets as $SBasset)
            {
                echo('<span class="stockbox">');
                echo($SBasset["symbol"] . "&nbsp;");
                echo($unitsymbol . number_format($SBasset["price"], 2, ".", ","));
                $change=(mt_rand(1,200)/100);
                $posneg=(mt_rand(1,2));
                if($posneg==1)  {echo('<span style="color: #009900;"> &#x25B2; ' . $change . '</span></span>');} //up
                else            {echo('<span style="color: #ff0000;"> &#x25BC; ' . $change . '</span></span>');}//down
                //&#x25C4; &#x25BA; //<> even

            }
            ?>';

    var cps = tSpeed;
    var aw, mq;
    var fsz = parseInt(tHeight) - 4;

    function startticker() {
        if (document.getElementById) {
            var tick = '<div style="position:relative;width:' + tWidth + ';height:' + tHeight + ';overflow:hidden;background-color:' + tcolour + '"';
            if (moStop) tick += ' onmouseover="cps=0" onmouseout="cps=tSpeed"';
            tick += '><div id="mq" style="position:absolute;left:0px;top:0px;font-family:' + fontfamily + ';font-size:' + fsz + 'px;white-space:nowrap;"><\/div><\/div>';
            document.getElementById('ticker').innerHTML = tick;
            mq = document.getElementById("mq");
            mq.style.left = (parseInt(tWidth) + 10) + "px";
            mq.innerHTML = '<span id="tx">' + content + '<\/span>';
            aw = document.getElementById("tx").offsetWidth;
            lefttime = setInterval("scrollticker()", 50);
        }
    }

    function scrollticker() {
        mq.style.left = (parseInt(mq.style.left) > (-10 - aw)) ? parseInt(mq.style.left) - cps + "px" : parseInt(tWidth) + 10 + "px";
    }
    window.onload = startticker;

</script>

<div id="ticker"></div>










