<table>
    <tr>
        <td>Name</td>
        <td>Email</td>
        <td>ID</td>
    </tr>
    <tr>
        <td>Notifications</td>
        <td>Email</td>
        <td>ID</td>
    </tr>
</table>

<table class="table table-condensed  table-bordered" >

        <tr  class="success">
            <td colspan="8" style="font-size:20px; text-align: center;">ACCOUNTS</td>
        </tr>
        <tr   class="active">
            <th colspan="2">Account #</th>
            <th>Type</th>
            <th colspan="4">Description</th>
            <th>Amount</th>
        </tr>

        <?php
        $i=0;
        if($units >= 0)
        {       ?>
            <tr>
                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($userid); $i++; echo("-" . $i); ?></td>
                <td><?php echo(strtoupper($unittype)) //set in finance.php ?></td></td>
                <td colspan="4"><?php echo($unitdescription); ?></td>
                <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                    <?php echo(number_format($units,2,".",",")) ?></td>
            </tr>
        <?php
        }
        /*
        if($loan <0)
        {   ?>
            <tr>
                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($userid); $i++; echo("-" . $i); ?></td>
                <td><?php echo(strtoupper("LOAN")) //set in finance.php ?></td></td>
                <td colspan="4">APR: <?php echo(htmlspecialchars(number_format($rate,2)));?>%</td>
                <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                    <?php echo(number_format($loan,2,".",",")) ?></td>
            </tr>
        <?php
        }
        */
        if($bidLocked != 0)
        {
            ?>

            <tr>
                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($userid);
                    $i++;
                    echo("-" . $i); ?></td>
                <td><?php echo(strtoupper($unittype)) //set in finance.php ?></td>
                <td colspan="4"><?php echo("Pending Bid Orders (Locked)"); ?></td>
                <td style="text-align:left"><?php echo($unitsymbol) //set in finance.php ?>
                    <?php echo(number_format($bidLocked, 2, ".", ",")) ?></td>
            </tr>
        <?php
        }
        if($i == 0)
        {
            echo("<tr><td colspan='8'>You do not have any funds in any accounts</td></tr>");

        } ?>

            <tr  class="active">
                <td colspan="7"><strong>TOTAL</strong></td>
                <td>
                    <strong>
                        <?php
                        $accountsTotal = ($units+$loan+$bidLocked);
                        echo(number_format($accountsTotal, 2, ".", ","))
                        ?>
                    </strong>
                </td>
            </tr>
    <!-- HEADER ROW -->
    
    </table>
