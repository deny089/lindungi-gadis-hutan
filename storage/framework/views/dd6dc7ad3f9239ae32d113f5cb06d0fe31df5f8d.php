<?php 
    $settings   = App\Models\AdminSettings::first();
    $totalpohon =   $donasi / $pohon->harga;
?>

<?php $__env->startSection('title'); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('public/plugins/iCheck/all.css')); ?>" rel="stylesheet" type="text/css" />

<meta property="og:app_id" content="965008666968302"/>
<meta property="og:site_name" content="<?php echo e($settings->title); ?>"/>
<meta property="og:url" content="<?php echo e(url("campaign/$campaign->id").'/'.str_slug($campaign->title)); ?>"/>
<meta property="og:image" content="<?php echo e(url('public/campaigns/large',$campaign->large_image)); ?>"/>

<meta property="og:title" content="<?php echo e($campaign->title); ?>"/>
<meta property="og:description" content="<?php echo e('Saya telah mendonasikan '.$totalpohon.' Pohon untuk Penghijauan Lindungi Hutan. Mari Lestarikan Hutan Indonesia'); ?>"/>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="<?php echo e(url('public/campaigns/large',$campaign->large_image)); ?>" />
<meta name="twitter:title" content="<?php echo e($campaign->title); ?>" />
<meta name="twitter:description" content="<?php echo e(str_limit($campaign->description, 200, '...')); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php 
    
    $hari = date('l', strtotime($campaign->tanggal_pelaksanaan));

    switch ($hari) {
        case "Sunday":
            $dina = "Minggu";
            break;
        case "Monday":
            $dina = "Senin";
            break;
        case "Tuesday":
            $dina = "Selasa";
            break;
        case "Wednesday":
            $dina = "Rabu";
            break;
        case "Thursday":
            $dina = "Kamis";
            break;
        case "Friday":
            $dina = "Jumat";
            break;
        case "Saturday":
            $dina = "Sabtu";
            break;
        default:
            $dina = " ";
    }

     $bulan = date('m', strtotime($campaign->tanggal_pelaksanaan));

    switch ($bulan) {
        case "1":
            $wulan = "Januari";
            break;
        case "2":
            $wulan = "Februari";
            break;
        case "3":
            $wulan = "Maret";
            break;
        case "4":
            $wulan = "April";
            break;
        case "5":
            $wulan = "Mei";
            break;
        case "6":
            $wulan = "Juni";
            break;
        case "7":
            $wulan = "Juli";
            break;
        case "8":
            $wulan = "Agustus";
            break;
        case "9":
            $wulan = "September";
            break;
        case "10":
            $wulan = "Oktober";
            break;
        case "11":
            $wulan = "November";
            break;
        case "12":
            $wulan = "Desember";
            break;
        default:
            $wulan = " ";
    }
?>

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site">Transfer</h1>
        <p class="subtitle-site"><strong>Donasi Anda Untuk Penghijauan</strong></p>
      </div>
    </div>

<div class="container margin-bottom-40">
	
	<div class="row">
<!-- Col MD -->
<div class="col-md-12">	
	

