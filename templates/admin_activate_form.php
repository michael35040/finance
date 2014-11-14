

<table class="table table-condensed table-bordered">
<tr class="success">
  <td colspan="9" style="font-size:20px; text-align: center;">INACTIVE USERS</td>
</tr>
<!--blank row breaker-->
<tr class="active">
  <th>Action</th>
  <th>User</th>
</tr>
<?php
//list users
$i=0;
foreach ($inactiveUsers as $user)
{ $i++;
   echo('
   <tr>
     <td>
      <form><span class="input-group-btn">
      <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="admin_activate.php" name="activate" value="' . $user["id"] . '">
      <span class="glyphicon glyphicon-plus-sign"></span> Activate</button></span></form>
    </td>
    <td>' . $user["id"] . '</td></tr>');
}
if($i>0)
{
?>
<tr><td>
      <form><span class="input-group-btn">
      <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="admin_activate.php" name="activate" value="ALL">
      <span class="glyphicon glyphicon-plus-sign"></span> Activate</button></span></form>
</td>
<td>ALL</td></tr>
</table>
<?php } ?>




<table class="table table-condensed table-bordered">
<tr class="success">
  <td colspan="9" style="font-size:20px; text-align: center;">ACTIVE USERS</td>
</tr>
<!--blank row breaker-->
<tr class="active">
  <th>Action</th>
  <th>User</th>
</tr>
<?php
//list users
$i=0;
foreach ($activeUsers as $user)
{ $i++;
   echo('
   <tr>
     <td>
      <form><span class="input-group-btn">
      <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="admin_activate.php" name="deactivate" value="' . $user["id"] . '">
      <span class="glyphicon glyphicon-plus-sign"></span> Activate</button></span></form>
    </td>
    <td>' . $user["id"] . '</td></tr>');
}
if($i>0)
{
?>
<tr><td>
      <form><span class="input-group-btn">
      <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="admin_activate.php" name="deactivate" value="ALL">
      <span class="glyphicon glyphicon-plus-sign"></span> Activate</button></span></form>
</td>
<td>ALL</td></tr>
</table>
<?php } ?>
