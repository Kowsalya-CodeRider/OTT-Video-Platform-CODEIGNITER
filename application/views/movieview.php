
<div class="container border border-success">
 	<h4 class="text-center"><b>Movie : </b><?php echo $movie->m_name;?></h4>
	<hr />
	<center>
	<?php if($movie->is_link==1) { ?>
	<iframe width="600" height="400" src="<?php echo YOUTUBE.$movie->m_vedio_link.'?autoplay=1&mute=1';?>" allow='autoplay' frameborder="0">
	</iframe>
	<?php } else { ?>
	<video width="600" height="400" controls autoplay muted>
  <source src="<?=base_url().'movies/'.$movie->m_vedio_link;?>" type="video/mp4">
Your browser does not support the video tag.
</video>
	<?php } ?>
	</center>
	<hr />
	 <form action="<?=base_url();?>Ott/insertmovie" method="post">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label text-right">Movie Name </label>
			<div class="col-sm-8">
			<input type="text" class="form-control" name="m_name" value="<?=$movie->m_name;?>" readonly>
			</div>
		</div>
        <div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Description </label>
           <div class="col-sm-8">
		   <textarea class="form-control" name="m_description" readonly><?=$movie->m_description;?></textarea>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Genre </label>
			<div class="col-sm-8">
            <input type="text" class="form-control" name="m_name" value="<?=$movie->g_name;?>" readonly>
			</div>
        </div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Language </label>
			<div class="col-sm-8">
			<input type="text" class="form-control" name="m_name" value="<?=$movie->m_language==1?'English' : 'Hindi';?>" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Year </label>
            <div class="col-sm-8">
			<input type="text" class="form-control" name="m_name" value="<?=$movie->m_year;?>" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Status </label>
            <div class="col-sm-8">
			<input type="text" class="form-control" name="m_name" value="<?=$movie->m_status;?>" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Share </label>
            <div class="col-sm-8">
			<a href="http://www.facebook.com/sharer.php?u=<?=$movie->m_vedio_link;?>" target="_blank"><i class="fa fa-facebook btn btn-info" data-toggle="tooltip" data-placement="top"  title="Share Facebook" aria-hidden="true" ></i></a>	
			<a href="http://twitter.com/share?text=<?=$movie->m_name;?>&url=<?=$movie->m_vedio_link;?>" target="_blank"><i class="fa fa-twitter btn btn-warning" data-toggle="tooltip" data-placement="top"  title="Share Twitter" aria-hidden="true" ></i></a>	
			<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$movie->m_vedio_link;?>" target="_blank"><i class="fa fa-linkedin btn btn-primary" data-toggle="tooltip" data-placement="top"  title="Share Facebook" aria-hidden="true" ></i></a>	
			<a href="https://plus.google.com/share?url=<?=$movie->m_vedio_link;?>" target="_blank"><i class="fa fa-google btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Share Facebook" aria-hidden="true" ></i></a>	
			
			</div>
		</div>
		
              
    </form>
</div>
<br />