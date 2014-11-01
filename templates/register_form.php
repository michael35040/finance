<style>
    a:link {color:white;}      /* unvisited link */
    a:visited {color:white;}  /* visited link */
    a:hover {color:white;}  /* mouse over link */
    a:active {color:white;}  /* selected link */


#reg {
	min-height: 94%;
    max-heigh: 94%;
	align: center;
    width: auto;
    margin: 0 auto;
    padding: 5px 5% 0px 5%; /*top, right, bottom, left */
 	/*   border:5px solid #cccccc; */

	overflow:auto;
   	display:block;
    height: auto;
	padding-bottom: 0px; /* must be same height as the footer */
	margin-bottom: 10px;
	background-color: white;
	opacity:.96;
	filter:alpha(opacity=96); /* For IE8 and earlier */
/*	font-weight:bold; */
	color:black;
	left: 0;
	right: 0;
	position: relative;
	width: 500px;
	font: bold normal 1em/2em Arial, Helvetica, sans-serif;
	text-shadow: 0px 0px 0px black; /* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
}
</style>

<form id="reg" action="register.php" method="post">
  <fieldset>
      <h3>Register:</h3>
<div class="control-group">    
    	<label class="control-label" for="inputIcon"><strong>Usernames</strong> must contain only alphanumeric characaters.</label>
        <div class="controls">
        	<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
                <input class="span2" id="inputIcon" name="username" placeholder="Create Username" type="text" maxlength="31" required autofocus />
			</div>
		</div>
</div>






<div class="control-group">    
    	<label class="control-label" for="inputIcon"><strong>Emails</strong> must have a valid email format. </label>
        <div class="controls">
        	<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
                <input class="span2" id="inputIcon" name="email" placeholder="E-mail Address" type="email" maxlength="31" required />
			</div>
		</div>
</div>



<div class="control-group">    
    	<label class="control-label" for="inputIcon"><strong>Password</strong> and confirmation must match exactly.</label>
        <div class="controls">
        	<div class="input-prepend">
				<span class="add-on"><i class="icon-star"></i></span>
                <input class="span2" id="inputIcon" name="password" placeholder="Create Password" type="password" maxlength="31" required/>
			</div>
		</div>
</div>




<div class="control-group">    
    	<label class="control-label" for="inputIcon"><strong>Password</strong> confirmation</label>
        <div class="controls">
        	<div class="input-prepend">
				<span class="add-on"><i class="icon-star"></i></span>
                <input class="span2" id="inputIcon" name="confirmation" placeholder="Re-type Password" type="password" maxlength="31" required/>
			</div>
		</div>
</div>
   




<div class="control-group">    
    	<label class="control-label" for="inputIcon"><strong>Phone</strong> number must match the displayed format.</label>
        <div class="controls">
        	<div class="input-prepend">
				<span class="add-on"><i class="icon-bell"></i></span>
                <input class="span2" id="inputIcon" name="phone" placeholder="Phone (1-305-555-1234)" type="tel" maxlength="20" required/>
			</div>
		</div>
</div>



<strong>We will <u>never</u> share your information. No fine print. 
<br />It is only for our use to contact you regarding your account.
</strong>

<br /><br />

               
      <button type="submit" class="btn btn-success btn-sm">
          <span class="glyphicon glyphicon-pencil"></span>
          <b> REGISTER </b>
      </button>



<hr>
or
<br>
<a href="login.php" class="btn btn-info btn-sm">
    <span class="glyphicon glyphicon-off"></span>
    <b> &nbsp;  LOG IN </b>
</a>
      <br />   <br />
  </fieldset>
</form>





