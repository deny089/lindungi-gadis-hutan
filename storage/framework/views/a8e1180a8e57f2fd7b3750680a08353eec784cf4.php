<?php 
// ** Data User logged ** //
  namespace App\Http\Controllers;

  use Illuminate\Support\Facades\Auth;
  use Illuminate\Http\Request;
  use App\Models\AdminSettings;
  use App\Models\User_campaign;
  use App\Models\User;
  use App\Models\Donations;
  use App\Models\Campaigns;
  use App\Models\Pohon;
  use App\Helper;
  use Carbon\Carbon;

     $user = Auth::user();
     $emaildonasi = Donations::where('email',$user->email)->pluck('campaigns_id');
     $User_campaign = User_campaign::where('id_user',Auth::user()->id)->pluck('id_campaign');


     if($user->role == 'admin'){
        $data = Campaigns::select('id','title','goal','finalized','tanggal_pelaksanaan','id_pohon','hargapohon','perkembangan')->where('user_id',Auth::user()->id)
                 ->orderBy('id','DESC')
                 ->paginate(20);
      }else{
        if($emaildonasi != null){
          $data = Campaigns::select('id','title','goal','finalized','tanggal_pelaksanaan','id_pohon','hargapohon','perkembangan')->whereIn('id',$emaildonasi)
                 ->orderBy('id','DESC')
                 ->paginate(20);
        }elseif($User_campaign != null){
        $data = Campaigns::select('id','title','goal','finalized','tanggal_pelaksanaan','id_pohon','hargapohon','perkembangan')->whereIn('id',$User_campaign)
                 ->orderBy('id','DESC')
                 ->paginate(20);
        }else{
          $data = Campaigns::select('id','title','goal','finalized','tanggal_pelaksanaan','id_pohon','hargapohon','perkembangan')->where('user_id',Auth::user()->id)
                 ->orderBy('id','DESC')
                 ->paginate(20);
        }
      }
      

    $totalalldonasi = 0;
    $totalallemisi = 0;

	 $settings = AdminSettings::first();
    
    // $User_campaign = User_campaign::where('id_user',$user->id)->value('id_user');
     // $user_donasi = User::where('email',$emaildonasi)->value('id');

   // $emisi = DB::select("select coalesce(((select sum(b.donation) from donations b where b.email = '".$user->email."')/(select a.hargapohon from campaigns a where a.id = ".$kampanye." ) 
   //     * ((select emisi from pohon where id_pohon = (SELECT id_pohon from campaigns where id = a.id) ) / 100 ) * (datediff(CURDATE(), a.tanggal_pelaksanaan)) * (a.perkembangan / 100) ),0) 
   // from campaigns a, donations b");
    //$emisi = 4000;

	 
	 	 	 
	  ?>


<?php $__env->startSection('title'); ?> <?php echo e(trans('misc.campaigns')); ?> - <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?> 
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h2 class="title-site"><?php echo e(trans('misc.campaigns')); ?></h2>
      </div>
    </div>

<div class="container margin-bottom-40">
	
		<!-- Col MD -->
		<div class="col-md-8 margin-bottom-20">
			
			<?php if(session('notification')): ?>
			<div class="alert alert-warning btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		<?php echo e(session('notification')); ?> <a href="<?php echo e(url('account/withdrawals/configure')); ?>"><?php echo e(trans('misc.configure')); ?> <i class="fa fa-long-arrow-right"></i></a>
            		</div>
            	<?php endif; ?>

<!-- <?php if(  $settings->payment_gateway == 'Paypal' && $data->total() !=  0 && $data->count() != 0 ): ?>
<h6>* <?php echo e(trans('misc.fund_detail_alert')); ?> <?php echo e($settings->fee_donation); ?>% + (PayPal 5.4% + 0.3) = 10.4% + 0.3</h6>
<?php endif; ?>

<?php if(  $settings->payment_gateway == 'Stripe' && $data->total() !=  0 && $data->count() != 0 ): ?>
<h6>* <?php echo e(trans('misc.fund_detail_alert')); ?> <?php echo e($settings->fee_donation); ?>% + (Stripe 2.9% + 0.3) = 7.9% + 0.3</h6>
<?php endif; ?> -->

