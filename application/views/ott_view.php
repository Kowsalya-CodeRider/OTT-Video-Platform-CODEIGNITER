
 <h2 class="text-center text-white bg-dark">Webzino - Movies</h2>
 
<div class="container">
  <div align="right"><a href="<?=base_url();?>Ott/add_movie" class="btn btn-success">Add Movie</a></div><br />
  <div class="row">
	<?php
	if(!empty($movies))
	{
	foreach($movies as $movie) {
	?>
	<div class="col-md-4">
	  <div class="card">
		<div class="card-header" onclick="movieview(<?php echo $movie['m_id'];?>)">
		<center>
	    <?php if($movie['is_link']==1) { ?>
		<img src="<?php echo THUMBNAIL;?><?=$movie['m_vedio_link'];?>/default.jpg ">
		<?php } else { ?>
		<img src="<?=base_url();?>images/<?=$movie['m_thumdata'];?>" width="120" height="90">
		<?php } ?>
		</center>
		</div>
		<div class="card-body">
		  <p class="card-title"><b>Movie Name : </b><?=$movie['m_name'];?></p>
		  <p class="card-text"><b>Genre : </b><?=$movie['g_name'];?></p>
		</div>
		<div class="card-footer bg-light">
		 <span onclick="movieview(<?php echo $movie['m_id'];?>)"><i class="fa fa-eye btn btn-info" data-toggle="tooltip" data-placement="top"  title="Movie Detail View" aria-hidden="true" ></i></span>		
		 <a href="<?=base_url();?>Ott/movieupdate/<?=$movie['m_id'];?>" target="_blank"><i class="fa fa-pencil btn btn-warning" data-toggle="tooltip" data-placement="top"  title="Movie Detail Edit" aria-hidden="true" ></i></span></a>		
		 
		 <span style="float:right" onclick="moviedelete(<?php echo $movie['m_id'];?>)"><i class="fa fa-trash btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Movie Delete" aria-hidden="true" ></i></span>
		</div>
	  </div>
	  <br>
	</div>
	<?php } } else { ?>
	<div class="col-md-12">
	<center><h4 class="text-success">Welcome to Webzino OTT</h4>
	<p>100+ movies are there! Enjoy your day with Best Enteraning platform in Digital World</p>
	</center>
	</div>
	<?php } ?>
	</div>
</div>
<script>
function moviedelete(mid)
{
	var confirmation = confirm("Are you sure you want to remove the Movie?");

    if (confirmation) {
		
		$.ajax({
            type: 'post',
            url: '<?php echo base_url();?>Ott/deletemovie',
            data: {mid : mid},
            success: function (result) {
               alert('Movie Deleted Successfully!');
			   location.reload();
            }
          });
        
    }
}
function movieview(mid)
{
	window.open('<?php echo base_url();?>Ott/viewmovie/'+mid, '_blank');
}
</script>
