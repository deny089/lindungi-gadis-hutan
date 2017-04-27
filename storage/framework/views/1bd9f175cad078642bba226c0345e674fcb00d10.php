

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
            		Partnership
            			<i class="fa fa-angle-right margin-separator"></i> 
            				<?php echo e(trans('admin.edit')); ?>

          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">
        		
        		<div class="row">
    
        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo e(trans('admin.edit')); ?></h3>
                </div><!-- /.box-header -->
               
               
               
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo e(url('panel/admin/media/update')); ?>" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">	
                	<input type="hidden" name="id" value="<?php echo e($media->id); ?>">	
			
					<?php echo $__env->make('errors.errors-forms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nama Media</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($media->nama); ?>" name="nama" class="form-control" placeholder="<?php echo e(trans('admin.nama')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Link Website Media</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($media->link); ?>" name="link" class="form-control" placeholder="<?php echo e(trans('admin.link')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Deskripsi</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo e($media->deskripsi); ?>" name="deskripsi" class="form-control" placeholder="<?php echo e(trans('admin.deskripsi')); ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Gambar logo media untuk ditampilkan</label>
                      <div class="col-sm-10">
                      	<div class="btn btn-info box-file">
                      		<input type="file" accept="image/*" name="gambar" />
                      		<i class="glyphicon glyphicon-cloud-upload myicon-right"></i> <?php echo e(trans('misc.replace_image')); ?>

                      		</div>
                      	
                      <p class="help-block"><?php echo e(trans('admin.thumbnail_desc')); ?></p>
                      
                      <div class="btn-default btn-lg btn-border btn-block pull-left text-left display-none fileContainer">
					     	<i class="glyphicon glyphicon-paperclip myicon-right"></i>
					     	<small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-attach-file-2 pull-right" title="<?php echo e(trans('misc.delete')); ?>"></i>
					     </div>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                                    
                  <div class="box-footer">
                    <a href="<?php echo e(url('panel/admin/media')); ?>" class="btn btn-default"><?php echo e(trans('admin.cancel')); ?></a>
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


<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>