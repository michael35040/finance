<?php
require("../includes/config.php");  // configuration  

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    $symbol = $_POST["symbol"];
    $name = $_POST["name"];
    $date = $_POST["date"]; //date issued
    $userid = $_POST["userid"]; //owner or chief executive
    $owner = $_POST["owner"]; //owner or chief executive
    $fee = $_POST["fee"]; //fee?
    $issued = $_POST["issued"]; //current amount of shares made public, issued for IPO
    $url = $_POST["url"];
    $type = $_POST["type"]; //share or commodity
    $rating = $_POST["rating"]; //1 - 10
    $description = $_POST["description"];

    if (empty($symbol)) { apologize("You must enter symbol."); }
    if (empty($name)) { apologize("You must enter name."); }
    if (empty($date)) { apologize("You must enter date."); }
    if (empty($userid)) { apologize("You must enter user id."); }
    if (empty($owner)) { apologize("You must enter owner."); }
    if (empty($fee)) { apologize("You must enter fee."); }
    if (empty($issued)) { apologize("You must enter issued."); }
    if (empty($url)) { apologize("You must enter url."); }
    if (empty($type)) { apologize("You must enter type."); }
    if (empty($rating)) { apologize("You must enter rating."); }
    if (empty($description)) { apologize("You must enter description."); }


    $symbol = strtoupper($symbol); //cast to UpperCase


    $feeQuantity = ($issued * $fee);
    $ownersQuantity = ($issued - $feeQuantity);


    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit



    ////////////////
    //INSERT ASSET
    ////////////////
    if (query("INSERT INTO assets (`symbol`, `name`, `date`, `owner`, `fee`, `issued`, `url`, `type`, `rating`, `description`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $name, $date, $owner, $fee, $issued, $url, $type, $rating, $description) === false)  //create IPO
    {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Failure to insert into assets");
    }

    ////////////////
    //INSERT SHARES INTO PORTFOLIO OF OWNER MINUS FEE
    ////////////////
    $ownerPortfolio = query("SELECT symbol FROM portfolio WHERE (id =? AND symbol =?)", $userid, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $countRows = count($ownerPortfolio);
    //apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
    $price = 0;
    if ($countRows == 0)
    {
        if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $userid, $symbol, $ownersQuantity, $price) === false) {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Insert to Owners Portfolio Error 1");
        } //update portfolio
    } //updates if stock already owned
    elseif ($countRows == 1) //else update db
    {
        if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $ownersQuantity, $price, $userid, $symbol) === false) {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Update to Owners Portfolio Error 2");
        } //update portfolio
    } else {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Owner Portfolio Error 3");
    } //apologizes if first two conditions are not meet


    ////////////////
    //INSERT TRADE INTO PORTFOLIO OF OWNER MINUS FEE
    ////////////////
    if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $userid, $userid, $ownersQuantity, $price, $fee, $issued, 'ipo', 0, 0) === false) {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Insert Owner Trade Error");
    }
    ////////////////
    //INSERT FEE SHARES INTO PORTFOLIO OF ADMIN
    ////////////////
    $ownerPortfolio = query("SELECT symbol FROM portfolio WHERE (id = ? AND symbol = ?)", $adminid, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $countRows = count($ownerPortfolio);
    if (count($countRows) == 0)
    {
        if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $adminid, $symbol, $feeQuantity, $price) === false) {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Insert Fee to Admin Error");
        } //update portfolio
    } //updates if stock already owned
    elseif ($countRows == 1) //else update db
    {
        if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $feeQuantity, $price, $adminid, $symbol) === false) {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Update to Owners Portfolio Error");
        } //update portfolio
    } else {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Owner Portfolio Error");
    } //apologizes if first two conditions are not meet

    ////////////////
    //INSERT TRADE SHARES INTO PORTFOLIO OF ADMIN
    ////////////////
    if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $adminid, $userid, $feeQuantity, $price, $fee, $issued, 'ipo', 0, 0) === false) {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        apologize("Insert Admin Trade Error");
    }





query("COMMIT;"); //If no errors, commit changes
query("SET AUTOCOMMIT=1");



redirect("assets.php", ["title" => "Success"]); // render success form
  
}
else
{
render("admin_ipo_form.php", ["title" => "IPO"]); // render buy form //***/to remove C/***/
}
//         apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
?>
