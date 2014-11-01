<style>
    .symbolForm {
        text-align: center;
        width: 200px;
        padding: 0px;
        position:relative;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<form action="information.php"  class="symbolForm" method="post"   >
    <fieldset>



        <div class="row" style="width:400px;" >
        <div class="col-lg-6">
            <div class="input-group">

                <input list="symbol" name="symbol" maxlength="8"  class="form-control"  required>
                <datalist id="symbol">
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
<span class="input-group-btn">
<button type="submit" class="btn btn-info">
    <b> SUBMIT </b>
</button>
</span>

            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->






    </fieldset>
</form>



