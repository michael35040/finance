<style>
    #middle
    {
        background-color:transparent;
        border:0;
    }
</style>
<form action="admin_update.php" class="symbolForm" method="post" >
    <fieldset>
        <table>
            <tr>
                <td>
                    <div class="input-group" >
                        <select name="symbol" class="form-control" required>
                            <?php
                            if (empty($assets)) {
                                echo("<option value=' '>No Assets</option>");
                            } else {
                                echo (' <option class="select-dash" disabled="disabled">-All Assets-</option>');
                                foreach ($assets as $asset) {
                                    $symbol = $asset["symbol"];
                                    echo("<option value='" . $symbol . "'> " . $symbol . "</option>");
                                }
                            }
                            ?>
                        </select>

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
