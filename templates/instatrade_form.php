<style>
    .container
    {
        width:100%;
    }
    .container table {
        float:left;
        width:25%;
        text-align:center;
        border-collapse:collapse;
        border:3px solid black;
    }
    .container td
    {
        padding:2px 2px 2px 2px;
    }
</style>


<table class="table table-condensed table-striped table-bordered" style="text-align:center;background-color:#FC0;">
    <thead>
    <tr>
        <td colspan="3"  style="font-weight:bold;font-size:20px;text-align:center;background-color:#606060;color:white;width:100%;" >AVAILABLE BALANCES</td>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>
            <h3><span class="label label-warning">Au</span></h3>
            <b>GOLD</b><br />
            9.250 ozt
        </td>
        <td>
            <h3><span class="label label-success"> &nbsp; $ &nbsp; </span></h3>
            <b><?php echo($unittype) ?></b><br />
            <?php echo($unitsymbol . number_format($units, 2, ".", ",")) ?>
        </td>
        <td>
            <h3><span class="label label-default">Ag</span></h3>
            <b>Silver</b><br />
            946.550 ozt
        </td>


    </tr>
    </tbody>
    </table>








<div class="container">






    <table>
        <thead>

        </thead>
        <tbody>
    <tr>
        <td style="width:50%;background-color:#FC0;">
            Spot Price<br />
            <div style="font-size:200%">$1,291.40</div>
        </td>
        <td style="border-bottom: 1px solid black;width:50%;background-color:#FC0;">
            <b>Premium</b>: $3.00<br />
            <b>Price</b>: $1,294.40/ozt
        </td>
    </tr>

    <tr>
        <td style="background-color:#FC0;">
            <div class="input-group">
                <input type="number" class="form-control" placeholder="# of ounces">
                <span class="input-group-addon">ozt</span>
            </div>
            <button type="submit" style="width:100%;background:#404040;color:white;">BUY GOLD</button>
        </td>
        <td style="background-color:#FC0;">
            Buy 5 ozt for $6,472.00
        </td>
    </tr>
        </tbody>
    </table>

    <table>

        <thead>

        </thead>
        <tbody>
    <tr>
        <td style="background-color:#FC0;width:50%;">
            Spot Price<br />
            <div style="font-size:200%">$1,291.10</div>
        </td>
        <td style="background-color:#FC0;border-bottom: 1px solid black;width:50%;">
            <b>Discount</b>: $(3.00)<br />
            <b>Price</b>: $1,289.10/ozt

        </td>
    </tr>

    <tr>
        <td style="background-color:#FC0;">
            <div class="input-group">
                <input type="number" class="form-control" placeholder="# of ounces">
                <span class="input-group-addon">ozt</span>
            </div>
            <button type="submit" style="width:100%;background:#404040;color:white;">SELL GOLD</button>
        </td>
        <td style="background-color:#FC0;">
            Sell 0 ozt for $0.00
        </td>
    </tr>
        </tbody>
</table>






    <table>

        <thead>

        </thead>
        <tbody>
        <tr>
            <td style="background-color:#888;width:50%;">
                Spot Price<br />
                <div style="font-size:200%">$19.50</div>
            </td>
            <td style="background-color:#888;border-bottom: 1px solid black;width:50%;">
                <b>Premium</b>: $0.30<br />
                <b>Price</b>: $19.80/ozt
            </td>
        </tr>

        <tr>
            <td style="background-color:#888;">
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="# of ounces">
                    <span class="input-group-addon">ozt</span>
                </div>
                <button type="submit" style="width:100%;background:#404040;color:white;">BUY SILVER</button>
            </td>
            <td style="background-color:#888;">
                Sell 0 ozt for $0.00
            </td>
        </tr>
        </tbody>
    </table>

    <table>

        <thead>

        </thead>
        <tbody>
        <tr>
            <td style="background-color:#888;width:50%;">
                Spot Price<br />
                <div style="font-size:200%">$19.43</div>
            </td>
            <td style="background-color:#888;border-bottom: 1px solid black;width:50%;">
                <b>Discount</b>: $(0.20)<br />
                <b>Price</b>: $19.23/ozt
            </td>
        </tr>

        <tr>
            <td style="background-color:#888;">
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="# of ounces">
                    <span class="input-group-addon">ozt</span>
                </div>
                <button type="submit" style="width:100%;background:#404040;color:white;">SELL SILVER</button>
            </td>
            <td style="background-color:#888;">
                Sell 0 ozt for $0.00
            </td>
        </tr>
        </tbody>
    </table>










</div>















<br>
<table style="text-align:center;border-collapse:collapse;width:100%;color:white;">
    <thead>
    <tr>
        <td colspan="4"  style="font-weight:bold;font-size:20px;text-align:center;background-color:#606060;color:white;width:100%;" >RECENT TRANSACTIONS</td>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td style="background-color:#06C;">Buy Silver Confirmation</td>
        <td style="background-color:#06C;">Unit Price: $19.23</td>
        <td style="background-color:#06C;">Total Weight: 53.45</td>
        <td style="background-color:#06C;">Total Price: $1,027.84</td>
    </tr>

    <tr>
        <td style="background-color:#0C9;">Sell Silver Confirmation</td>
        <td style="background-color:#0C9;">Unit Price: $19.23</td>
        <td style="background-color:#0C9;">Total Weight: 53.45</td>
        <td style="background-color:#0C9;">Total Price: $1,027.84</td>
    </tr>

    </tbody>
</table>






