<form action="users.php" method="post">
<fieldset>

<h3>Search Users:</h3>


<div class="input-append">

        	<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
                	<select name="where" value="where" class="input-small" />
					  <option value="1">ID #</option>
					  <option value="2">Username</option>
					  <option value="3">Email</option>
					</select>
			</div><!--input-prepend-->
            
        	<div class="input-prepend">
				<span class="add-on"><i class="icon-search"></i></span>
                <input  type="text" class="input-medium" name="search" placeholder="Search Terms" !required />
			</div><!--input-prepend-->
            
			<button type="submit" class="btn btn-primary"><b>SEARCH</b></button>
            
</div><!--input-append--> 



            

<br />
<input type="radio" name="terms" value="else" required  checked/>Search &nbsp; &nbsp; &middot;  &nbsp; &nbsp;
<input type="radio" name="terms" value="all" required />All &nbsp; &nbsp; &middot;  &nbsp; &nbsp;
<input type="radio" name="terms" value="money" required />Top 10<br />





</fieldset>
</form>

