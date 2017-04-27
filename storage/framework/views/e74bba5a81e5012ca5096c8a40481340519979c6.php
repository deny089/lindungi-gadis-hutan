

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            <?php echo e(trans('admin.admin')); ?> 
            	<i class="fa fa-angle-right margin-separator"></i> 
            		<?php echo e(trans('admin.profiles_social')); ?>

            		
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
                  <h3 class="box-title"><?php echo e(trans('admin.profiles_social')); ?></h3>
                </div><!-- /.box-header -->
               
               
               
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="<?php echo e(url('panel/admin/profiles-social')); ?>" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">	
			
					<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Facebook</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->facebook); ?>" name="facebook" class="form-control" placeholder="<?php echo e(trans('admin.url_social')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Twitter</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->twitter); ?>" name="twitter" class="form-control" placeholder="<?php echo e(trans('admin.url_social')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Google Plus</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->googleplus); ?>" name="googleplus" class="form-control" placeholder="<?php echo e(trans('admin.url_social')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Instagram</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($settings->instagram); ?>" name="instagram" class="form-control" placeholder="<?php echo e(trans('admin.url_social')); ?>">
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


<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>