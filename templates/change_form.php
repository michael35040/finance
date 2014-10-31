<style>
    .changeForm {
        text-align: center;
        width: 50%;
        padding: 0px;
        position:relative;
        margin-left: auto;
        margin-right: auto;
    }
</style>


<form action="change.php" name="change_form" method="post">
    <h3>Edit User Account:</h3>
    <fieldset>

        <TABLE class="changeForm" BORDER="3" cellspacing="0" cellpadding="5" align="center">
        <div class="control-group">
                <TD>
                    <div id="emailMenu" style="opacity:1;">
                        <INPUT TYPE="radio" NAME="change" VALUE="email" id="emailRadio">Change Email
                            	<label class="control-label" for="inputIcon"></label>
                                <div class="controls">
                                	<div class="input-prepend">
                        				<span class="add-on"><i class="icon-envelope"></i></span>
                                        <input class="span2" id="emailInput" name="email" placeholder="New Email" type="email" value=""  />
                       			</div>
                        		</div>
                        
                        
                        

                    </div><!--menuEmail-->
                </TD>
                   
            </TR>
            <TR>
                <TD>
                    <div id="phoneMenu" style="opacity:1;">                
                        <INPUT TYPE="radio" NAME="change" VALUE="phone" id="phoneRadio" >Change Phone
                           
                            	<label class="control-label" for="inputIcon"></label>
                                <div class="controls">
                                	<div class="input-prepend">
                        				<span class="add-on"><i class="icon-bell"></i></span>
                                        <input class="span2" id="phoneInput" name="phone" placeholder="New Phone" type="tel"  value=""  />
                        			</div>
                        		</div>
                        



                    </div><!--menuPhone-->           
                </TD>
                
            </TR>
            <TR>
                <TD>
                    <div id="newpasswordMenu" style="opacity:1;">                
                        <INPUT TYPE="radio" NAME="change" VALUE="newpassword" id="newpasswordRadio" required>Change Password
   
                                	<label class="control-label" for="inputIcon"></label>
                                    <div class="controls">
                                    	<div class="input-prepend">
                            				<span class="add-on"><i class="icon-star"></i></span>
                                            <input class="span2" id="newpasswordInput" name="newpassword" placeholder="New Password" type="password" value=""  />
                            			</div>
                            		</div>
                   
                    </div><!--menuPassword-->                 
                </TD>
                
            </TR>
            <TR>
                <TD>
                    <div id="usernameMenu" style="opacity:1;">                
                        <INPUT TYPE="radio" NAME="change" VALUE="username" id="usernameRadio" required>Change Username
                             
                                	<label class="control-label" for="inputIcon"></label>
                                    <div class="controls">
                                    	<div class="input-prepend">
                            				<span class="add-on"><i class="icon-user"></i></span>
                                            <input class="span2" id="usernameInput" name="username" placeholder="New Username" type="text"  value=""  />
                            			</div>
                            		</div>

                     </div> <!--menuUsername-->               
                </TD>
                
            </TR>
            <TR>
                <TD>
                <label class="control-label" for="inputIcon" id="confirmationText">Re-type Confirmation</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">

                                <div id="confirmationIcon">

                                </div>




                                </i></span>
                    <input class="span2" id="confirmation" name="confirmation" placeholder="Re-type" type="text" value="" required />
                        </div>
                    </div>
                </TD>
            </TR>
            
            <TR>
                <TD>
                <label class="control-label" for="inputIcon">Current Password</label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-star"></i></span>
                        <input class="span2" id="password" name="password" placeholder="Password" type="password" value=""  required  />
                    </div>
                </div>
                              
                
                </TD>
            </TR>
            <TR>
                <TD>
                    <button id="clear" class="btn btn-primary">CLEAR</button>
                    <button type="reset" class="btn btn-danger">SUBMIT</button>
                </TD>
            </TR>
            
        </div><!--control Group--> 
        </TABLE>


        <div class="input-append"><!--for combining/appending input fields-->
        </div>







    </fieldset>
</form>


