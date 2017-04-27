<?php $settings = App\Models\AdminSettings::first(); ?>


<?php $__env->startSection('title'); ?><?php echo e(trans('misc.edit_campaign').' - '); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/plugins/iCheck/all.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 
 <div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
      	<h2 class="title-site"><?php echo e(trans('misc.edit_campaign')); ?></h2>
      	<p class="subtitle-site"><strong><?php echo e($data->title); ?></strong></p>
      </div>
    </div>
  
<div class="container margin-bottom-40 padding-top-40">
	<div class="row">
		
	<!-- col-md-8 -->
	<div class="col-md-12">
		<div class="wrap-center center-block">
			<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			
    <!-- form start -->
    <form method="POST" action="" enctype="multipart/form-data" id="formUpdate">
    	
    	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    	<input type="hidden" name="id" value="<?php echo e($data->id); ?>">
    	
		<div class="filer-input-dragDrop position-relative hoverClass" id="draggable">
			<input type="file" accept="image/*" name="photo" id="filePhoto">
			
			<!-- previewPhoto -->
			<div class="previewPhoto" style='display: block; background-image: url("<?php echo e(asset('public/campaigns/large/'.$data->large_image)); ?>");'>
				
				<div class="btn btn-danger btn-sm btn-remove-photo" id="removePhoto">
					<i class="fa fa-trash myicon-right"></i> <?php echo e(trans('misc.delete')); ?>

					</div>
					
			</div><!-- previewPhoto -->
			
			<div class="filer-input-inner">
				<div class="filer-input-icon">
					<i class="fa fa-cloud-upload"></i>
					</div>
					<div class="filer-input-text">
						<h3 class="margin-bottom-10"><?php echo e(trans('misc.click_select_image')); ?></h3>
						<h3><?php echo e(trans('misc.max_size')); ?>: <?php echo e(App\Helper::formatBytes($settings->file_size_allowed * 1024) .' - '.$settings->min_width_height_image); ?> </h3>
					</div>
				</div>
			</div>
			
                 <!-- Start Form Group -->
                    <div class="form-group">
                      <label><?php echo e(trans('misc.campaign_title')); ?></label>
                        <input type="text" value="<?php echo e($data->title); ?>" name="title" id="title" class="form-control" placeholder="<?php echo e(trans('misc.campaign_title')); ?>">
                    </div><!-- /.form-group-->
                    
                    <!-- Start Form Group -->
					<!-- edited cacip (unblock jika pakai kategori)
                    <div class="form-group">
                      <label><?php echo e(trans('misc.choose_a_category')); ?></label>
                      	<select name="categories_id" class="form-control">
                      		<option value=""><?php echo e(trans('misc.select_one')); ?></option>
                      	<?php $__currentLoopData = App\Models\Categories::where('mode','on')->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 	
                            <option <?php if( $category->id == $data->categories_id ): ?> selected="selected" <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                  </div>
				  -->
				  <!-- /.form-group-->
                  <div class="form-group">
                      <label>Pilih Pohon untuk ditanam</label>
                      	<select name="id_pohon" class="form-control">
                      		<option value="">Pilih Salah Satu Pohon</option>
                      	<?php $__currentLoopData = App\Models\Pohon::orderBy('id_pohon')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pohon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 	
                            <option <?php if( $pohon->id_pohon == $data->id_pohon ): ?> selected="selected" <?php endif; ?> value="<?php echo e($pohon->id_pohon); ?>"><?php echo e($pohon->nama); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                  </div>
				  
				  
                  <div class="form-group">
				    <label><?php echo e(trans('misc.campaign_goal')); ?></label>
				    <div class="input-group">
				      <div class="input-group-addon addon-dollar"><?php echo e($settings->kode_pohon); ?></div>
				      <input type="number" min="1" class="form-control" name="goal" id="onlyNumber" value="<?php echo e($data->goal); ?>" placeholder="10000">
				    </div>
				  </div>
                  
                  <!-- Start Form Group -->
                    <div class="form-group">
                      <label><?php echo e(trans('misc.location')); ?></label>
                        <input type="text" value="<?php echo e($data->location); ?>" name="location" class="form-control" placeholder="<?php echo e(trans('misc.location')); ?>">
                    </div><!-- /.form-group-->

                  
                  <div class="form-group">
                      <label><?php echo e(trans('misc.campaign_description')); ?></label>
                      	<textarea name="description" rows="4" id="description" class="form-control tinymce-txt" placeholder="<?php echo e(trans('misc.campaign_description_placeholder')); ?>"><?php echo e($data->description); ?></textarea>
                    </div>
                    
             <div class="form-group checkbox icheck">
				<label class="margin-zero">
					<input class="no-show" name="finish_campaign" type="checkbox" value="1">
					<span class="margin-lft5 keep-login-title"><?php echo e(trans('misc.finish_campaign')); ?></span>
			</label>
		</div>
                    
                    <!-- Alert -->
                    <div class="alert alert-danger display-none" id="dangerAlert">
							<ul class="list-unstyled" id="showErrors"></ul>
						</div><!-- Alert -->
						
						                    <!-- Alert -->
                    <div class="alert alert-success display-none" id="successAlert">
							<ul class="list-unstyled" id="success_update">
								<li><?php echo e(trans('misc.success_update')); ?> <a href="<?php echo e(url('campaign',$data->id)); ?>" class="btn btn-default btn-sm"><?php echo e(trans('misc.view_campaign')); ?></a></li>
							</ul>
						</div><!-- Alert -->

                
                  <div class="box-footer">
                  	<hr />
                    <button type="submit" id="buttonFormUpdate" class="btn btn-block btn-lg btn-main custom-rounded"><?php echo e(trans('misc.edit_campaign')); ?></button>
                    
                    <div class="btn-block text-center margin-top-20">
			           		<a href="<?php echo e(url('campaign',$data->id)); ?>" class="text-muted">
			           		<i class="fa fa-long-arrow-left"></i>	<?php echo e(trans('auth.back')); ?></a>
			           </div>

                  </div><!-- /.box-footer -->
                  						
                </form>
               
               </div><!-- wrap-center -->
		</div><!-- col-md-12-->
				
	</div><!-- row -->
