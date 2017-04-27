<?php 

	$settings = App\Models\AdminSettings::first();
	
	$donasi = $response->donations()->where('confirmed','1')->sum('donation');
   $hargapohon = $response->hargapohon;
   if($donasi != 0 && $hargapohon != 0){
    $jumlahpohon = round( $donasi / $hargapohon  );
    $percentage = round($jumlahpohon / $response->goal * 100);
   }else {
        $jumlahpohon = 0;
        $percentage = $response->goalhewan * 100;
   }
   
	
	
	if( $percentage > 100 ) {
		$percentage = $percentage;
	} else {
		$percentage = $percentage;
	}
	
	// All Donations
	$donations = $response->donations()->where('confirmed','1')->orderBy('id','desc')->paginate(2);
	
	// Updates
	$updates = $response->updates()->orderBy('id','desc')->paginate(1);
	
	if( str_slug( $response->title ) == '' ) {
		$slug_url  = '';
	} else {
		$slug_url  = '/'.str_slug( $response->title );
	}


 ?>
 

<?php $__env->startSection('title'); ?><?php echo e(trans('misc.donate').' - '.$response->title.' - '); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/plugins/iCheck/all.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="jumbotron md header-donation jumbotron_set">
      <div class="container wrap-jumbotron position-relative">
      	<h2 class="title-site"><?php echo e(trans('misc.donate')); ?></h2>
      	<p class="subtitle-site"><strong><?php echo e($response->title); ?></strong></p>
      </div>
    </div>
    
<div class="container margin-bottom-40 padding-top-40">
	