<div class="col-sm-2"></div>
<div class="col-sm-8">
    <h3 class="btn-block text-left class-montserrat margin-bottom-zero none-overflow" >
        <strong>Total : <?php echo e($settings->currency_symbol.' '.number_format($donasi)); ?></strong>
    </h3>
    
    <p>Dengan <b><?php echo e($donasi / $pohon->harga); ?></b> Pohon yang Anda donasikan, Anda berkontribusi mengurangi emisi CO2 sebanyak <b><?php echo e(round($emisi * 1000 , 2)); ?></b> gram di hari pertama penanaman nanti pada hari 
    <b><?php echo e($dina.', '.date('d', strtotime($campaign->tanggal_pelaksanaan)).' '.$wulan.' '.date('Y', strtotime($campaign->tanggal_pelaksanaan))); ?></b>. </p>

    <p><strong> Waktu transfer Anda adalah 24 jam dari sekarang </strong></p>
    <p><strong> Donasi Anda akan muncul setelah Anda melakukan konfirmasi </strong></p>
    <p>Konfirmasi Transfer dapat melalui </p>
    <ul>
    <li>sms/wa di 085735109593, </li>
    <li>email lindungihutan23@gmail.com </li> 
    <li>atau kirim ke Chat Online di Website Lindugi Hutan</li>
    </ul>
    <p><strong> Terima Kasih Anda telah berkontribusi dalam perawatan dan pelestarian hutan di Indonesia </strong></p>

    <br>
    <br>
    <p>Pilih Metode Pembayaran</p>

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading" >
      <h4 class="panel-title">
        <a class="btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
            <label>Bank BNI</label>
        </a>
        
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">
            <div class="col-sm-4">
                <p><img src="<?php echo e(asset('public/img-transfer/bni.png')); ?>" style="width: 150px; height: 70px"></p>
            </div>
            <div class="col-sm-8">
                <p>Name : Hario Laskito Ardi</p>
                <p>Account Number : 0497090099 </p>
            </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" >
      <h4 class="panel-title">
        <a class="btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
            <label>Bank Mandiri</label>
        </a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="col-sm-4">
                <p><img src="<?php echo e(asset('public/img-transfer/mandiri.png')); ?>" style="width: 150px; height: 70px"></p>
            </div>
            <div class="col-sm-8">
                <p>Name : Hario Laskito Ardi</p>
                <p>Account Number : 1350015070012 </p>
            </div>
        </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" >
      <h4 class="panel-title">
        <a class="btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
            <label>Bank BCA</label>
        </a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="col-sm-4">
                <p><img src="<?php echo e(asset('public/img-transfer/bca.png')); ?>" style="width: 150px; height: 70px"></p>
            </div>
            <div class="col-sm-8">
                <p>Name : Hario Laskito Ardi</p>
                <p>Account Number : 1400694075 </p>
            </div>
        </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" >
      <h4 class="panel-title">
        <a class="btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
            <label>Doku Wallet</label>
        </a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="col-sm-4">
                <p><img src="<?php echo e(asset('public/img-transfer/doku.png')); ?>" style="width: 150px; height: 70px"></p>
            </div>
            <div class="col-sm-8">
                <p><strong>Name : Hario Laskito Ardi</strong></p>
                <p><strong>Account Number : harios1si@gmail.com </strong></p>
            </div>
        </div>
    </div>
  </div>
  <style>
     @media  screen and (max-width: 2560px) { /* screen size until 1200px */
        label {
            font-size: 26px; /* 1.5x default size */
        }
    }
    @media  screen and (max-width: 2000px) { /* screen size until 1200px */
        label {
            font-size: 23px; /* 1.5x default size */
        }
    }
    @media  screen and (max-width: 1200px) { /* screen size until 1000px */
        label {
            font-size: 20px; /* 1.2x default size */
            }
        }
    @media  screen and (max-width: 800px) { /* screen size until 500px */
        label {
            font-size: 16px; /* 0.8x default size */
            }
        }
    @media  screen and (max-width: 500px) { /* screen size until 500px */
        label {
            font-size: 13px; /* 0.8x default size */
            }
        }
</style>
  <div class="panel panel-default">
     <div class="panel-heading" >
      <h4 class="panel-title">
        <a class="btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
            <label>Indomaret, Alfamart, etc </label>
        </a>
      </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">
            <div id="Menu4">
                <div class="col-sm-2">
                    <p></p>
                </div>
                <div class="col-sm-10">
                    <p>Transaksi melalui Indomaret, Alfamart, Kantor Pos dan Pegadaian </p>
                    <p><strong>Hubungi Nomor : 085735109593 </strong></p>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
            <label>Cash On Delivery</label>
        </a>
      </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body">
            <div id="Menu5" >
                <div class="col-sm-2">
                    <p></p>
                </div>
                <div class="col-sm-10">
                    <p><strong>Transaksi melalui Cash On Dilivery </strong></p>
                    <p><strong>Hubungi Nomor : 085735109593 </strong></p>
                </div>
            </div>
        </div>
    </div>
  </div>

</div>

    <br>
<div class="row margin-bottom-30">
    <div class="col-md-4">
        <a class="btn btn-block btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url('campaign',$campaign->id).'/'.str_slug($campaign->title)); ?>" target="_blank"><i class="fa fa-facebook myicon-right"></i> <?php echo e(trans('misc.share_on')); ?> Facebook</a>

    </div>
    
    <div class="col-md-4">
        <a class="btn btn-twitter btn-block" href="https://twitter.com/intent/tweet?url=<?php echo e(url('campaign',$campaign->id)); ?>&text=<?php echo e(e( $campaign->title )); ?>" data-url="<?php echo e(url('campaign',$campaign->id)); ?>" target="_blank"><i class="fa fa-twitter myicon-right"></i> <?php echo e(trans('misc.tweet')); ?></a>
    </div>