<script>
    //EMAIL
    document.getElementById("emailRadio").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 0;
        document.getElementById("phoneRadio").disabled = true;
        document.getElementById('phoneInput').value=''; 
        
        document.getElementById("newpasswordMenu").style.opacity = 0;
        document.getElementById("newpasswordRadio").disabled = true;
        document.getElementById('newpasswordInput').value=''; 
        
        document.getElementById("usernameMenu").style.opacity = 0;
        document.getElementById("usernameRadio").disabled = true;
        document.getElementById('usernameInput').value=''; 

        document.getElementById('confirmationText').innerHTML = 'Re-type Email';        
        document.getElementById('confirmationIcon').innerHTML = '<i class="icon-envelope">';
    }, false);

    //PHONE    
    document.getElementById("phoneRadio").addEventListener("click", function () {
        document.getElementById("emailMenu").style.opacity = 0;
        document.getElementById("emailRadio").disabled = true;
        document.getElementById('emailInput').value='';  
        
        document.getElementById("newpasswordMenu").style.opacity = 0;
        document.getElementById("newpasswordRadio").disabled = true;
        document.getElementById('newpasswordInput').value='';
        
        document.getElementById("usernameMenu").style.opacity = 0;
        document.getElementById("usernameRadio").disabled = true;
        document.getElementById('usernameInput').value='';

        document.getElementById('confirmationText').innerHTML = 'Re-type Phone';        
        document.getElementById('confirmationIcon').innerHTML = '<i class="icon-bell">';
    }, false);

    //PASSWORD    
    document.getElementById("newpasswordRadio").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 0;
        document.getElementById("phoneRadio").disabled = true;
        document.getElementById('phoneInput').value=''; 
        
        document.getElementById("emailMenu").style.opacity = 0;
        document.getElementById("emailRadio").disabled = true;
        document.getElementById('emailInput').value=''; 
        
        document.getElementById("usernameMenu").style.opacity = 0;
        document.getElementById("usernameRadio").disabled = true;
        document.getElementById('usernameInput').value='';  
        
        document.getElementById('confirmationText').innerHTML = 'Re-type New Password';        
        document.getElementById('confirmationIcon').innerHTML = '<i class="icon-star">';
    }, false);
    
    //USERNAME    
    document.getElementById("usernameRadio").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 0;
        document.getElementById("phoneRadio").disabled = true;
        document.getElementById('phoneInput').value='';  
        
        document.getElementById("newpasswordMenu").style.opacity = 0;
        document.getElementById("newpasswordRadio").disabled = true;
        document.getElementById('newpasswordInput').value=''; 
        
        document.getElementById("emailMenu").style.opacity = 0;
        document.getElementById("emailRadio").disabled = true;
        document.getElementById('emailInput').value='';   
        
        document.getElementById('confirmationText').innerHTML = 'Re-type Username';        
        document.getElementById('confirmationIcon').innerHTML = '<i class="icon-user">';
    }, false);
  
    //CLEAR    
    document.getElementById("clear").addEventListener("click", function () {
        document.getElementById("phoneMenu").style.opacity = 1;
        document.getElementById("phoneRadio").disabled = false;
        document.getElementById('phoneInput').value='';  
        
        document.getElementById("newpasswordMenu").style.opacity = 1;
        document.getElementById("newpasswordRadio").disabled = false;
        document.getElementById('newpasswordInput').value='';  
        
        document.getElementById("emailMenu").style.opacity = 1;
        document.getElementById("emailRadio").disabled = false;
        document.getElementById('emailInput').value='';    

        document.getElementById("usernameMenu").style.opacity = 1;
        document.getElementById("usernameRadio").disabled = false;
        document.getElementById('usernameInput').value='';  
        
        document.getElementById("phoneRadio").checked = false;
        document.getElementById("newpasswordRadio").checked = false;
        document.getElementById("emailRadio").checked = false;
        document.getElementById("usernameRadio").checked = false;
        
        document.getElementById('confirmation').value='';  
        document.getElementById('password').value='';  
        
        document.getElementById('confirmationText').innerHTML = 'Re-type Confirmation';        
        document.getElementById('confirmationIcon').innerHTML = '';
    }, false);
  
</script>
