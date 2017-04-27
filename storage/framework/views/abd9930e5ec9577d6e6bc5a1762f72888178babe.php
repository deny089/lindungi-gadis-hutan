

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/plugins/iCheck/all.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            <?php echo e(trans('admin.admin')); ?> 
            	<i class="fa fa-angle-right margin-separator"></i> 
            		<?php echo e(trans('admin.pages')); ?>

            			<i class="fa fa-angle-right margin-separator"></i> 
            				<?php echo e(trans('misc.add_new')); ?>

          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">
        		
        		<div class="row">
    
        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo e(trans('misc.add_new')); ?></h3>
                </div><!-- /.box-header -->
               
               
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo e(url('panel/admin/pages')); ?>">
                	
                	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">	
			
					<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.title')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e(old('title')); ?>" name="title" class="form-control" placeholder="<?php echo e(trans('admin.title')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.slug')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e(old('slug')); ?>" name="slug" class="form-control" placeholder="<?php echo e(trans('admin.slug')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.show_navbar')); ?></label>
                      <div class="col-sm-10">
                      	
                      	<div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="show_navbar" value="1">
                          <?php echo e(trans('misc.yes')); ?>

                        </label>
                      </div>
                      
                      <div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="show_navbar" checked="checked" value="0">
                          <?php echo e(trans('misc.no')); ?>

                        </label>
                      </div>
                      
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.content')); ?></label>
                      <div class="col-sm-10">
                      	
                      	<textarea name="content"rows="5" cols="40" id="content" class="form-control" placeholder="<?php echo e(trans('admin.content')); ?>"><?php echo e(old('content')); ?></textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <a href="<?php echo e(url('panel/admin/pages')); ?>" class="btn btn-default"><?php echo e(trans('admin.cancel')); ?></a>
                    <button type="submit" class="btn btn-success pull-right"><?php echo e(trans('admin.save')); ?></button>
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
<script src="<?php echo e(asset('public/plugins/iCheck/icheck.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/plugins/ckeditor/ckeditor.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
		$(function () {
	    // Replace the <textarea id="editor1"> with a CKEditor
	    // instance, using default configuration.
	    	CKEDITOR.replace('content');
	 	 });
	 	 
	 	  //Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
	</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>