<?php

namespace App\Http\Controllers;
//added cacip
use Illuminate\Support\Facades\DB;
//added cacip
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminSettings;
use App\Models\Campaigns;
use App\Models\LaporanMasalah;
use App\Models\Categories;
use App\Models\User;
//edited cacip
use App\Models\Donations;
use App\Models\Partner;
use App\Models\Testimoni;
use App\Models\Media;
use App\Models\Nilai;
use App\Helper;
use Carbon\Carbon;
//end edited cacip

class HomeController extends Controller
{

    /**
     *  
     * @return \Illuminate\Http\Response
     */
    public function __construct( AdminSettings $settings, Request $request) {
		$this->settings = $settings::first();
		$this->request = $request;
	}

    public function index()
    {
       
		$settings = AdminSettings::first();
		$categories = Categories::where('mode','on')->orderBy('name')->get();
		$data      = Campaigns::where('publish','1')->orderBy('id','DESC')->paginate($settings->result_request);
		//edited cacip
		$id_campaign_in_donation = Campaigns::pluck('id');
		$jumlah = count($id_campaign_in_donation);
		$start = 0; 
		$jumlahdonasi = 0;
		while($start < $jumlah){
	       	$campaign = Campaigns::where('id', $id_campaign_in_donation[$start])->get();
	       	$donasi_campaign = Donations::where('campaigns_id', $id_campaign_in_donation[$start])->where('confirmed','1')->sum('donation');
	       	$harga = Campaigns::where('id', $id_campaign_in_donation[$start])->value('hargapohon');
	       	
	       	if($donasi_campaign == 0 || $harga == 0){
	       		$donasiperharga = 0;
	       	}else{
	       		$donasiperharga = $donasi_campaign / $harga ;
	       	}
	       	
	       	$start++;
	       	$jumlahdonasi = $donasiperharga + $jumlahdonasi;
		}
		
		$partner 	= Partner::orderBy('id')->get();
		$media      = Media::orderBy('id')->get();

		$sampah_terkumpul		= Nilai::value('sampah_terkumpul');
		$panti_hewan			= Nilai::value('panti_hewan');
		$hewan_tertangani		= Nilai::value('hewan_tertangani');
		$laporan_alam			= Nilai::value('laporan_alam');

    	$completed 		= Donations::sum('donation');
		$harga 			= AdminSettings::sum('hargapohon');
		$donation 		= $completed * $harga ;
		$member 		= User::where('status', 'active' )->where('role', 'normal' )->orderBy('id','DESC')->paginate($settings->result_request);
		$testimoni 		= Testimoni::orderBy('id')->get();
		$testi 			= Testimoni::orderBy('id')->first();

    	//$link = mysqli_connect("localhost", "root", "", "fundme2");
    	$sql_lokasi = DB::select("select DISTINCT a.title, a.lat, a.lng, a.id, CONCAT('campaign/',a.id,'/',a.title) as url, 
				concat_ws(' , ', concat('Lokasi : ',a.location),concat('Judul : ',a.title), 
					case when a.cat_id = '1' then	CONCAT('Jumlah Pohon : ', floor((SELECT ifnull( (select sum(donation) from donations where donations.campaigns_id = a.id ) / (select hargapohon from campaigns where campaigns.id = a.id ) ,0) from campaigns where id = a.id)) )
							else concat('Donasi : ', (select sum(donation) from donations where donations.campaigns_id = a.id ) ) end,
					CONCAT('Jumlah Donatur : ', floor(ifnull((select count(*) from donations  WHERE campaigns_id = a.id  ),0))),
					concat('Persentasi tumbuh : ', concat(round((a.hidup / (a.hidup + a.mati) * 100),2) , ' %') )    , 
					concat('Capaian Penurunan Emisi : ', round(a.hidup * ((select emisi from pohon where id_pohon = (SELECT id_pohon from campaigns where id = a.id) ) / 100 ) * ((datediff(CURDATE(), a.tanggal_pelaksanaan))/365) * (a.perkembangan / 100) , 2 ), ' kg'))  AS popup, 
					case when a.cat_id = '1' then concat('public/img-category/', (select image from categories where id = '1')) 
						when a.cat_id = '2' then concat('public/img-category/', (select image from categories where id = '2'))
						when a.cat_id = '3' then concat('public/img-category/', (select image from categories where id = '3')) end as image
				from campaigns a, donations b ");
    	
    	//$result=mysqli_query($link, $sql_lokasi) or die(mysqli_error());

		//$url			= '' 'campaign/'.'campaigns.id'.'/'.'campaigns.title'
		
		return view('index.home', ['data' => $data, 'categories' => $categories , 'completed' => $completed, 'partner' => $partner, 'media' => $media, 'donation' => $donation, 'jumlahdonasi' => $jumlahdonasi, 'member' => $member, 'sampah_terkumpul' => $sampah_terkumpul, 'panti_hewan' => $panti_hewan, 'hewan_tertangani' => $hewan_tertangani, 'laporan_alam' => $laporan_alam, 'testimoni' => $testimoni, 'testi' => $testi, 'sql_lokasi' => $sql_lokasi   ]);
		// end edited cacip
    }

    public function campaigns()
    {
       
	   $settings = AdminSettings::first();
	   $categories = Categories::where('mode','on')->orderBy('name')->get();
       $data      = Campaigns::where('publish','1')->where('finalized','0')->orderBy('id','DESC')->paginate($settings->result_request);
       $idcampaign = Campaigns::where('publish','1')->where('finalized','0')->first();
       if( str_slug( $idcampaign->title ) == '' ) {
				$slugUrl  = '';
			} else {
				$slugUrl  = str_slug( $idcampaign->title );
			}
		//edited cacip
       
		//return view('index.campaign', ['data' => $data, 'categories' => $categories   ]);
		return redirect('donate/'.$idcampaign->id.'/'.$slugUrl);
		// end edited cacip
    }

    public function join()
    {
       
	   $settings = AdminSettings::first();
	   $categories = Categories::where('mode','on')->orderBy('name')->get();
       $data      = Campaigns::where('publish','1')->where('finalized','0')->orderBy('id','DESC')->paginate($settings->result_request);
       $idcampaign = Campaigns::where('publish','1')->where('finalized','0')->first();
       if( str_slug( $idcampaign->title ) == '' ) {
				$slugUrl  = '';
			} else {
				$slugUrl  = str_slug( $idcampaign->title );
			}
		//edited cacip
       
		//return view('index.campaign', ['data' => $data, 'categories' => $categories   ]);
		return redirect('campaign/'.$idcampaign->id.'/'.$slugUrl);
		// end edited cacip
    }
	
	public function search(Request $request) {

		$q = trim($request->input('q'));
		$settings = AdminSettings::first();
		
		$page = $request->input('page');
		
		$data = Campaigns::where('publish','1')->where( 'title','LIKE', '%'.$q.'%' )
		->where('status', 'active' )
		->orWhere('location','LIKE', '%'.$q.'%')
		->where('publish','1')->where('status', 'active' )
		->groupBy('id')
		->orderBy('id', 'desc' )
		->paginate( $settings->result_request );

		
		$title = trans('misc.result_of').' '. $q .' - ';
		
		$total = $data->total();
		
		//<--- * If $page not exists * ---->
		if( $page > $data->lastPage() ) {
			abort('404');
		}
		
		//<--- * If $q is empty or is minus to 1 * ---->
		if( $q == '' || strlen( $q ) <= 1 ){
			return redirect('/');
		}
		
		return view('default.search', compact( 'data', 'title', 'total', 'q' ));
		
	}// End Method
	
		public function getVerifyAccount( $confirmation_code ) {
		

		if( !Auth::check() ) {
		$user = User::where( 'confirmation_code', $confirmation_code )->where('status','pending')->first();
		
		if( $user ) {
			
			$update = User::where( 'confirmation_code', $confirmation_code )
			->where('status','pending')
			->update( array( 'status' => 'active', 'confirmation_code' => '' ) );
			

			Auth::loginUsingId($user->id);
			
			 return redirect('/')
					->with([
						'success_verify' => true,
					]);
			} else {
			return redirect('/')
					->with([
						'error_verify' => true,
					]);
			}
		} else {
			 return redirect('/');
		}
	}// End Method
	
	public function category($slug) {
		
		$settings = AdminSettings::first();
			
		 $category = Categories::where('slug','=',$slug)->where('mode','on')->firstOrFail();
	  	 $data       = Campaigns::where('status', 'active')->where('categories_id',$category->id)->orderBy('id','DESC')->paginate($settings->result_request);
				
		return view('default.category', ['data' => $data, 'category' => $category]);
		
	}// End Method

	// laoran masalah
	
	
	public function lapor() {

	    if( $this->request->hasFile('photo') )	{
	    	
			$extension    = $this->request->file('photo')->getClientOriginalExtension();
			$file_large     = strtolower(Auth::user()->id.time().str_random(40).'.'.$extension);
			$file_small     = strtolower(Auth::user()->id.time().str_random(40).'.'.$extension);
			
			if( $this->request->file('photo')->move($temp, $file_large) ) {
				
				set_time_limit(0);
				
				//=============== Image Large =================//
				$width  = Helper::getWidth( $temp.$file_large );
				$height = Helper::getHeight( $temp.$file_large );
				$max_width = '800';
				
				if( $width < $height ) {
					$max_width = '400';
				}
				
				if ( $width > $max_width ) {
					$scale = $max_width / $width;
					$uploaded = Helper::resizeImage( $temp.$file_large, $width, $height, $scale, $temp.$file_large );
				} else {
					$scale = 1;
					$uploaded = Helper::resizeImage( $temp.$file_large, $width, $height, $scale, $temp.$file_large );
				}
				
				//=============== Small Large =================//
				Helper::resizeImageFixed( $temp.$file_large, 400, 300, $temp.$file_small );
				
				//======= Copy Folder Small and Delete...
				if ( \File::exists($temp.$file_small) ) {
					\File::copy($temp.$file_small, $path_small.$file_small);
					\File::delete($temp.$file_small);
				}//<--- IF FILE EXISTS
				
				
				//======= Copy Folder Large and Delete...
				if ( \File::exists($temp.$file_large) ) {
					\File::copy($temp.$file_large, $path_large.$file_large);
					\File::delete($temp.$file_large);
				}//<--- IF FILE EXISTS
				
			}

			$image_small  = $file_small;
			$image_large  = $file_large; 
			
	    }//<====== End HasFile
		
	    $description = html_entity_decode($this->request->description);
		
		//REMOVE SCRIPT TAG
		$description = Helper::removeTagScript($description);
					
		//REMOVE SCRIPT Iframe
		$description = Helper::removeTagIframe($description);
	    
	    $description = trim(Helper::spaces($description));
		
	    $sql                        = new LaporanMasalah;
		$sql->title                = trim($this->request->title);
		$sql->description     = Helper::removeBR($description);
		$sql->id_user          = Auth::user()->id;
		$sql->date               = Carbon::now();
		$sql->location          = trim($this->request->location);
		if($this->request->anonymous == null){
			$sql->anonymous           = '0';
		}else{
			$sql->anonymous           = $this->request->anonymous;
		}
		$sql->latitude          = $this->request->lat;
		$sql->longitude          = $this->request->lng;
		$sql->image          = $image_large;
		$sql->id_status_laporan          = 1;

		$sql->save();
		
	    
	    return response()->json([
				        'success' => true,
				        'stripeSuccess' => true,
				        'target' => url('home/laporsukses'),
				    ]);
		
	}//<<--- End Method

}
