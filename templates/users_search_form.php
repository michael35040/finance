<style>

    .usersForm table, .usersForm td, .usersForm tr
    {
        border:1px solid black;
    }
</style>
<form action="users.php"  class="usersForm" method="post"   >
    <fieldset>

        <table>
            <tr>
                <td><input name="terms" value="all" type="radio">All</td>
                <td><input name="terms" value="money" type="radio" >Top 10 $</td>
                <td><input name="terms" value="else" type="radio" >Search</td>
            </tr>
            <tr>
                <td><input name="where" value="1" type="radio">ID#</td>
                <td><input name="where" value="2" type="radio">Username</td>
                <td><input name="where" value="3" type="radio">Email</td>
            </tr>
            <tr>
                <td colspan="3"><input type="text" placeholder="Search Terms" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="3"><button class="btn btn-info" type="submit">Search!</button></td>
            </tr>
        </table>

    </fieldset>
</form>