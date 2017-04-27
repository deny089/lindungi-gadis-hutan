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
            		<?php echo e(trans('admin.edit')); ?>

            		
            		<i class="fa fa-angle-right margin-separator"></i> 
            		<?php echo e($data->name); ?>

          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">
        		
       <div class="row">
       	
       	<div class="col-md-9">
    
        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo e(trans('admin.edit')); ?></h3>
                </div><!-- /.box-header -->
               
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="<?php echo e(url('panel/admin/members/'.$data->id)); ?>" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                	<input type="hidden" name="_method" value="PUT">	
			
					<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.name')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($data->name); ?>" name="name" class="form-control" placeholder="<?php echo e(trans('admin.name')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                 
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('auth.email')); ?></label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($data->email); ?>" name="email" class="form-control" placeholder="<?php echo e(trans('auth.email')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('admin.role')); ?></label>
                      <div class="col-sm-10">
                        <select name="role" class="form-control" >
                      		<option <?php if($data->role == 'normal'): ?> selected="selected" <?php endif; ?> value="normal"><?php echo e(trans('admin.normal')); ?> <?php echo e(trans('admin.normal_user')); ?></option>
                      		<option <?php if($data->role == 'admin'): ?> selected="selected" <?php endif; ?> value="admin"><?php echo e(trans('misc.admin')); ?></option>
                          </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo e(trans('auth.password')); ?></label>
                      <div class="col-sm-10">
                        <input type="password" value="" name="password" class="form-control" placeholder="<?php echo e(trans('admin.password_no_change')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                  	 <a href="<?php echo e(url('panel/admin/members')); ?>" class="btn btn-default"><?php echo e(trans('admin.cancel')); ?></a>
                    <button type="submit" class="btn btn-success pull-right"><?php echo e(trans('admin.save')); ?></button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
              
        </div><!-- /. col-md-9 -->
        
        <div class="col-md-3">
        	
        	<div class="block-block text-center">
        		<img src="<?php echo e(asset('public/avatar').'/'.$data->avatar); ?>" class="thumbnail img-responsive">
        	</div>
        	        	
        	<ol class="list-group">
			<li class="list-group-item"> <?php echo e(trans('admin.registered')); ?> <span class="pull-right color-strong"><?php echo e(date('d M, y', strtotime($data->date))); ?></span></li>
			
			<li class="list-group-item"> <?php echo e(trans('admin.status')); ?> <span class="pull-right color-strong"><?php echo e(ucfirst($data->status)); ?></span></li>
			
			<li class="list-group-item"> <?php echo e(trans('misc.country')); ?> <span class="pull-right color-strong"><?php if( $data->countries_id != '' ): ?> <?php echo e($data->country()->country_name); ?> <?php else: ?> <?php echo e(trans('admin.not_established')); ?> <?php endif; ?></span></li>
			
			<li class="list-group-item"> <?php echo e(trans_choice('misc.campaigns_plural', 0)); ?> <strong class="pull-right color-strong"><?php echo e(App\Helper::formatNumber( $data->campaigns()->count() )); ?></strong></li>
					</ol>
		
		<div class="block-block text-center">
		<?php echo Form::open([
			            'method' => 'DELETE',
			            'route' => ['user.destroy', $data->id],
			            'class' => 'displayInline'
				        ]); ?>

	            	<?php echo Form::submit(trans('admin.delete'), ['data-url' => $data->id, 'class' => 'btn btn-lg btn-danger btn-block margin-bottom-10 actionDelete']); ?>

	        	<?php echo Form::close(); ?>

	        </div>
		
		</div><!-- col-md-3 -->        			        		
        		
        		</div><!-- /.row -->
        		
        	</div><!-- /.content -->
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	
	<!-- icheck -->
	<script src="<?php echo e(asset('public/plugins/iCheck/icheck.min.js')); ?>" type="text/javascript"></script>
	
	<script type="text/javascript">
		
		$(".actionDelete").click(function(e) {
   	e.preventDefault();
   	   	
   	var element = $(this);
	var id     = element.attr('data-url');
	var form    = $(element).parents('form');
	
	element.blur();
	
	swal(
		{   title: "<?php echo e(trans('misc.delete_confirm')); ?>",  
		text: "<?php echo e(trans('admin.delete_user_confirm')); ?>",
		  type: "warning", 
		  showLoaderOnConfirm: true,
		  showCancelButton: true,   
		  confirmButtonColor: "#DD6B55",  
		   confirmButtonText: "<?php echo e(trans('misc.yes_confirm')); ?>",   
		   cancelButtonText: "<?php echo e(trans('misc.cancel_confirm')); ?>",  
		    closeOnConfirm: false, 
		    }, 
		    function(isConfirm){  
		    	 if (isConfirm) {   
		    	 	form.submit(); 
		    	 	//$('#form' + id).submit();
		    	 	}
		    	 });
		    	 
		    	 
		 });
		 
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
	
	</script>
	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>