
<form action="admin_deposit.php" method="post">

    <fieldset>

        <h3>Deposit:</h3>

        <div class="input-append">

            <div class="input-prepend">
                <span class="add-on"><i class="icon-download-alt"></i></span>

            </div><!--input-prepend-->

            <div class="input-prepend">
                <input class="input-small" name="userid" placeholder="User ID" type="number" min="0" max="any" required />
            </div><!--input-prepend-->

            <div class="input-prepend">
                <input class="input-medium"  type="number" name="quantity" placeholder="<?php echo($unitsymbol);?> Amount/Quantity" step="0.0000000000001" min="0" max="any" required />
            </div><!--input-prepend-->
            <br />
            <button type="submit" class="btn btn-success"><b>DEPOSIT</b></button>

        </div><!--input-append-->




        <?php //var_dump(get_defined_vars()); //dump all variables anywhere (displays in header) ?>
        <br />