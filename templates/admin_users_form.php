
<!--font color='#FF0000'></font-->
<table class="table" align="center">

<!-- HEADER ROW -->
    <thead>
        <tr bgcolor="#CCCCCC">
            <th>ID</th>
            <th>Email</th>
			<!--th>Password</th--> 
            <th>Phone</th>
            <th>Last Login</th>
            <th>Registered</th>
			<th>Fails</th> 
            <th>IP</th>
            <th><?php echo($unittype) //set in finance.php ?></th>
            <th>Locked</th>
			<th>Loan</th> 
            <th>Rate</th>
        </tr>
    </thead>


    <tbody>
<?php

	    foreach ($searchusers as $row)	
        {   
            echo("<tr>");
            echo("<td>" . number_format($row["id"],0,".",",") . "</td>");
            echo("<td>" . htmlspecialchars($row["email"]) . "</td>");
          //  echo("<td>" . htmlspecialchars($row["password"]) . "</td>"); 
            echo("<td>" . htmlspecialchars($row["phone"]) . "</td>");
            echo("<td>" . (date('Y-m-d H:i:s', strtotime($row["last_login"])) . "</td>"));
            echo("<td>" . (date('Y-m-d H:i:s', strtotime($row["registered"])) . "</td>"));
            echo("<td>" . htmlspecialchars($row["fails"]) . "</td>");
            echo("<td>" . htmlspecialchars($row["ip"]) . "</td>"); 
            echo("<td>" . number_format($row["units"],2,".",",") . "</td>");
            echo("<td>" . number_format($row["locked"],2,".",",") . "</td>");
            echo("<td>" . number_format($row["loan"],2,".",",") . "</td>");
            echo("<td>" . number_format(($row["rate"]*100),2,".",",") . "%</td>");
            echo("</tr>");
        }
    ?>



    </tbody>
</table>

<?php //var_dump(get_defined_vars()); ?>