</div><!-- container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('public/plugins/iCheck/icheck.min.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset('public/plugins/tinymce/tinymce.min.js')); ?>" type="text/javascript"></script>
	
	<script type="text/javascript">
    
    $(document).ready(function() {
	
    $("#onlyNumber").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    $('input').iCheck({
	  	checkboxClass: 'icheckbox_square-red',
    	radioClass: 'iradio_square-red',
	    increaseArea: '20%' // optional
	  });
	  
});

 $('input').iCheck({
	  	checkboxClass: 'icheckbox_square-red',
    	radioClass: 'iradio_square-red',
	    increaseArea: '20%' // optional
	  });
	  
	//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
        
$('#removePhoto').click(function(){
	 	$('#filePhoto').val('');
	 	$('.previewPhoto').css({backgroundImage: 'none'}).hide();
	 	$('.filer-input-dragDrop').removeClass('hoverClass');
	 });
	 	
//================== START FILE IMAGE FILE READER
$("#filePhoto").on('change', function(){
	
	var loaded = false;
	if(window.File && window.FileReader && window.FileList && window.Blob){
		if($(this).val()){ //check empty input filed
			oFReader = new FileReader(), rFilter = /^(?:image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/png|image)$/i;
			if($(this)[0].files.length === 0){return}
			
			
			var oFile = $(this)[0].files[0];
			var fsize = $(this)[0].files[0].size; //get file size
			var ftype = $(this)[0].files[0].type; // get file type
			
			
			if(!rFilter.test(oFile.type)) {
				$('#filePhoto').val('');
				$('.popout').addClass('popout-error').html("<?php echo e(trans('misc.formats_available')); ?>").fadeIn(500).delay(5000).fadeOut();
				return false;
			}
			
			var allowed_file_size = <?php echo e($settings->file_size_allowed * 1024); ?>;	
						
			if(fsize>allowed_file_size){
				$('#filePhoto').val('');
				$('.popout').addClass('popout-error').html("<?php echo e(trans('misc.max_size').': '.App\Helper::formatBytes($settings->file_size_allowed * 1024)); ?>").fadeIn(500).delay(5000).fadeOut();
				return false;
			}
		<?php $dimensions = explode('x',$settings->min_width_height_image); ?>
			
			oFReader.onload = function (e) {
				
				var image = new Image();
			    image.src = oFReader.result;
			    
				image.onload = function() {
			    	
			    	if( image.width < <?php echo e($dimensions[0]); ?>) {
			    		$('#filePhoto').val('');
			    		$('.popout').addClass('popout-error').html("<?php echo e(trans('misc.width_min',['data' => $dimensions[0]])); ?>").fadeIn(500).delay(5000).fadeOut();
			    		return false;
			    	} 
			    	
			    	if( image.height < <?php echo e($dimensions[1]); ?> ) {
			    		$('#filePhoto').val('');
			    		$('.popout').addClass('popout-error').html("<?php echo e(trans('misc.height_min',['data' => $dimensions[1]])); ?>").fadeIn(500).delay(5000).fadeOut();
			    		return false;
			    	} 
			    	
			    	$('.previewPhoto').css({backgroundImage: 'url('+e.target.result+')'}).show();
			    	$('.filer-input-dragDrop').addClass('hoverClass');
			    	var _filname =  oFile.name;
					var fileName = _filname.substr(0, _filname.lastIndexOf('.'));
			    };// <<--- image.onload

				
           }
           
           oFReader.readAsDataURL($(this)[0].files[0]);
			
		}
	} else{
		$('.popout').html('Can\'t upload! Your browser does not support File API! Try again with modern browsers like Chrome or Firefox.').fadeIn(500).delay(5000).fadeOut();
		return false;
	}
});

		$('input[type="file"]').attr('title', window.URL ? ' ' : '');
		
		function initTinymce() {
			tinymce.remove('.tinymce-txt');		
tinymce.init({
  selector: '.tinymce-txt',
  relative_urls: false,
  resize: true,
  menubar:false,
    statusbar: false,
    forced_root_block : false,
    extended_valid_elements : "span[!class]", 
  setup: function(editor){
  	        
    	editor.on('change',function(){
    		editor.save();
    	});
   },   
  theme: 'modern',
  height: 150,
  plugins: [
    'advlist autolink autoresize lists link image charmap preview hr anchor pagebreak', //image
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save code contextmenu directionality', //
    'emoticons template paste textcolor colorpicker textpattern ' //imagetools
  ],
  toolbar1: 'undo redo | bold italic underline strikethrough charmap | bullist numlist  | link | image',
  image_advtab: true,
 });
 
}

initTinymce();	
	
	</script>
	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>