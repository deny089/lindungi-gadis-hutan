<?php $userAuth = Auth::user(); ?>

<?php if( Auth::check() && $userAuth->status == 'pending' ): ?>
<div class="btn-block text-center confirmEmail"><?php echo e(trans('misc.confirm_email')); ?> <strong><?php echo e($userAuth->email); ?></strong></div>
<?php endif; ?>
<div class="navbar navbar-inverse navbar-px padding-top-10 padding-bottom-10">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          	
          	 <?php if( isset( $totalNotify ) ) : ?>
        	<span class="notify"><?php echo $totalNotify; ?></span>
        	<?php endif; ?>
        	
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
          	<img src="<?php echo e(asset('public/img/logo.png')); ?>" class="logo" />
          	</a>
        </div><!-- navbar-header --> 
        
        <div class="navbar-collapse collapse">
		     
        	<ul class="nav navbar-nav navbar-right">
          		
          		<li <?php if(Request::is('/')): ?> class="active-navbar" <?php endif; ?>>
        				<a class="text-uppercase font-default" href="<?php echo e(url('/')); ?>"><?php echo e(trans('misc.campaigns')); ?></a>
        			</li>
        			
        			<?php $__currentLoopData = \App\Models\Pages::where('show_navbar', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_page): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					 	<li <?php if(Request::is("page/$_page->slug")): ?> class="active-navbar" <?php endif; ?>>
					 		<a class="text-uppercase font-default" href="<?php echo e(url('page',$_page->slug)); ?>"><?php echo e($_page->title); ?></a>
					 		</li>
					 	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        		
        		<?php if( Auth::check() ): ?>
        			
        			<li class="dropdown">
			          <a href="javascript:void(0);" data-toggle="dropdown" class="userAvatar myprofile dropdown-toggle">
			          		<img src="<?php echo e(asset('public/avatar').'/'.$userAuth->avatar); ?>" alt="User" class="img-circle avatarUser" width="21" height="21" />
			          		<span class="title-dropdown font-default"><?php echo e(trans('users.my_profile')); ?></span> 
			          		<i class="ion-chevron-down margin-lft5"></i>
			          	</a>
			          
			          <!-- DROPDOWN MENU -->
			          <ul class="dropdown-menu arrow-up nav-session" role="menu" aria-labelledby="dropdownMenu4">
	          		 <?php if( $userAuth->role == 'admin' ): ?>		 	
	          		 	<li>
	          		 		<a href="<?php echo e(url('panel/admin')); ?>" class="text-overflow">
	          		 			<i class="icon-cogs myicon-right"></i> <?php echo e(trans('admin.admin')); ?></a>
	          		 			</li>
	          		 			<?php endif; ?>
	          		 			
	          		 			<li>
	          		 			<a href="<?php echo e(url('account/campaigns')); ?>" class="text-overflow">
	          		 				<i class="ion ion-speakerphone myicon-right"></i> <?php echo e(trans('misc.campaigns')); ?>

	          		 				</a>
	          		 			</li>
	          		 			
	          		 			<li>
	          		 			<a href="<?php echo e(url('account')); ?>" class="text-overflow">
	          		 				<i class="glyphicon glyphicon-cog myicon-right"></i> <?php echo e(trans('users.account_settings')); ?>

	          		 				</a>
	          		 			</li>
	          		 		          		 	
	          		 		<li>
	          		 			<a href="<?php echo e(url('logout')); ?>" class="logout text-overflow">
	          		 				<i class="glyphicon glyphicon-log-out myicon-right"></i> <?php echo e(trans('users.logout')); ?>

	          		 			</a>
	          		 		</li>
	          		 	</ul><!-- DROPDOWN MENU -->
	          		</li>
	          		
	          		<li><a class="log-in custom-rounded" href="<?php echo e(url('create/campaign')); ?>" title="<?php echo e(trans('misc.create_campaign')); ?>">
					<i class="glyphicon glyphicon-edit"></i> <span class="title-dropdown font-default"><?php echo e(trans('misc.create_campaign')); ?></span></a>
					</li>
					
					<?php else: ?>
					
					<li><a class="text-uppercase font-default" href="<?php echo e(url('login')); ?>"><?php echo e(trans('auth.login')); ?></a></li>
						
					<li>
						<a class="log-in custom-rounded text-uppercase font-default" href="<?php echo e(url('register')); ?>">
						<?php echo e(trans('auth.sign_up')); ?>

						</a>
						</li>

        	  <?php endif; ?>
          </ul>
            
         </div><!--/.navbar-collapse -->
     </div>
 </div>