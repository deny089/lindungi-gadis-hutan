<ul class="nav nav-pills nav-stacked">
			<li class="margin-bottom-5">
				<!-- **** list-group-item **** -->	
		  <a href="<?php echo e(url('account')); ?>" class="list-group-item <?php if(Request::is('account')): ?>active <?php endif; ?>"> 
		  	<i class="icon icon-pencil myicon-right"></i> <?php echo e(trans('users.account_settings')); ?> 
		  	</a> <!-- **** ./ list-group-item **** -->
			</li>
				
		  	<li class="margin-bottom-5">
		  		<!-- **** list-group-item **** -->	
		  <a href="<?php echo e(url('account/password')); ?>" class="list-group-item <?php if(Request::is('account/password')): ?>active <?php endif; ?>"> 
		  	<i class="icon icon-lock myicon-right"></i> <?php echo e(trans('auth.password')); ?> 
		  	</a> <!-- **** ./ list-group-item **** -->
		  	</li>
		  	
		  	<li class="margin-bottom-5">
		  		<!-- **** list-group-item **** -->	
		  <a href="<?php echo e(url('account/campaigns')); ?>" class="list-group-item <?php if(Request::is('account/campaigns')): ?>active <?php endif; ?>"> 
		  	<i class="ion ion-speakerphone myicon-right"></i> <?php echo e(trans('misc.campaigns')); ?> 
		  	</a> <!-- **** ./ list-group-item **** -->
		  	</li>
		  	
		  	<li class="margin-bottom-5">
		  		<!-- **** list-group-item **** -->	
		  <a href="<?php echo e(url('account/donations')); ?>" class="list-group-item <?php if(Request::is('account/donations')): ?>active <?php endif; ?>"> 
		  	<i class="ion ion-social-usd myicon-right"></i> <?php echo e(trans('misc.donations')); ?> 
		  	</a> <!-- **** ./ list-group-item **** -->
		  	</li>
		  	
		</ul>