</div>
    <br>
    
    <p><strong> Fasilitas yang anda dapatkan adalah </strong></p>
    <p><strong> 1. Sertifikat Digital Appreciate (Akan kami kirimkan ke Email Anda sesuai dengan dengan identitas Anda) </strong></p>
    <p><strong> 2. Anda dapat mengawasi pertumbuhan pohon donasi anda lewat aplikasi "Lindungi Hutan"  </strong></p>
    <p><strong> 3. Nama anda digunakan untuk nama pohon donasi Anda  </strong></p>
    <p><strong> 4. Daftarkan akun Anda agar dapat melihat semua hasil kontribusi Anda bersama kami melalu website ini.  </strong></p>
    <br>
    <p>* Ingin bergabung bersama kami dalam kampanye penanaman pohon ini? </p>
    
    <?php if( Auth::check() ): ?>
    <a href="<?php echo e(url('join/'.$id_user.'/'.$id_campaign)); ?>" class="btn btn-main btn-lg btn-block custom-rounded" >
    Gabung Aksi
    </a>
    <?php else: ?>
    <a href="<?php echo e(url('login')); ?>" class="btn btn-main btn-lg btn-block custom-rounded" >
    Gabung Aksi
    </a>
    <?php endif; ?>
  
    </div>


    <!-- <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div class="row" style="border: 4px; padding-top: 5px; border-color: blue">
    <script type="text/javascript"></script>
        <p><strong>Total : <?php echo e($settings->currency_code.' '.number_format($donasi)); ?></strong></p>
        <p>Pilih Metode Pembayaran</p>
        <div class="row" >
            <input type="radio" onclick="toggleVisibility('Menu1');">
            <label>Bank BNI</label>
        </div>
        <div id="Menu1">
            <div class="col-sm-4">
                <p><img src="<?php echo e(asset('public/img-transfer/bni.png')); ?>" style="width: 150px; height: 70px"></p>
            </div>
            <div class="col-sm-8">
                <p>Name : Hario Laskito Ardi</p>
                <p>Account Number : 0497090099 </p>
            </div>
        </div>
            
    </div>
    <div class="row" style="border: 1px; padding-top: 5px; border-color: blue">
      
        <div class="row" >
            <input type="radio" onclick="toggleVisibility('Menu2');" >
            <label>Bank Mandiri</label>
        </div>
            <div id="Menu2" style="display: none;">
                <div class="col-sm-4">
                    <p><img src="<?php echo e(asset('public/img-transfer/mandiri.png')); ?>" style="width: 150px; height: 70px"></p>
                </div>
                <div class="col-sm-8">
                    <p>Name : Hario Laskito Ardi</p>
                    <p>Account Number : 1350015070012 </p>
                </div>
            </div>
            
    </div>
    <div class="row" style="border: 1px; padding-top: 5px; border-color: blue">
      
        <div class="row" >
            <input type="radio" onclick="toggleVisibility('Menu3');" >
            <label>Doku Wallet</label>
        </div>
            <div id="Menu3" style="display: none;">
                <div class="col-sm-4">
                    <p><img src="<?php echo e(asset('public/img-transfer/doku.png')); ?>" style="width: 150px; height: 70px"></p>
                </div>
                <div class="col-sm-8">
                    <p><strong>Name : Hario Laskito Ardi</strong></p>
                    <p><strong>Account Number : harios1si@gmail.com </strong></p>
                </div>
            </div>
            
    </div>
    <div class="row" style="border: 1px; padding-top: 5px; border-color: blue">
      
        <div class="row" >
            <input type="radio" onclick="toggleVisibility('Menu4');">
            <label>Indomaret, Alfamart, Kantor Pos dan Pegadaian</label>
        </div>
            <div id="Menu4" style="display: none;">
                <div class="col-sm-2">
                    <p></p>
                </div>
                <div class="col-sm-10">
                    <p><strong>Transaksi melalui Indomaret, Alfamart, Kantor Pos dan Pegadaian </strong></p>
                    <p><strong>Hubungi Nomor : 085735109593 </strong></p>
                </div>
            </div>
            
    </div>
    <div class="row" style="border: 1px; padding-top: 5px; border-color: blue">
      
        <div class="row" >
            <input type="radio" onclick="toggleVisibility('Menu5');" >
            <label>Cash On Delivery</label>
        </div>
            <div id="Menu5" style="display: none;">
                <div class="col-sm-4">
                    <p></p>
                </div>
                <div class="col-sm-8">
                    <p><strong>Transaksi melalui Cash On Dilivery </strong></p>
                    <p><strong>Hubungi Nomor : 085735109593 </strong></p>
                </div>
            </div>
            
    </div>
    <br>
    <br>
    <p><strong> Waktu transfer Anda dibatasi 1 Jam dimulai dari sekarang </strong></p>
    <p><strong> Terima Kasih Anda telah berkontribusi dalam perawatan dan pelestarian hutan di Indonesia </strong></p>
    <br>
    <p><strong> Fasilitas yang anda dapatkan adalah </strong></p>
    <p><strong> 1. Sertifikat Digital Appreciate (Akan kami kirimkan ke Email Anda sesuai dengan dengan identitas Anda) </strong></p>
    <p><strong> 2. Anda dapat mengawasi pertumbuhan pohon donasi anda lewat aplikasi "Lindungi Hutan"  </strong></p>
    <p><strong> 3. Nama anda digunakan untuk nama pohon donasi Anda  </strong></p>
    <br>
    Konfirmasi Transfer dapat melalui lindungihutan23@gmail.com atau kirim ke Chat Online di Website Lindugi Hutan
    <br>
    <br>
    <br>
    <p>* Ingin bergabung bersama kami dalam kampanye penanaman pohon ini? </p>
    
    <?php if( Auth::check() ): ?>
    <a href="<?php echo e(url('join/'.$id_user.'/'.$id_campaign)); ?>" class="btn btn-main btn-lg btn-block custom-rounded" >
    Gabung Aksi
    </a>
    <?php else: ?>
    <a href="<?php echo e(url('login')); ?>" class="btn btn-main btn-lg btn-block custom-rounded" >
    Gabung Aksi
    </a>
    <?php endif; ?>
  
    </div> --> 

    <!-- akhir opsi pemb -->
	
	<!-- <div class="login-form">
	            	
    <form action="" method="post" name="form" id="signup_form">

    <p><strong>Please transfer to our bank account Bank </strong></p>
    <p><strong>Bank BNI </strong></p>
    <br>
    <p><strong>Name : Hario Laskito Ardi</strong></p>
    <p><strong>Account Number : 0497090099</strong></p>
    -----------------------------------------------------------------------
    <br>
    <p><strong>Bank MANDIRI </strong></p>
    <br>
    <p><strong>Name : Hario Laskito Ardi</strong></p>
    <p><strong>Account Number : 1350015070012 </strong></p>
    -----------------------------------------------------------------------
    <br>    
    <p><strong>DOKU WALLET </strong></p>
    <br>
    <p><strong>Name : Hario Laskito Ardi</strong></p>
    <p><strong>Account Number : harios1si@gmail.com </strong></p>
    <br>
    -----------------------------------------------------------------------
    <br>    
    <p><strong>Paypal </strong></p>
    <br>
    <p><strong>Name : Hario Laskito Ardi</strong></p>
    <p><strong>Account Number : harios1si@yahoo.com </strong></p>
    <br>
    -----------------------------------------------------------------------
    <p><strong>Transaksi melalui Indomaret, Alfamart, Kantor Pos dan Pegadaian </strong></p>
    <p><strong>Hubungi Nomor : 085735109593 </strong></p>
    -----------------------------------------------------------------------
    <br>
    <p><strong>Transaksi melalui Cash On Dilivery </strong></p>
    <p><strong>Hubungi Nomor : 085735109593 </strong></p>
    <br>
    <p><strong>Total : <?php echo e($settings->currency_code.' '.number_format($donasi)); ?></strong></p>
    <br>
    <p><strong> Waktu transfer Anda dibatasi 1 Jam dimulai dari sekarang </strong></p>
    <p><strong> Terima Kasih Anda telah berkontribusi dalam perawatan dan pelestarian hutan di Indonesia </strong></p>
    <br>
    <p><strong> Fasilitas yang anda dapatkan adalah </strong></p>
    <p><strong> 1. Sertifikat Digital Appreciate (Akan kami kirimkan ke Email Anda sesuai dengan dengan identitas Anda) </strong></p>
    <p><strong> 2. Anda dapat mengawasi pertumbuhan pohon donasi anda lewat aplikasi "Lindungi Hutan"  </strong></p>
    <p><strong> 3. Nama anda digunakan untuk nama pohon donasi Anda  </strong></p>
    <br>
    Konfirmasi Transfer dapat melalui lindungihutan23@gmail.com atau kirim ke Chat Online di Website Lindugi Hutan
    <br>
    <br>
    <br>
    <p>* Ingin bergabung bersama kami dalam kampanye penanaman pohon ini? </p>
    
	<?php if( Auth::check() ): ?>
	<a href="<?php echo e(url('join/'.$id_user.'/'.$id_campaign)); ?>" class="btn btn-main btn-lg btn-block custom-rounded" >
	Gabung Aksi
	</a>
	<?php else: ?>
	<a href="<?php echo e(url('login')); ?>" class="btn btn-main btn-lg btn-block custom-rounded" >
	Gabung Aksi
	</a>
	<?php endif; ?>

    </form>
                      	
     </div> --><!-- Login Form -->
		
 </div><!-- /COL MD -->
  
</div><!-- ROW -->
 
 </div><!-- row -->
 
 <!-- container wrap-ui -->

<script type="text/javascript">
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
 
 <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5850128f397ff569a3f556e7/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>