<!-- Col MD -->
<div class="col-md-8 margin-bottom-20"> 
	
	   <!-- form start -->
    <form method="POST" action="<?php echo e(url('donate',$response->id)); ?>" enctype="multipart/form-data" id="formDonation">
    	
    	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    	<input type="hidden" name="_id" value="<?php echo e($response->id); ?>">
			
			<div class="form-group">
				    <label><?php echo e(trans('misc.enter_your_donation')); ?>  </label>
				    <?php if( $response->cat_id == 1 ): ?>
				     <p>Harga Pohon = <?php echo e($settings->currency_symbol.' '.number_format($response->hargapohon)); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p> 
				     <p>* jumlah pohon yang anda donasikan dikalikan dengan harga pohon yang berlaku</p>
				  	<?php endif; ?>
				    <div class="input-group has-success">
			<!-- edited cacip -->
					
					<div class="input-group">

					<?php if( $response->cat_id == 1 ): ?>
				      	<div class="input-group-addon addon-dollar" required>P</div>
				    <?php else: ?>
				    	<div class="input-group-addon addon-dollar" required>Rp</div>
				    <?php endif; ?>
				      <input class="form-control" type="text" min="1" onchange="OperasiPerhitungan();"  autocomplete="off" id="onlyNumber"  name="amount" value="<?php echo e(old('donation')); ?>" placeholder="Minimum <?php echo e($settings->min_donation_amount); ?> trees"> 
				    </div>
				  </div>
				  </div>

				  <?php if( $response->cat_id == 1 ): ?>
				  <div class="form-group">
					<div class="input-group">
				  	<div class="input-group-addon addon-dollar">Total =  <?php echo e($settings->currency_symbol); ?> </div> <input  class="form-control" type="text" id="total" disabled="disabled" value="0" />
					</div> 
				  </div> 
				  <?php endif; ?>
			<!-- end edited cacip -->

				  
				<br>
                 <!-- Start -->
                    <div class="form-group">
                      <label><?php echo e(trans('auth.full_name')); ?></label>
                        <input type="text"  value="<?php if( Auth::check() ): ?><?php echo e(Auth::user()->name); ?><?php endif; ?>" name="full_name" class="form-control input-lg" placeholder="<?php echo e(trans('misc.first_name_and_last_name')); ?>" required>
                    </div><!-- /. End-->
                    
                    <!-- Start -->
                    <div class="form-group">
                      <label><?php echo e(trans('auth.email')); ?></label>
                        <input type="email"  value="<?php if( Auth::check() ): ?><?php echo e(Auth::user()->email); ?><?php endif; ?>" name="email" class="form-control input-lg" placeholder="<?php echo e(trans('auth.email')); ?>" required>
                    </div><!-- /. End-->

                    <!-- Start -->
                    <div class="form-group">
                      <label>Phone</label>
                        <input type="text"  value="<?php if( Auth::check() ): ?><?php echo e(Auth::user()->telpon); ?><?php endif; ?>" name="phone" class="form-control input-lg" placeholder="Phone Number">
                    </div><!-- /. End-->
              
              <!--<div class="row form-group">    
                  <!-- Start -->
                    <!--<div class="col-xs-6">
                      <label><?php echo e(trans('misc.country')); ?></label>
                      	<select name="country" class="form-control input-lg" >
                      		<option value=""><?php echo e(trans('misc.select_one')); ?></option>
                      	<?php $__currentLoopData = App\Models\Countries::orderBy('country_name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 	
                            <option value="<?php echo e($country->country_name); ?>"><?php echo e($country->country_name); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                  </div><!-- /. End-->
                  
                  <!-- Start -->
                    <!--<div class="col-xs-6">
                      <label><?php echo e(trans('misc.postal_code')); ?></label>
                        <input type="text"  value="<?php echo e(old('postal_code')); ?>" name="postal_code" class="form-control input-lg" placeholder="<?php echo e(trans('misc.postal_code')); ?>">
                    </div><!-- /. End-->
                    
              <!-- </div><!-- row form-control -->
                  
                  <!-- Start -->
                    <div class="form-group">
                        <input type="text" value="<?php echo e(old('comment')); ?>" name="comment" class="form-control input-lg" placeholder="<?php echo e(trans('misc.leave_comment')); ?>">
                    </div><!-- /. End-->
                    
        <div class="form-group checkbox icheck">
				<label class="margin-zero">
					<input class="no-show" name="anonymous" type="checkbox" value="1">
					<span class="margin-lft5 keep-login-title"><?php echo e(trans('misc.anonymous_donation')); ?></span>
			</label>
		</div>                    
<!-- 
		<div class="form-group checkbox icheck">
				<label class="margin-zero">
					<input class="no-show" name="transdonation" type="checkbox" value="0">
					<span class="margin-lft5 keep-login-title">Donate via Paypal</span>
			</label>
		</div> -->

		<div class="form-group ">
				<label class="margin-zero">
					<span class="margin-lft5 keep-login-title">Dengan mengklik donasi, Anda setuju dengan <a href="<?php echo e(url('page/sadasdasd1212')); ?>">Syarat dan Ketentuan</a></span>
			</label>
		</div>
                    <!-- Alert -->
                    <div class="alert alert-danger display-none" id="errorDonation">
							<ul class="list-unstyled" id="showErrorsDonation"></ul>
						</div><!-- Alert -->
                
                  <div class="box-footer text-center">
                  	<hr />
                    <button type="submit" id="buttonDonation" class="btn btn-info btn-lg btn-block custom-rounded">Donasi</button>
                	<hr />
						

                    <div class="btn-block text-center margin-top-20">
			           		<a href="<?php echo e(url('campaign',$response->id)); ?>" class="text-muted">
			           		<i class="fa fa-long-arrow-left"></i>	<?php echo e(trans('auth.back')); ?></a>
			           </div>
                  </div><!-- /.box-footer -->
						
                </form>

    <br>
    <p><strong> Waktu transfer Anda adalah 24 jam dari sekarang </strong></p>
    <p><strong> Donasi Anda akan muncul setelah Anda melakukan konfirmasi </strong></p>
    <p>Konfirmasi Transfer dapat melalui </p>
    <ul>
    <li>sms/wa di 085735109593, </li>
    <li>email lindungihutan23@gmail.com </li> 
    <li>atau kirim ke Chat Online di Website Lindugi Hutan</li>
    </ul>

    <p> Fasilitas yang anda dapatkan ketika Anda berkontribusi dengan kami adalah :</p>
    <ol>
    <li> Sertifikat Digital Appreciate (Akan kami kirimkan ke Email Anda sesuai dengan dengan identitas Anda) </li>
    <li> Anda dapat mengawasi pertumbuhan pohon donasi anda lewat aplikasi "Lindungi Hutan"  </li>
    <li> Daftarkan akun Anda agar dapat melihat semua hasil kontribusi Anda bersama kami melalu website ini. </li>
    </ol>
    <br>
    <p>* Ingin bergabung bersama kami dalam kampanye penanaman pohon ini? </p>
    
    <?php if( Auth::check() ): ?>
    <a href="<?php echo e(url('join/'.$id_user.'/'.$id_campaign)); ?>" class="btn btn-primary btn-lg btn-block custom-rounded" >
    Gabung Aksi
    </a>
    <?php else: ?>
    <a href="<?php echo e(url('login')); ?>" class="btn btn-primary btn-lg btn-block custom-rounded" >
    Gabung Aksi
    </a>
    <?php endif; ?>

 </div><!-- /COL MD -->
 
 <div class="col-md-4">
	
	<!-- Start Panel -->
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="btn-block margin-zero" style="line-height: inherit;">
				<strong class="font-default"><?php echo e(number_format($jumlahpohon).' '.$settings->kode_pohon); ?></strong> 
				<small>dari Goal <?php echo e(number_format($response->goal).$settings->kode_pohon); ?></small>
				</h3>
				
				<span class="progress margin-top-10 margin-bottom-10">
					<span class="percentage" style="width: <?php echo e($percentage); ?>%" aria-valuemin="0" aria-valuemax="100" role="progressbar"></span>
				</span>
				
				<small class="btn-block margin-bottom-10 text-muted">
					<?php echo e($percentage); ?>% <?php echo e(trans('misc.raised')); ?> <?php echo e(trans('misc.by')); ?> <?php echo e(number_format($response->donations()->where('confirmed','1')->count())); ?> <?php echo e(trans_choice('misc.donation_plural',$response->donations()->count())); ?>

				</small>						
		</div>
	</div><!-- End Panel -->
		
	<div class="panel panel-default">
		<div class="panel-body">
			<img class="img-responsive img-rounded" style="display: inline-block;" src="<?php echo e(url('public/campaigns/small',$response->small_image)); ?>" />
			</div>
		</div>	
	
	<div class="panel panel-default">
		<div class="panel-body">
			<img class="img-responsive img-rounded" style="display: inline-block;" src="<?php echo e(url('public/img/transfer.png')); ?>" />
		</div>
	</div>

	<?php if( $settings->payment_gateway == 'Paypal' ): ?>	
		<div class="panel panel-default">
		<div class="panel-body">
			<img class="img-responsive img-rounded" style="display: inline-block;" src="<?php echo e(url('public/img/payment-1.png')); ?>" />
			</div>
		</div>
		<?php endif; ?>
	
<!-- Start Panel -->
 	<div class="panel panel-default">
	  <div class="panel-body">
	    <div class="media none-overflow">
	    	
	    	<span class="btn-block text-center margin-bottom-10 text-muted"><strong><?php echo e(trans('misc.organizer')); ?></strong></span>
	    	
			  <div class="media-center margin-bottom-5">
			      <img class="img-circle center-block" src="<?php echo e(url('public/avatar/',$response->user()->avatar)); ?>" width="60" height="60" >
			  </div>
			  
			  <div class="media-body text-center">
			  	
			    	<h4 class="media-heading">
			    		<?php echo e($response->user()->name); ?>

			    	
			    	<?php if( Auth::guest() ): ?>				    		
			    		<a href="#" title="<?php echo e(trans('misc.contact_organizer')); ?>" data-toggle="modal" data-target="#sendEmail">
			    				<i class="fa fa-envelope myicon-right"></i>
			    		</a>
			    		<?php endif; ?>
			    		</h4>
			    		
			    <small class="media-heading text-muted btn-block margin-zero"><?php echo e(trans('misc.created')); ?> <?php echo e(date('M d, Y', strtotime($response->date) )); ?></small>
			    <?php if( $response->location != '' ): ?>
			    <small class="media-heading text-muted btn-block"><i class="fa fa-map-marker myicon-right"></i> <?php echo e($response->location); ?></small>
			    <?php endif; ?>
			  </div>
			</div>
	  </div>
	</div><!-- End Panel -->
			
<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-hidden="true">
     		<div class="modal-dialog">
     			<div class="modal-content"> 
     				<div class="modal-header headerModal">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        
				        <h4 class="modal-title text-center" id="myModalLabel">
				        	<?php echo e(trans('misc.contact_organizer')); ?>

				        	</h4>
				     </div><!-- Modal header -->
				     
				      <div class="modal-body listWrap text-center center-block modalForm">
				    
				    <!-- form start -->
			    <form method="POST" class="margin-bottom-15" action="<?php echo e(url('contact/organizer')); ?>" enctype="multipart/form-data" id="formContactOrganizer">
			    	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			    	<input type="hidden" name="id" value="<?php echo e($response->user()->id); ?>">  	
				    
				    <!-- Start -->
                    <div class="form-group">
                    	<input type="text"  name="name" class="form-control" placeholder="<?php echo e(trans('users.name')); ?>">
                    </div><!-- /. End-->
                    
                    <!-- Start -->
                    <div class="form-group">
                    	<input type="text"  name="email" class="form-control" placeholder="<?php echo e(trans('auth.email')); ?>">
                    </div><!-- /. End-->
                    
                    <!-- Start -->
                    <div class="form-group">
                    	<textarea name="message" rows="4" class="form-control" placeholder="<?php echo e(trans('misc.message')); ?>"></textarea>
                    </div><!-- /. End-->
                   						
                    <!-- Alert -->
                    <div class="alert alert-danger display-none" id="dangerAlert">
							<ul class="list-unstyled text-left" id="showErrors"></ul>
						</div><!-- Alert -->

                  
                   <button type="submit" class="btn btn-lg btn-main custom-rounded" id="buttonFormSubmit"><?php echo e(trans('misc.send_message')); ?></button>
                   
                    </form>

                <!-- Alert -->
                    <div class="alert alert-success display-none" id="successAlert">
							<ul class="list-unstyled" id="showSuccess"></ul>
						</div><!-- Alert -->


				      </div><!-- Modal body -->
     				</div><!-- Modal content -->
     			</div><!-- Modal dialog -->
     		</div><!-- Modal -->
     			
 </div><!-- /COL MD -->
 
 </div><!-- container wrap-ui -->
 
 <?php /*
 <form id="form_pp" name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post"  style="display:none">
    <input type="hidden" name="cmd" value="_donations">
    <input type="hidden" name="return" value="'.$urlSuccess.'">
    <input type="hidden" name="cancel_return"   value="'.$urlCancel.'">
    <input type="hidden" name="notify_url" value="'.$urlPaypalIPN.'">
    <input type="hidden" name="currency_code" value="'.$this->settings->currency_code.'">
    <input type="hidden" name="amount" id="amount" value="'.$this->request->amount.'">
    <input type="hidden" name="custom" value="id='.$this->request->_id.'&fn='.$this->request->full_name.'&cc='.$this->request->country.'&pc='.$this->request->postal_code.'&cm='.$this->request->comment.'">
    <input type="hidden" name="item_name" value="'.trans('misc.donation_for').' '.$response->title.'">
    <input type="hidden" name="business" value="'.$this->settings->paypal_email.'">
    <input type="submit">
</form>
  */
  ?> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="<?php echo e(asset('public/plugins/iCheck/icheck.min.js')); ?>"></script>

<script type="text/javascript">
function OperasiPerhitungan(){

	var A1 = document.getElementById("onlyNumber").value;
	var A2 = '<?php echo e($response->hargapohon); ?>';
	var A3 = A1 * A2;
	document.getElementById("total").value = A3;
 }
</script>
<script type="text/javascript">
/*function onlyNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57))
        return false;
    return true;
}*/

$('#onlyNumber').focus();

$(document).ready(function() {
	
	$("#onlyNumber").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    
    $('input').iCheck({
	  	checkboxClass: 'icheckbox_square-red',
    	radioClass: 'iradio_square-red',
	    increaseArea: '20%' // optional
	  });
	  
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>