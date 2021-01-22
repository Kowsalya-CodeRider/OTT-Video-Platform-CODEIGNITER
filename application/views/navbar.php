<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo base_url();?>Ott/movies">
    <img src="<?php echo base_url();?>images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
    <span style="font-size:30px">Webzino Technologies Private Limited</span>
  </a>
  <h4 class="text-primary"><?php echo $this->session->userdata('a_name'); ?> <a href="<?=base_url();?>Ott/logout" class="btn btn-danger">Logout</a></h4>
  
</nav>