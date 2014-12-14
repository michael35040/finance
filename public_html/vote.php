
<?php
// configuration
require("../includes/config.php");


$id = $_SESSION["id"]; //get id from session





$ownership = ownership('A');
// apologize(var_dump(get_defined_vars()));
// apologize(var_dump(get_defined_vars()));


function createPoll()
{
    //CREATE A VOTE DB
    echo "creating database\n";
    try {
        $dbh = new PDO('sqlite:voting.db');
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $dbh->exec('
        CREATE TABLE tally (
        QID varchar(32) NOT NULL,
        AID integer NOT NULL,
        votes integer NOT NULL,
        PRIMARY KEY (QID,AID))
    ');
    }
    catch(PDOException $e) {
        echo "ERROR!!: $e";
        exit;
    }
    echo "db created successfully.";
}

?>





<style>

    form.webPoll {
        background:#ededed;
        behavior:url(PIE.php);
        border:1px solid #bebebe;
        -moz-border-radius:8px;
        -webkit-border-radius:8px;
        border-radius:8px;
        -moz-box-shadow:#666 0 2px 3px;
        -webkit-box-shadow:#666 0 2px 3px;
        box-shadow:#666 0 2px 3px;
        margin:10px 0 10px 8px;
        padding:6px;
        position:relative;
        width:246px;
    }
    form.webPoll fieldset {
        background:#FCFAFC;
        behavior:url(PIE.php);
        border:1px solid #FCFAFC;
        -moz-border-radius:10px;
        -webkit-border-radius:10px;
        border-radius:10px;
        margin:0;
        padding:0;
        position:relative;
    }
    form.webPoll ul {
        behavior:url(PIE.php);
        border:2px #bebebe solid;
        -moz-border-radius:10px;
        -webkit-border-radius:10px;
        border-radius:10px;
        font-family:verdana;
        font-size:10px;
        list-style-type:none;
        margin:0;
        padding:10px 0;
        position:relative;
    }
    form.webPoll li {
        margin:0 16px;
        overflow:auto;
        padding:4px 0 6px;
        position: relative;
    }
    form.webPoll input {
        position: absolute;
        top: 4px;
        *top: 0;
        left: 0;
        margin: 0;
        padding:0;
    }
    label.poll_active {
        float:right;
        width:90%;
    }
    form.webPoll .result {
        background: #d81b21;
        background: -webkit-gradient(linear, left top, left bottom, from(#ff8080), to(#aa1317));
        background: -moz-linear-gradient(top,  #ff8080,  #aa1317);
        -pie-background: linear-gradient(#ff8080, #aa1317);
        border:1px red solid;
        -moz-border-radius:3px;
        -webkit-border-radius:3px;
        border-radius:3px;
        clear:both;
        color:#EFEFEF;
        padding-left:2px;
        behavior: url('PIE.php');
    }
    form.webPoll h4 {
        color:#444;
        font-family:Georgia, serif;
        font-size:19px;
        font-weight:400;
        line-height:1.4em;
        margin:6px 4px 12px;
        padding:0;
    }
    .buttons {
        margin:8px 0 1px;
        padding:0;
        text-align:right;
        width:122px;
    }
    .vote {
        background:url(res/vote.png) repeat scroll 0 0 transparent;
        border:medium none;
        height:40px;
        text-indent:-9999em;
        width:122px;
    }
    .vote:hover {
        background-position:0 -41px;
        cursor:pointer;
    }
    form.webPoll ul,li { /*// Make IE6 happy //*/
        zoom:1;
    }



</style>





<?php

$a = new webPoll(array(
    'What subjects would you like to learn more about?',
    'HTML & CSS',
    'JavaScript',
    'JS Frameworks (jQuery, etc)',
    'Ruby/Ruby on Rails',
    'PHP',
    'mySQL'));





if($voted==false)
{ ?>
    <form class="webPoll" method="post" action="/poll/test.php">
        <h4>What question would you like to ask?</h4>
        <fieldset>
            <ul>
                <li>
                    <label class='poll_active'>
                        <input type='radio' name='AID' value='0'>
                        First Answer Here
                    </label>
                </li>
            </ul>
        </fieldset>
        <p class="buttons">
            <button type="submit" class="vote">Vote!</button>
        </p>
    </form>
<?php
}
?>


<?php
if($voted==true)
{ ?>
    <form class="webPoll" method="post" action="/poll/test.php">
        <h4>What question would you like to ask?</h4>
        <fieldset>
            <ul>
                <li>
                    <label class='poll_active'>
                        <input type='radio' name='AID' value='0'>
                        First Answer Here
                    </label>
                </li>
            </ul>
        </fieldset>
        <p class="buttons">
            <button type="submit" class="vote">Vote!</button>
        </p>
    </form>
<?php
}
?>



<!--
need to create another table
if owned on a certain date, create a table of who can vote and how much their vote counts for
this is to prevent voters voting twice or complications when buying or selling during sell
-->

<div class="panel panel-primary"> <!--success VOTING -->
    <!-- Default panel contents -->
    <div class="panel-heading">VOTING</div>
    <table class="table">
        <thead>
        <tr class="active">
            <th>Ticket</th>
            <th>Vote</th>
            <th>Result (Y/N)</th>
            <th>Status</th>
            <th>Voted/Total</th>
            <th>Description</th>
            <th>Vote Date</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>#1</td>
            <td><button>YES</button> / <button>NO</button></td><!--if own--><!--if already voted-->
            <td>4,500 (45%)/ 5,500 (55%)</td>
            <td>Closed</td>
            <td>10,000/20,000</td>
            <td>Conduct secondary offering of 5 million.</td>
            <td>06 NOV 14</td>

        </tr>
        </tbody>
    </table>
</div><!--panel-primary VOTING-->








<table>
    <tr>
        <th>ID</th>
        <th>Orderbook</th>
        <th>Portfolio</th>
        <th>Total</th>
    </tr>
    <?php

    foreach ($ownership as $owner)
    {
        echo("<tr>");
        echo("<td>" . $owner['id'] . "</td>");
        echo("<td>" . $owner['orderbook'] . "</td>");
        echo("<td>" . $owner['portfolio'] . "</td>");
        echo("<td>" . $owner['total'] . "</td>");
        echo("</tr>");
    }
    ?>
</table>






