
<form action="information.php"  class="symbolForm" method="post"   >
    <fieldset>






                        <table>
                            <tr>
                                <td>




                                    <div class="input-group" >
                                <input list="symbol" name="symbol" placeholder="Symbol" maxlength="8"
                               class="form-control"  required>
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

        </td>
    </tr>
</table>






    </fieldset>
</form>
<br> <br>