<div class="table-responsive">
   <table class="table table-striped"> 
   	
   	<?php if( $data->total() !=  0 && $data->count() != 0 ): ?>
   	
    <?php if( $user->role == 'admin' ): ?>
    
    <thead> 
   		<tr>
   		 <th class="active">ID</th>
   		  <th class="active"><?php echo e(trans('misc.title')); ?></th>
          <th class="active"><?php echo e(trans('misc.goal')); ?></th>
          <th class="active"><?php echo e(trans('misc.funds_raised')); ?></th>
          <th class="active"><?php echo e(trans('admin.status')); ?></th>
          <th class="active"><?php echo e(trans('admin.date')); ?></th>
          <th class="active"><?php echo e(trans('admin.actions')); ?></th> 
          </tr>
   		  </thead> 
   		  
   		  <tbody> 

   		      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
   		      
               <?php
               		      
                  $amount = $campaign->donations()->sum('donation');
            	
            	if(  $settings->payment_gateway == 'Paypal' ) {
            		$fee       = 5.4;
            	}  elseif(  $settings->payment_gateway == 'Stripe' ) {
            		$fee       = 2.9;
            	}
            	  
            	  
            	  $_funds  = $amount - (  $amount * $fee/100 - .3 ); // Fee Paypal
            	  $funds    = $_funds - (  $_funds * $settings->fee_donation/100  ); // Fee Site
            	    		      
               	?>
   		      
              <tr>
                <td><?php echo e($campaign->id); ?></td>
                <td><img src="<?php echo e(asset('public/campaigns/small').'/'.$campaign->small_image); ?>" width="20" /> 
                	<a title="<?php echo e($campaign->title); ?>" href="<?php echo e(url('campaign',$campaign->id)); ?>" target="_blank"><?php echo e(str_limit($campaign->title,20,'...')); ?> <i class="fa fa-external-link-square"></i></a>
                	</td>
                <td><?php echo e($settings->currency_symbol.number_format($campaign->goal)); ?></td>
                <td><?php echo e($settings->currency_symbol.number_format( $funds  )); ?></td>
                <td>
                	<?php if( $campaign->finalized == 0 ): ?>
                	<span class="label label-success"><?php echo e(trans('misc.active')); ?></span>
                	<?php else: ?>
                	<span class="label label-default"><?php echo e(trans('misc.finalized')); ?></span>
                	<?php endif; ?>
                </td>
                <td><?php echo e(date('d M, y', strtotime($campaign->date))); ?></td>
                <td> 
                     
                     <?php if( $campaign->finalized == 0 ): ?>
                      	<a href="<?php echo e(url('edit/campaign',$campaign->id)); ?>" class="btn btn-success btn-xs">
                      		<?php echo e(trans('admin.edit')); ?>

                      	</a> 
                      	<?php else: ?>
                      	
                      	<?php if( isset( $campaign->withdrawals()->id ) && $campaign->withdrawals()->status == 'pending'  ): ?>
                      		<span class="label label-warning"><?php echo e(trans('misc.pending_to_pay')); ?></span>
                      		
                      		<?php elseif( isset( $campaign->withdrawals()->id ) && $campaign->withdrawals()->status == 'paid'  ): ?>
                      		
                      		<span class="label label-success"><?php echo e(trans('misc.paid')); ?></span>
                      		
                      		<?php else: ?>
                     
                     <?php if( number_format($funds) != 0 ): ?>
                     
                     <?php echo Form::open([
			            'method' => 'POST',
			            'url' => "campaign/withdrawal/$campaign->id",
			            'class' => 'displayInline'
				        ]); ?>

				        				        
	            	<?php echo Form::submit(trans('misc.make_withdrawal'), ['class' => 'btn btn-success btn-xs padding-btn']); ?>

	        	<?php echo Form::close(); ?>


                      	<?php else: ?>
                      	<?php echo e(trans('misc.finalized')); ?>

                      	<?php endif; ?>
                      		
                      	<?php endif; ?>
                      	                      	
                      	<?php endif; ?>
                      	
                      	</td>
                    </tr><!-- /.TR -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    
                    <?php else: ?>

                    <thead> 
      <tr>
       <th class="active">ID</th>
        <th class="active"><?php echo e(trans('misc.title')); ?></th>
          <th class="active"><?php echo e(trans('misc.goal')); ?></th>
          <th class="active"><?php echo e(trans('admin.status')); ?></th>
          <th class="active">Pelaksanaan</th>
          <th class="active">Donasi</th>
          <th class="active">Emisi</th>
          </tr>
        </thead> 
        
        <tbody> 

            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            
   
            
                    <tr>
                      <td><?php echo e($campaign->id); ?></td>
                      <td><img src="<?php echo e(asset('public/campaigns/small').'/'.$campaign->small_image); ?>" width="20" /> 
                        <a title="<?php echo e($campaign->title); ?>" href="<?php echo e(url('campaign',$campaign->id)); ?>" target="_blank"><?php echo e(str_limit($campaign->title,20,'...')); ?> <i class="fa fa-external-link-square"></i></a>
                        </td>
                      <td><?php echo e(number_format($campaign->goal)); ?></td>
                      <td>
                        <?php if( $campaign->finalized == 0 ): ?>
                        <span class="label label-success"><?php echo e(trans('misc.active')); ?></span>
                        <?php else: ?>
                        <span class="label label-default"><?php echo e(trans('misc.finalized')); ?></span>
                        <?php endif; ?>
                      </td>
                      <td><?php echo e(date('d M, Y', strtotime($campaign->tanggal_pelaksanaan))); ?></td>
                      <td>
                      <?php 
                        $jumlah_donasi = Donations::where('campaigns_id',$campaign->id)->where('email',$user->email)->where('confirmed','1')
                          ->sum('donation');

                        $totaldonasi = 0;
                        $totalemisi = 0;
                      ?>
                        <?php echo e('Rp '.number_format($jumlah_donasi)); ?>

                      </td>
                      <td>
  <?php
    $start_date = new \DateTime( date("Y-m-d" , strtotime($campaign->tanggal_pelaksanaan)) );
    $date = new \DateTime( date("Y-m-d") );
    $difference = $start_date->diff($date);
    if($start_date > $date){
        $umur = 0;
        $notemisi = 'Belum';
    }elseif ($start_date == $date) {
        $umur = 0;
        $notemisi = 'Belum';
    }elseif ($start_date < $date) {
        $umur = $difference->days;
    }

    $emisipohon = Pohon::where('id_pohon',$campaign->id_pohon)->value('emisi');
    if($jumlah_donasi == 0){
      $emisi = 0;
    }elseif($emisipohon == 0){
      $emisi = 0;
    }else{
      $emisi = ( $jumlah_donasi / $campaign->hargapohon ) * ( $emisipohon / 100 ) * ($umur / 365) * ($campaign->perkembangan / 100 );
    }
  ?>
                      <?php echo e(($umur = 0)? $notemisi : round($emisi , 2).' Kg'); ?>

                      </td>
                      
                    </tr><!-- /.TR -->
                    <?php
                      $totaldonasi += $jumlah_donasi;
                      $totalemisi += $emisi;
                      $totalalldonasi += $totaldonasi;
                      $totalallemisi  += $totalemisi;
                    ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                      <?php
                      ?>

                    <?php endif; ?>

                    <?php else: ?>
                    <hr />
                    	<h3 class="text-center no-found"><?php echo e(trans('misc.no_results_found')); ?></h3>

                    <?php endif; ?>   		  		 		
   		  		 		</tbody> 
                <tfoot>
                  <td>&nbsp;</td>
                  <td colspan="4"><strong>Total</strong> </td>
                  <td><?php echo e('Rp '.number_format($totalalldonasi)); ?></td>
                  <td><?php echo e(round($totalallemisi , 2).' Kg'); ?></td>
                </tfoot>
   		  		 		</table>
   		  		 		</div>
   		  		 	
   		  		 	<?php if( $data->lastPage() > 1 ): ?>	
   		  		 		<?php echo e($data->links()); ?>

   		  		 		<?php endif; ?>
   		 <?php
        $kalimat = 'Saya telah mendonasikan '.$settings->currency_symbol.' '.number_format($totalalldonasi).' Yang mengurangi emisi CO2 sebesar '.number_format($totalallemisi).' Kg';
       ?>
<?php $__env->startSection('css'); ?>

		</div><!-- /COL MD -->
		<div class="col-md-4">
			<?php echo $__env->make('users.navbar-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		
 </div><!-- container -->
 
 <!-- container wrap-ui -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>