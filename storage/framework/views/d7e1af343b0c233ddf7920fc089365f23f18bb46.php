

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
            		Nilai Homepage
            		
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
                  <h3 class="box-title">Nilai Homepage</h3>
                </div><!-- /.box-header -->
               
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="<?php echo e(url('panel/admin/nilai')); ?>" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">	
			
					<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
					<!-- edited cacip -->
					<!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Sampah Terkumpul</label>
                      <div class="col-sm-10">
                         <input type="text" value="<?php echo e($settings->sampah_terkumpul); ?>" name="sampah_terkumpul" class="form-control" placeholder="Jumlah sampah yang terkumpul">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
				  
				  
					<!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Panti Hewan</label>
                      <div class="col-sm-10">
                         <input type="text" value="<?php echo e($settings->panti_hewan); ?>" name="panti_hewan" class="form-control" placeholder="Jumlah Panti Hewan">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
				  
				  
					<!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Hewan Tertangani</label>
                      <div class="col-sm-10">
                         <input type="text" value="<?php echo e($settings->hewan_tertangani); ?>" name="hewan_tertangani" class="form-control" placeholder="Hewan Tertangani">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
				  
				  
					<!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Laporan Alam</label>
                      <div class="col-sm-10">
                         <input type="text" value="<?php echo e($settings->laporan_alam); ?>" name="laporan_alam" class="form-control" placeholder="Laporan alam yang terjadi">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
				  <!-- end edited cacip -->
				  
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
	
	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
        
	</script>
	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>