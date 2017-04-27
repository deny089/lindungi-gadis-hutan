<!-- ***** Footer ***** -->
    <footer class="footer-main">
    	<div class="container">

        
    		<div class="row">
    			<div class="col-md-4">
    				<a href="<?php echo e(url('/')); ?>">
    					<img src="<?php echo e(asset('public/img/watermark.PNG')); ?>" />
    				</a>
    			   <p class="margin-tp-xs"><?php echo e($settings->description); ?></p>
    			   
    			   <ul class="list-inline">
					   <?php if( $settings->twitter != '' ): ?> 
					   <li><a href="<?php echo e($settings->twitter); ?>" class="ico-social"><i class="fa fa-twitter"></i></a></li>
					   <?php endif; ?>
					 
					 <?php if( $settings->facebook != '' ): ?>   
					   <li><a href="<?php echo e($settings->facebook); ?>" class="ico-social"><i class="fa fa-facebook"></i></a></li>
					 <?php endif; ?>
					
					 <?php if( $settings->instagram != '' ): ?>   
					   <li><a href="<?php echo e($settings->instagram); ?>" class="ico-social"><i class="fa fa-instagram"></i></a></li>
					 <?php endif; ?>
					 
					 <?php if( $settings->linkedin != '' ): ?>   
					   <li><a href="<?php echo e($settings->linkedin); ?>" class="ico-social"><i class="fa fa-linkedin"></i></a></li>
					   <?php endif; ?>
					 
					 <?php if( $settings->googleplus != '' ): ?>   
					   <li><a href="<?php echo e($settings->googleplus); ?>" class="ico-social"><i class="fa fa-google-plus"></i></a></li>
					 <?php endif; ?>
					 </ul >
					 
    			</div><!-- ./End col-md-* -->

    			<div class="col-md-4 margin-tp-xs"></div>
    			
    			<div class="col-md-2 margin-tp-xs">
    				<h4 class="margin-top-zero"><?php echo e(trans('misc.about')); ?></h4>
    				<ul class="list-unstyled">
    					<?php $__currentLoopData = App\Models\Pages::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        			<li><a class="link-footer" href="<?php echo e(url('/page',$page->slug)); ?>"><?php echo e($page->title); ?></a></li>
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    				</ul>
    			</div><!-- ./End col-md-* -->
    			
    			
    			<!-- edited cacip hapus categori di footer -->
    			
    			<div class="col-md-2 margin-tp-xs">
    				<h4 class="margin-top-zero"><?php echo e(trans('misc.links')); ?></h4>
    				<ul class="list-unstyled">
        			
        			<li>
        				<a class="link-footer" href="<?php echo e(url('/')); ?>"><?php echo e(trans('misc.campaigns')); ?></a>
        			</li>
        			
        			<?php if( Auth::guest() ): ?>
        			<li>
        				<a class="link-footer" href="<?php echo e(url('login')); ?>">
        					<?php echo e(trans('auth.login')); ?>

        				</a>
        				</li>

        				
        				<?php else: ?>
        				<li>
	          		 		<a href="<?php echo e(url('account')); ?>" class="link-footer">
	          		 			<?php echo e(trans('users.account_settings')); ?>

	          		 		</a>
	          		 		</li>
	          		 		
	          		 		<li>
	          		 			<a href="<?php echo e(url('logout')); ?>" class="logout link-footer">
	          		 				<?php echo e(trans('users.logout')); ?>

	          		 			</a>
	          		 		</li>
        				<?php endif; ?>
        				
    				</ul>
    			</div><!-- ./End col-md-* -->
    		</div><!-- ./End Row -->
    	</div><!-- ./End Container -->
    </footer><!-- ***** Footer ***** -->

<footer class="subfooter">
	<div class="container">
	<div class="row">
    			<div class="col-md-12 text-center padding-top-20">
    				<p>&copy; <?php echo e($settings->title); ?> - <?php echo date('Y'); ?></p>
    			</div><!-- ./End col-md-* -->
	</div>
</div>
</footer>    
