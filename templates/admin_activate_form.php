
<table class="table table-condensed table-bordered">
<tr class="success">
  <td colspan="2" style="font-size:20px; text-align: center;">INACTIVE USERS</td>
</tr>
<!--blank row breaker-->
<tr class="active">
    <th style="width:20%">User</th>
    <th style="width:80%">Action</th>
</tr>
<?php
//list users
$i=0;
foreach ($inactiveUsers as $user)
{ $i++;
   echo('
   <tr>
   <td>' . $user["id"] . '</td>
   <td><form><span class="input-group-btn">
        <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="admin_activate.php" name="activate" value="' . $user["id"] . '">
        <span class="glyphicon glyphicon-plus-sign"></span> Activate</button></span></form>
   </td>
   </tr>');
}
if($i>0)
{
?>
<tr>
    <td>ALL</td>
    <td>
      <form><span class="input-group-btn">
      <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="admin_activate.php" name="activate" value="ALL">
      <span class="glyphicon glyphicon-plus-sign"></span> Activate All</button></span></form>
    </td>
</tr>
</table>
<?php }
else
{ ?>
  <td colspan="2">No inactive users</td>
<?php  
}

?>




<table class="table table-condensed table-bordered">
<tr class="success">
  <td colspan="2" style="font-size:20px; text-align: center;">ACTIVE USERS</td>
</tr>
<!--blank row breaker-->
<tr class="active">
    <th style="width:20%">User</th>
    <th style="width:80%">Action</th>
</tr>
<?php
//list users
$i=0;
foreach ($activeUsers as $user)
{ $i++;
   echo('
   <tr>
   <td>' . $user["id"] . '</td>
   <td>
      <form><span class="input-group-btn">
      <button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="admin_activate.php" name="deactivate" value="' . $user["id"] . '">
      <span class="glyphicon glyphicon-minus-sign"></span> Deativate</button></span></form>
   </td>
   </tr>');
}
if($i>0)
{
?>
<tr>
    <td>ALL</td>
    <td>
      <form><span class="input-group-btn">
      <button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="admin_activate.php" name="deactivate" value="ALL">
      <span class="glyphicon glyphicon-minus-sign"></span> Deativate All</button></span></form>
    </td>
</tr>
</table>
<?php } 
else
{ ?>
  <td colspan="2">No active users</td>
<?php  
}

?>
</div> <!--width-->