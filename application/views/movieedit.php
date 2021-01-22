
<div class="container border border-success">
 	<div class="form-group"><br />
	<h4 class="text-center">Movie Details Update</h4>
		 <?=isset($error) ? '<center><h5 class="text-danger"><b>In-valid Credentials</b></h5></center>' : ''?> 
	</div>
		<hr />							
    <form action="<?=base_url();?>Ott/editmovie" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label text-right">Movie Name </label>
			<div class="col-sm-8">
			<input type="text" class="form-control" name="m_name" value="<?=$movie->m_name;?>" required="required">
			</div>
		</div>
        <div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Description </label>
           <div class="col-sm-8">
		   <textarea class="form-control" name="m_description" required="required"><?=$movie->m_description;?></textarea>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Genre </label>
			<div class="col-sm-8">
            <select class="form-control" name="m_genre" required="required">
			<?php foreach($genre as $genre) { ?>
			<option value="<?php echo $genre['g_id'];?>" <?=$movie->m_genre==$genre['g_id'] ? 'selected' : '' ?>><?php echo $genre['g_name'];?></option>
			<?php } ?>
			</select>
			</div>
        </div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Language </label>
			<div class="col-sm-8">
			<select class="form-control" name="m_language" required="required">
			<option value="1" <?=$movie->m_language==1 ? 'selected' : '' ?>>English</option>
			<option value="2" <?=$movie->m_language==2 ? 'selected' : '' ?>>Hindi</option>			
			</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Year </label>
            <div class="col-sm-8">
			<input type="text" class="form-control" name="m_year" value="<?=$movie->m_year;?>" required="required">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Status </label>
            <div class="col-sm-8">
			<input type="text" class="form-control" name="m_status" value="<?=$movie->m_status;?>" required="required">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label text-right">Movie Vedio Files / Link </label>
			<div class="col-sm-8">			
			<input type="text" class="form-control" name="m_vedio_link_1" id="m_vedio_link_1" value="<?=$movie->is_link==1 ? $movie->m_vedio_link : ''?>">			
			</div>
			<div class="col-sm-12"><br /><p class="text-center">[or]<br /></p></div>
			<div class="col-sm-4"></div>
			<div class="col-sm-8">			
			<label><b>Movie Vedio File : </b> <?=$movie->m_vedio_link;?></label><br />
			<input type="file" class="form-control" name="m_vedio_link" id="m_vedio_link" accept=".mp4">
			<input type="hidden" name="movie_file" id="movie_file" value="<?=$movie->m_vedio_link;?>">
			<br />
			<label><b>Movie Thumnail image : </b> <?=$movie->m_thumdata;?></label>
			<br />
			<input type="file" class="form-control" name="m_thumbnail" id="m_thumbnail" accept="jpg|jpeg|png|gif">
			<input type="hidden" name="movie_thumdata" id="movie_thumdata" value="<?=$movie->m_thumdata;?>">
			</div>
			
			
			
			<div class="col-sm-12"><br />
			<center><span class="text-danger" id="errorresult"></span></center>
			</div>
		</div>
		<hr />	
        <div class="form-group">
            <center><input type="submit" id="movie_add" class="btn btn-success" value="Update Movie"></center>
        </div>
              
    </form>
   

</div>
<br />
<script>
$(document).ready(function(){
	$('#movie_add').on('click', function(e){ 		
		var vedio_link = $('#m_vedio_link').val();
		var vedio_link_1 = $('#m_vedio_link_1').val();
		var movie_file = $('#movie_file').val();
		if(vedio_link=='' && vedio_link_1=='' && movie_file=='')
		{	
			$('#errorresult').html('<b>Movie Details Missing!</b>');
			e.preventDefault();
		}
		else if(vedio_link!='' && vedio_link_1!='') 
		{
			$('#errorresult').html('<b>Upload vedio or insert link - Any one</b>');
			e.preventDefault();
		}
});
});
</script>