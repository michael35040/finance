<?php
require("../includes/config.php");

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}
if ($id == 1) { 
  
$title = "Users";
$limit = "LIMIT 0, 50";
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
  if (isset($_POST["activate"]))
  {
    $id = $_POST["activate"];
    //CANCEL ALL USERS ORDERS
    if ($id == 'ALL') { if (query("UPDATE users SET active=1 WHERE 1") === false) {apologize("Unable to activate all users!");}} 
    //CANCEL ONLY 1 ORDER
    else { if (query("UPDATE users SET active=1 WHERE id=?", $id) === false) {apologize("Unable to activate user!");}}
    redirect('admin_activate.php');
  }
  elseif (isset($_POST["deactivate"]))
  {
    $id = $_POST["deactivate"];
    //CANCEL ALL USERS ORDERS
    if ($id == 'ALL') { if (query("UPDATE users SET active=0 WHERE 1") === false) {apologize("Unable to deactivate all users!");}} 
    //CANCEL ONLY 1 ORDER
    else { if (query("UPDATE users SET active=0 WHERE id=?", $id) === false) {apologize("Unable to deactivate user!");}}
    redirect('admin_activate.php');
  }
  else{redirect('admin_activate.php');}
}
else
{
$limit = "LIMIT 0, 10";
$inactiveUsers = query("SELECT id, registered FROM users WHERE active=0 ORDER BY id ASC");
$activeUsers = query("SELECT id, registered FROM users WHERE active=1 ORDER BY id ASC");

render("admin_activate_form.php", ["title" => $title, "inactiveUsers" => $inactiveUsers, "activeUsers" => $activeUsers]);
} //else !post
}//$id
?>




