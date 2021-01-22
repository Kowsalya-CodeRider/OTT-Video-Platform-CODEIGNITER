<link rel="stylesheet" href="<?php echo base_url();?>style.css">
<div class="container">
  
<div class="login-form">
										
    <form action="<?=base_url();?>Ott/logincheck" method="post">
        <center><img src="<?php echo base_url();?>images/logo.png" width="100" height="100"></center>
		<br />
		<h4 class="text-center">Admin - Log in</h4> <br /> 
		 <?=isset($error) ? '<center><h5 class="text-danger"><b>In-valid Credentials</b></h5></center>' : ''?> 
		<br />
        <div class="form-group">
            <input type="text" class="form-control" name="a_email" placeholder="Admin Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="a_password" placeholder="Admin Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div>        
    </form>
   
</div>
</div>