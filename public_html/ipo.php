<?php
require("../includes/config.php");  // configuration  

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    $symbol = $_POST["symbol"];
    $name = $_POST["name"];
    $date = $_POST["date"]; //date issued
    $owner = $_POST["owner"]; //owner or chief executive
    $fee = $_POST["fee"]; //fee?
    $issued = $_POST["issued"]; //current amount of shares made public, issued for IPO
    $public = $_POST["public"]; //current amount of shares on public market
    $dividend = $_POST["dividend"];
    $url = $_POST["url"];
    $type = $_POST["type"]; //share or commodity
    $rating = $_POST["rating"]; //1 - 10
    $description = $_POST["description"];

    if (empty($symbol))
    { apologize("You must enter symbol."); }
    if (empty($name))
    { apologize("You must enter name."); }
    if (empty($date))
    { apologize("You must enter date."); }
    if (empty($owner))
    { apologize("You must enter owner."); }
    if (empty($fee))
    { apologize("You must enter fee."); }
    if (empty($issued))
    { apologize("You must enter issued."); }
    if (empty($public))
    { apologize("You must enter public."); }
    if (empty($dividend))
    { apologize("You must enter dividend."); }
    if (empty($url))
    { apologize("You must enter url."); }
    if (empty($type))
    { apologize("You must enter type."); }
    if (empty($rating))
    { apologize("You must enter rating."); }
    if (empty($description))
    { apologize("You must enter description."); }

    if (query("INSERT INTO `bank`.`assets` (`symbol`, `name`, `date`, `owner`, `fee`, `issued`, `public`, `dividend`, `url`, `type`, `rating`, `description`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $name, $date, $owner, $fee, $issued, $public, $dividend, $url, $type, $rating, $description) === false)  //create IPO
    {
        apologize("Database Failure.");
    }

render("assets_form.php", ["title" => "Success"]); // render success form
  
}
else
{
render("ipo_form.php", ["title" => "IPO"]); // render buy form //***/to remove C/***/
}
  
//         echo(var_dump(get_defined_vars()));       //dump all variables if i hit error    
?>
