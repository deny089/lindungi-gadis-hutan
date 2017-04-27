<?php $settings = App\Models\AdminSettings::first(); ?>


<?php $__env->startSection('title'); ?><?php echo e(trans('misc.create_campaign').' - '); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/plugins/iCheck/all.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<style>
      #map {
        height: 100%;
        border: 1px solid #DDD; 
        width:600px;
        height: 300px;
        float:left;  
        margin: 0px 0 0 10px;
        -webkit-box-shadow: #AAA 0px 0px 15px;
      }
      
    </style>
    <script src="https://maps.google.com/maps/api/js?v=3.5&key=AIzaSyCFUkpUT8OQ_2kblunHrU8tH_raZg4yOAo" type="text/javascript"></script>

<?php $__env->startSection('content'); ?>

 <div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
      	<h2 class="title-site">Laporkan Masalah</h2>
      </div>
    </div>
  
<div class="container margin-bottom-40 padding-top-40">
	<div class="row">
		
	<!-- col-md-8 -->
	<div class="col-md-12">
		<div class="wrap-center center-block">
			<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
    <!-- form start -->
    <form method="POST" action="<?php echo e(url('home/lapor')); ?>" enctype="multipart/form-data" id="formUpload">
    	
	<!-- Start Form Group -->
        <div class="form-group">
          <label>Judul</label>
            <input type="text" value="<?php echo e(old('title')); ?>" name="title" id="title" class="form-control" placeholder="Judul masalah di lingkungan Anda">
        </div><!-- /.form-group-->
         
      <!-- Start Form Group -->
        <div class="form-group">
          <label>Lokasi</label>
            <input type="text" value="<?php echo e(old('location')); ?>" name="location" class="form-control" placeholder="location">
        </div><!-- /.form-group-->

      
      <div class="form-group">
          <label>Deskripsi</label>
          	<textarea name="description" rows="4" id="description" class="form-control tinymce-txt" placeholder="Ceritakan masalah lingkungan yang terjadi"><?php echo e(old('description')); ?></textarea>
        </div>
        
	<!-- map -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Maps Lokasi</label>
          <p>Tunjukkan letak lokasi masalah Anda</p>
          <div  class="col-sm-10 col-md-9 col-sx-6" id="map"></div>
        </div>

        <div class="form-group">
          <label >Latitude</label>
          <input type="text" value="<?php echo e(old('lat')); ?>"  class="form-control " name="lat" id="lat">
        </div>

        <div class="form-group">
          <label>Longitude</label>
          <input type="text" value="<?php echo e(old('lng')); ?>"  class="form-control " name="lng" id="lng">
        </div>
      <!-- end map -->

      <div class="form-group checkbox icheck">
		<label class="margin-zero">
			<input class="no-show" name="anonymous" type="checkbox" value="1">
			<span class="margin-lft5 keep-login-title">Tampilkan Nama Anda</span>
		</label>
	</div> 

        <!-- Alert -->
        <div class="alert alert-danger display-none" id="dangerAlert">
				<ul class="list-unstyled" id="showErrors"></ul>
			</div><!-- Alert -->
    
      <div class="box-footer">
      	<hr />
        <button type="submit" id="buttonFormSubmit" class="btn btn-block btn-lg btn-main custom-rounded">Kirim</button>
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
	<script src="<?php echo e(asset('public/plugins/datepicker/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset('public/js/lokasi.js')); ?>" type="text/javascript"></script>
	
	<script type="text/javascript">
    

    $(document).ready(function() {

    
    $('input').iCheck({
	  	checkboxClass: 'icheckbox_square-red',
    	radioClass: 'iradio_square-red',
	    increaseArea: '20%' // optional
	  });
	  
});

	//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
        

	

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
    //visualblocks_default_state: true,
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