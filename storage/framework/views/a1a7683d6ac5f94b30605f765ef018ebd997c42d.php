<!-- ***** Footer ***** -->
    <footer class="footer-main">
    	<div class="container">
    		
    		<div class="row">
    			<div class="col-md-12 text-center">
    				<a href="<?php echo e(url('/')); ?>">
    					<img src="<?php echo e(asset('public/img/watermark.png')); ?>" />
    				</a>
    			   <p class="margin-tp-xs"><?php echo e($settings->description); ?></p>
    			   
    			   <ul class="list-inline">
					   <?php if( $settings->twitter != '' ): ?> 
					   <li><a target="_blank" href="<?php echo e($settings->twitter); ?>" class="ico-social"><i class="fa fa-twitter"></i></a></li>
					   <?php endif; ?>
					 
					 <?php if( $settings->facebook != '' ): ?>   
					   <li><a target="_blank" href="<?php echo e($settings->facebook); ?>" class="ico-social"><i class="fa fa-facebook"></i></a></li>
					 <?php endif; ?>
					
					 <?php if( $settings->instagram != '' ): ?>   
					   <li><a target="_blank" href="<?php echo e($settings->instagram); ?>" class="ico-social"><i class="fa fa-instagram"></i></a></li>
					 <?php endif; ?>
					 
					 <?php if( $settings->linkedin != '' ): ?>   
					   <li><a target="_blank" href="<?php echo e($settings->linkedin); ?>" class="ico-social"><i class="fa fa-linkedin"></i></a></li>
					   <?php endif; ?>
					 
					 <?php if( $settings->googleplus != '' ): ?>   
					   <li><a target="_blank" href="<?php echo e($settings->googleplus); ?>" class="ico-social"><i class="fa fa-google-plus"></i></a></li>
					 <?php endif; ?>
					 </ul >
					 
					 <ul class="list-inline margin-bottom-zero">
					 	<?php $__currentLoopData = \App\Models\Pages::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					 	<li><a href="<?php echo e(url('page',$page->slug)); ?>"><?php echo e($page->title); ?></a></li>
					 	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					 </ul>
					 
    			</div><!-- ./End col-md-* -->
    		</div><!-- ./End Row -->
    	</div><!-- ./End Container -->
    </footer><!-- ***** Footer ***** -->

<footer class="subfooter">
	<div class="container">
	<div class="row">
    			<div class="col-md-12 text-center padding-top-20">
    				<p>&copy; <?php echo e($settings->title); ?> - <?php echo date('Y'); ?> </p>
    			</div><!-- ./End col-md-* -->
	</div>
</div>
</footer>    
