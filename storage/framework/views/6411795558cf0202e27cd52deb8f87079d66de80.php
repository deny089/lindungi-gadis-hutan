<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/plugins/iCheck/all.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('public/plugins/tagsinput/jquery.tagsinput.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            <?php echo e(trans('admin.admin')); ?> 
            	<i class="fa fa-angle-right margin-separator"></i> 
            		<?php echo e(trans('admin.general_settings')); ?>

            		
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">
        	
        	 <?php if(Session::has('success_message')): ?>
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		       <i class="fa fa-check margin-separator"></i> <?php echo e(Session::get('success_message')); ?>	        
		    </div>
		<?php endif; ?>

        	<div class="content">
        		
        		<div class="row">
    
        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo e(trans('admin.general_settings')); ?></h3>
                </div><!-- /.box-header -->
               
               
               
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="<?php echo e(url('panel/admin/settings')); ?>" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">	
			
					<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.name_site')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->title); ?>" name="title" class="form-control" placeholder="<?php echo e(trans('admin.title')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.welcome_text')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->welcome_text); ?>" name="welcome_text" class="form-control" placeholder="<?php echo e(trans('admin.welcome_text')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.welcome_subtitle')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->welcome_subtitle); ?>" name="welcome_subtitle" class="form-control" placeholder="<?php echo e(trans('admin.welcome_subtitle')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.keywords')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->keywords); ?>" id="tagInput" name="keywords" class="form-control select2">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.description')); ?></label>
                      <div class="col-sm-10">
                      	
                      	<textarea name="description" rows="4" id="description" class="form-control" placeholder="<?php echo e(trans('admin.description')); ?>"><?php echo e($settings->description); ?></textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.email_no_reply')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->email_no_reply); ?>" name="email_no_reply" class="form-control" placeholder="<?php echo e(trans('admin.email_no_reply')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.email_admin')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->email_admin); ?>" name="email_admin" class="form-control" placeholder="<?php echo e(trans('admin.email_admin')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success"><?php echo e(trans('admin.save')); ?></button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
        			        		
        		</div><!-- /.row -->
        		
        	</div><!-- /.content -->
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	
	<!-- icheck -->
	<script src="<?php echo e(asset('public/plugins/iCheck/icheck.min.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset('public/plugins/tagsinput/jquery.tagsinput.min.js')); ?>" type="text/javascript"></script>
	
	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
        
        $("#tagInput").tagsInput({
         
		 'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
		 'width':'auto',
		 'height':'auto',
	     'removeWithBackspace' : true,
	     'minChars' : 3,
	     'maxChars' : 25,
	     'defaultText':'<?php echo e(trans("misc.add_tag")); ?>',
	     /*onChange: function() {
         	var input = $(this).siblings('.tagsinput');
         	var maxLen = 4;
			
			if( input.children('span.tag').length >= maxLen){
			        input.children('div').hide();
			    }
			    else{
			        input.children('div').show();
			    }
			},*/
	});
	
	</script>
	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>