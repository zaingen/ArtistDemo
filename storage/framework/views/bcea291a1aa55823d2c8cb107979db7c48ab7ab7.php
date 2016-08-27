<?php $__env->startSection('content'); ?>
<div id="page-content-wrapper" class="">
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <?php if(Session::has('message')): ?>
                <p class="<?php echo e(Session::get('alert-class')); ?>"><?php echo e(Session::get('message')); ?></p>
            <?php endif; ?>    
	        <div class="result_wrap">
	        	<?php var_dump($album_tracks);?>
	        	
	        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
$(document).ready(function(){
	var albumid='<?php echo $album_id; ?>';
	console.log('welcome to the album tracks page');
	var getAlbumTracks = function (albumid) {
        $.ajax({
            url: 'https://api.spotify.com/v1/albums/'+albumid+'/tracks',
            success: function (response) {
            	console.log(response);
            }
        });
    };
    //getAlbumTracks(albumid);
});
</script>
<?php $__env->stopPush(); ?>




<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>