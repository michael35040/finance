//SEE IF USER NEEDS TO MAKE A GUESS
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{


    if (isset($_POST["event"]))
    {
        $event=$_POST["event"];
        if($event=='All')
        {
            $guesses =	query("SELECT uid, id, price, name, date, dateend, event FROM spot ORDER BY price ASC, event ASC");

        

$currentstackprice
$movement
$newpurchaseozt
$newpurchaseprice=_POST...


$currentstackozt=null;


$currentstacksize=0;
while ($movement != $calcmovement)
{


$currentstackvalue=$currentstacksize*$currentstackprice;

$newstacksize=$currentstacksize+$newpurchaseozt;

$newstackvalue=($currentstackvalue+$newpurchaseprice)/$newstacksize;


$currentstacksize++;

if($movement==$calcmovement){
echo($currentstacksize);
break;}
}

