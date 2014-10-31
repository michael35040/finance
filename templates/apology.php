</div>

<style>

p {
background-color: white;
  opacity:.95; 
  filter:alpha(opacity=95); /* For IE8 and earlier */

	font-weight:bold;
	color:red;
	font-size:large;
/*	bottom: 0; 
	height: 0; 
	left: 0;
	right: 0;
	margin: auto; 
	width: 500px;
	
	position: relative;
	top: 50%;
	transform: translate(-50%); */
	

}
</style>

<p>
<br />
<!--<p class="lead text-error">-->
    <?php //echo(htmlspecialchars($message)) ?>
    <?php echo(($message)) ?>
<br /><br />
<a href="javascript:history.go(-1);" class="btn btn-danger btn-medium">Back</a>
<br />  <br />  

</p>
