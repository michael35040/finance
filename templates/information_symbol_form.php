<form action="information.php" method="post">
    <h3>Select a symbol:</h3>
    <fieldset>
        <!-- removed autofocus             <input autofocus name="symbol" placeholder="Symbol" type="text" maxlength="31"/> -->

 <div class="input-append">
    <div class="input-prepend">

        <input list="symbol" name="symbol" maxlength="8" class="input-small" required><!--<input list="symbol" class="input-small" name="symbol" id="symbol" placeholder="Symbol" type="text" maxlength="5" required-->
        <datalist id="symbol"><!--select class="input-small" name="symbol" id="symbol" /-->

            <?php
            if (empty($stocks)) {
                echo("<option value=' '>No Symbols</option>");
            } else {
                foreach ($stocks as $stock) {
                    $symbol = $stock["symbol"];
                    echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                }
            }
            ?>
        </datalist>
    </div><!--input-prepend-->
    <div class="input-prepend">
        <button type="submit" class="btn btn-danger" >Submit</button><!--national exchange-->
    </div><!--input-prepend-->
</div><!--input-append-->

    </fieldset>
</form>
