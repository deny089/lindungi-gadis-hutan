<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\AdminSettings;
use App\Models\Campaigns;
use App\Models\Donations;
use App\Models\Categories;
//edited cacip
use App\Models\Reward;
use App\Models\Pohon;
use App\Models\Partner;
use App\Models\Testimoni;
use App\Models\Blog;
use App\Models\Media;
use App\Models\LaporanMasalah;
use App\Models\Nilai;
//end edited cacip
use App\Models\Withdrawals;
use App\Helper;
use Carbon\Carbon;
use Fahim\PaypalIPN\PaypalIPNListener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Mail;

class AdminController extends Controller {
	
	public function __construct( AdminSettings $settings) {
		$this->settings = $settings::first();
	}
	
		 public function index(Request $request) {
	 	
		$query = $request->input('q');
		
		if( $query != '' && strlen( $query ) > 2 ) {
		 	$data = User::where('name', 'LIKE', '%'.$query.'%')
			->orWhere('username', 'LIKE', '%'.$query.'%')
		 	->orderBy('id','desc')->paginate(20);
		 } else {
		 	$data = User::orderBy('id','desc')->paginate(20);
		 }
		
    	return view('admin.members', ['data' => $data,'query' => $query]);
	 }

	public function edit($id) {
		
		$data = User::findOrFail($id);
		
		if( $data->id == 1 || $data->id == Auth::user()->id ) {
			\Session::flash('info_message', trans('admin.user_no_edit'));
			return redirect('panel/admin/members');
		}
    	return view('admin.edit-member')->withData($data);
	
	}//<--- End Method
	
	public function update($id, Request $request) {
    	
    $user = User::findOrFail($id);
		
	$input = $request->all();
	
	if( !empty( $request->password ) )	 {
		$rules = array(
			'name' => 'required|min:3|max:25',
			'email'     => 'required|email|unique:users,email,'.$id,
			 'password' => 'min:6',
			);
			
			$password = \Hash::make($request->password);
			
	} else {
		$rules = array(
			'name' => 'required|min:3|max:25',
			'email'     => 'required|email|unique:users,email,'.$id,
			);
			
			$password = $user->password;
	}
		
	   $this->validate($request,$rules);
	  
	  $user->name = $request->name;
	  $user->email = $request->email;
	  $user->role = $request->role;
	  $user->password = $password;
      $user->save();

    \Session::flash('success_message', trans('admin.success_update'));

    return redirect('panel/admin/members');
	
	}//<--- End Method
	
	public function destroy($id)
    {
    	$user = User::findOrFail($id);
		
    	if( $user->id == 1 || $user->id == Auth::user()->id ) {
    		return redirect('panel/admin/members');
			exit;
    	}
				
		// Find User
		
		// Stop Campaigns
		$allCampaigns = Campaigns::where('user_id',$id)->update(array('finalized' => '1'));
		
		//<<<-- Delete Avatar -->>>/
		$fileAvatar    = 'public/avatar/'.$user->avatar;
			
		if ( \File::exists($fileAvatar) && $user->avatar != 'default.jpg' ) {
			 \File::delete($fileAvatar);	
		}//<--- IF FILE EXISTS
		
			
        $user->delete();
		return redirect('panel/admin/members');
		
    }//<--- End Method
    
    public function add_member() {
    	return view('admin.add-member');
    }
	
	public function storeMember(Request $request){
		
		$this->validate($request, [
			'name' => 'required|min:3|max:30',
            'email'     => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
		
		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->role = $request->role;
		$user->avatar = 'default.jpg';
		$user->token = str_random(80);
		$user->password = \Hash::make($request->password);
		$user->save();
		
		 \Session::flash('success_message', trans('admin.success_add'));
		return redirect('panel/admin/members');
		
	}
    
	// START
	public function admin() {
		
		return view('admin.dashboard');
				
	}//<--- END METHOD
	
	public function settings() {
		
		return view('admin.settings')->withSettings($this->settings);
		
	}//<--- END METHOD
	
	public function saveSettings(Request $request) {
						
		$rules = array(
            'title'            => 'required',
	        'welcome_text' 	   => 'required',
	        'welcome_subtitle' => 'required',
	        'keywords'         => 'required',
	        'description'      => 'required',
	        'email_no_reply'   => 'required',
	        'email_admin'      => 'required',
        );
		
		$this->validate($request, $rules);
		
		$sql                      = AdminSettings::first();
		$sql->title               = $request->title;
		$sql->welcome_text        = $request->welcome_text;
		$sql->welcome_subtitle    = $request->welcome_subtitle;
		$sql->keywords            = $request->keywords;
		$sql->description         = $request->description;
		$sql->email_no_reply      = $request->email_no_reply;
		$sql->email_admin         = $request->email_admin;
		$sql->email_verification = $request->email_verification;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_update'));

    	return redirect('panel/admin/settings');
						
	}//<--- END METHOD
	
	public function settingsLimits() {
		
		return view('admin.limits')->withSettings($this->settings);
		
	}//<--- END METHOD
	
	public function saveSettingsLimits(Request $request) {
		
				
		$rules = array(
	        'min_campaign_amount'             => 'required|integer|min:1',
	        'max_campaign_amount'             => 'required|integer|min:1',
	        'min_donation_amount'             => 'required|integer|min:1',
        );
		
		$this->validate($request, $rules);
				
		$sql                      = AdminSettings::first();
		$sql->result_request      = $request->result_request;
		$sql->file_size_allowed   = $request->file_size_allowed;
		$sql->min_campaign_amount   = $request->min_campaign_amount;
		$sql->max_campaign_amount   = $request->max_campaign_amount;
		$sql->min_donation_amount   = $request->min_donation_amount;
		
		$sql->save();

		\Session::flash('success_message', trans('admin.success_update'));

    	return redirect('panel/admin/settings/limits');
						
	}//<--- END METHOD
	
	public function profiles_social(){
		return view('admin.profiles-social')->withSettings($this->settings);
	}//<--- End Method
	
	public function update_profiles_social(Request $request) {
			
		$sql = AdminSettings::find(1);
		
		$rules = array(
            'twitter'    => 'url',
            'facebook'   => 'url',
            'googleplus' => 'url',
            'linkedin'   => 'url',
        );
		
		$this->validate($request, $rules);
		
	    $sql->twitter       = $request->twitter;
		$sql->facebook      = $request->facebook;
		$sql->googleplus    = $request->googleplus;
		$sql->instagram     = $request->instagram;
		
		$sql->save();
	
	    \Session::flash('success_message', trans('admin.success_update'));
	
	    return redirect('panel/admin/profiles-social');
	}//<--- End Method
	
	public function donations(){
		
		$data = Donations::orderBy('id','DESC')->paginate(100);
		//$settings = AdminSettings::first();

		return view('admin.donations', ['data' => $data, 'settings' => $this->settings]);
	}//<--- End Method
	
	public function saveconfirmed(Request $request){
		
		$data = Donations::find($request->id);
		$data->confirmed = '1';
		$data->save();
		//$settings = AdminSettings::first();

		\Session::flash('success_message', trans('admin.success_update'));

	    	return redirect('panel/admin/donations');
		}//<--- End Method

	public function donationView($id){
		
		$data = Donations::findOrFail($id);
		return view('admin.donation-view', ['data' => $data, 'settings' => $this->settings]);
	}//<--- End Method

	public function deleteDonation($id){
		
		$data = Donations::find($id);
		$data->delete();
		 
		 \Session::flash('success_message', trans('misc.success_delete'));
	    return redirect('panel/admin/donations');
	}

	
	public function payments(){
		return view('admin.payments-settings')->withSettings($this->settings);
	}//<--- End Method
	
	public function savePayments(Request $request) {
			
		$sql = AdminSettings::find(1);
		
		$rules = array(
            'paypal_account'    => 'required|email',
        );
		
		$this->validate($request, $rules);
		
		switch( $request->currency_code ) {
			case 'RP':
				$currency_symbol  = 'RP';
				break;
			case 'USD':
				$currency_symbol  = '$';
				break;
			case 'EUR':
				$currency_symbol  = '€';
				break;
			case 'GBP':
				$currency_symbol  = '£';
				break;
			case 'AUD':
				$currency_symbol  = '$';
				break;
			case 'JPY':
				$currency_symbol  = '¥';
				break;
				
			case 'BRL':
				$currency_symbol  = 'R$';
				break;
			case 'MXN':
				$currency_symbol  = '$';
				break;
			case 'SEK':
				$currency_symbol  = 'Kr';
				break;
			case 'CHF':
				$currency_symbol  = 'CHF';
				break;
			case 'SGD':
				$currency_symbol  = '$';
				break;
			case 'DKK':
				$currency_symbol  = 'Kr';
				break;
			case 'RUB':
				$currency_symbol  = 'руб';
				break;
		}
		//edited cacip
	//	switch( $request->kode_pohon ) {
	//		case 'T':
	//			$simbol_pohon  = 'T';
	//			break;
	//	}
		// end edited cacip
	    $sql->paypal_account     = $request->paypal_account;
		$sql->currency_symbol  = $currency_symbol;
		$sql->currency_code    = $request->currency_code;
		//edited cacip
	//	$sql->simbol_pohon      = $simbol_pohon;
		$sql->kode_pohon    = $request->kode_pohon;
		// end edited cacip		
		$sql->paypal_sandbox   = $request->paypal_sandbox;
		$sql->payment_gateway    = $request->payment_gateway;
		$sql->fee_donation = $request->fee_donation;
		$sql->stripe_secret_key    = $request->stripe_secret_key;
		$sql->stripe_public_key    = $request->stripe_public_key;
		
		$sql->save();
	
	    \Session::flash('success_message', trans('admin.success_update'));
	
	    return redirect('panel/admin/payments');
	}//<--- End Method
	
	public function campaigns(){
		
		$data = Campaigns::orderBy('id','DESC')->paginate(50);
		return view('admin.campaigns', ['data' => $data, 'settings' => $this->settings]);
	}//<--- End Method
	
	public function withdrawals(){
		
		$data = Withdrawals::orderBy('id','DESC')->paginate(50);
		return view('admin.withdrawals', ['data' => $data, 'settings' => $this->settings]);
	}//<--- End Method
	
	public function withdrawalsView($id){
		$data = Withdrawals::findOrFail($id);
		return view('admin.withdrawal-view', ['data' => $data, 'settings' => $this->settings]);
	}//<--- End Method
	
	public function withdrawalsPaid(Request $request){
		
		$data = Withdrawals::findOrFail($request->id);
		$user = User::find($data->campaigns()->user_id);
		
		$data->status       = 'paid';
		$data->date_paid = Carbon::now();
		$data->save();
		
		//<------ Send Email to User ---------->>>
		$amount    = $this->settings->currency_symbol.number_format($data->amount).' '.$this->settings->currency_code;
		$sender     = $this->settings->email_no_reply;
	    $titleSite     = $this->settings->title;
		$campaign = $data->campaigns()->title;
		$fullNameUser = $user->name;
		$_emailUser = $user->email;
		
		Mail::send('emails.withdrawal-processed', array( 
					'campaign' => $campaign, 
					'amount' => $amount, 
					'title_site' => $titleSite, 
					'fullname' => $fullNameUser
		), 
					function($message) use ( $sender, $fullNameUser, $titleSite, $_emailUser)
						{
						    $message->from($sender, $titleSite)
						    	->to($_emailUser, $fullNameUser)
								->subject( trans('misc.withdrawal_processed').' - '.$titleSite );
						});
			//<------ Send Email to User ---------->>>
						
		return redirect('panel/admin/withdrawals');
		
	}//<--- End Method
	
	public function withdrawlsIpn(){
		
		$ipn = new PaypalIPNListener();
		
		$ipn->use_curl = false;
		
		if ( $this->settings->paypal_sandbox == 'true') {
			// SandBox
			$ipn->use_sandbox = true;
			} else {
			// Real environment
			$ipn->use_sandbox = false;
			}
			
	    $verified = $ipn->processIpn();
		
		$withdrawalsID    = $_POST['custom'];
		$payment_status = $_POST['payment_status'];
		$txn_id               = $_POST['txn_id'];
		
		if ($verified) {
	        if($payment_status == 'Completed'){
	        	
				$verifiedTxnId = Withdrawals::where('txn_id',$txn_id)->first();
				$data             = Withdrawals::find($withdrawalsID);
				$user            = User::find($data->campaigns()->user_id);
				
				if( !isset( $verifiedTxnId ) && isset($data) ) {
					$data->status       = 'paid';
					$data->date_paid = Carbon::now();
					$data->save();
					
					//<------ Send Email to User ---------->>>
		$amount    = $this->settings->currency_symbol.number_format($data->amount).' '.$this->settings->currency_code;
		$sender     = $this->settings->email_no_reply;
	    $titleSite     = $this->settings->title;
		$campaign = $data->campaigns()->title;
		$fullNameUser = $user->name;
		$_emailUser = $user->email;
		
		Mail::send('emails.withdrawal-processed', array( 
					'campaign' => $campaign, 
					'amount' => $amount, 
					'title_site' => $titleSite, 
					'fullname' => $fullNameUser
		), 
					function($message) use ( $sender, $fullNameUser, $titleSite, $_emailUser)
						{
						    $message->from($sender, $titleSite)
						    	->to($_emailUser, $fullNameUser)
								->subject( trans('misc.withdrawal_processed').' - '.$titleSite );
						});
			//<------ Send Email to User ---------->>>
					
				}// Isset $verifiedTxnId
     	
	        }// $payment_status
		}// $verified
		
	}//<--- End Method
	
	
	public function editCampaigns($id){
		
		$data = Campaigns::findOrFail($id);
		return view('admin.edit-campaign', ['data' => $data, 'settings' => $this->settings]);
	}
	
	public function postEditCampaigns(Request $request){
		
		$sql = Campaigns::findOrFail($request->id);
		
		Validator::extend('text_required', function($attribute, $value, $parameters)
			{
				$value = preg_replace("/\s|&nbsp;/",'',$value);   
			    return strip_tags($value);
			});
			
		$messages = array (
		'description.required' => trans('misc.description_required'),
		'description.text_required' => trans('misc.text_required'),
		//'categories_id.required' => trans('misc.please_select_category'),
		'goal.min' => trans('misc.amount_minimum', ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),
		'goal.max' => trans('misc.amount_maximum', ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),
	);
	
		$rules = array(
            'title'             => 'required|min:3|max:45',
            //'categories_id'  => 'required',
	    	//'goal'             => 'required|integer|max:'.$this->settings->max_campaign_amount.'|min:'.$this->settings->min_campaign_amount,
	    	 'location'        => 'required|max:50',
	        'description'  => 'text_required|required|min:20',
        );
		
		$this->validate($request, $rules, $messages);
		
		$description = html_entity_decode($request->description);
		
		//REMOVE SCRIPT TAG
		$description = Helper::removeTagScript($description);
					
		//REMOVE SCRIPT Iframe
		$description = Helper::removeTagIframe($description);
		
		$description = trim(Helper::spaces($description));
		
		$sql->title = $request->title;
		$sql->goal = $request->goal;
		$sql->goalhewan = $request->goalhewan;
		$sql->location = $request->location;
		$sql->description = Helper::removeBR($description);
		$sql->finalized = $request->finalized;
		$sql->publish = $request->publish;
		//$tanggal = $request->tanggal_pelaksanaan;
		//$sql->tanggal_pelaksanaan = date('Y-m-d', strtotime($tanggal));
		$sql->id_pohon  = $request->id_pohon;
		//$sql->hargapohon = Pohon::where('id_pohon',$request->id_pohon)->value('harga');
		$sql->lat          = $request->lat;
		$sql->lng          = $request->lng;
		$sql->youtube      = $request->youtube;
		$sql->youtube2      = $request->youtube2;
		//$sql->categories_id = $request->categories_id;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_update'));
	    return redirect('panel/admin/campaigns');
	}

	public function pantauCampaigns($id){
		
		$data = Campaigns::findOrFail($id);
		return view('admin.pantau-campaign', ['data' => $data, 'settings' => $this->settings]);
	}
	
	public function postPantauCampaigns(Request $request){
		
		$sql = Campaigns::findOrFail($request->id);

		$sql->tinggi			= $request->tinggi;
		$sql->diameter          = $request->diameter;
		$sql->hidup          	= $request->hidup;
		$sql->mati          	= $request->mati;
		$sql->petani          	= $request->petani;
		$sql->jabatan_petani    = $request->jabatan_petani;
		$sql->proyeksi    		= $request->proyeksi;
		$sql->perkembangan    	= $request->perkembangan;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_update'));
	    return redirect('panel/admin/campaigns');
	}
	
	public function deleteCampaign(Request $request){
		
		$data = Campaigns::findOrFail($request->id);
		
		$path_small     = 'public/campaigns/small/'; 
		$path_large     = 'public/campaigns/large/';
		$path_updates = 'public/campaigns/updates/';
		
		$updates = $data->updates()->get();
		
		//Delete Updates
		foreach ($updates as $key) {
			
			if ( \File::exists($path_updates.$key->image) ) {
					\File::delete($path_updates.$key->image);
				}//<--- if file exists
				
				$key->delete();
		}//<-- 
		
		// Delete Campaign
		if ( \File::exists($path_small.$data->small_image) ) {
					\File::delete($path_small.$data->small_image);
				}//<--- if file exists
				
				if ( \File::exists($path_large.$data->large_image) ) {
					\File::delete($path_large.$data->large_image);
				}//<--- if file exists
		
		 $data->delete();
		 
		 \Session::flash('success_message', trans('misc.success_delete'));
	    return redirect('panel/admin/campaigns');
	}

	// START
	public function categories() {
		
		$categories      = Categories::orderBy('name')->get();
		$totalCategories = count( $categories );
		
		return view('admin.categories', compact( 'categories', 'totalCategories' ));
				
	}//<--- END METHOD
	
	public function addCategories() {
		
		return view('admin.add-categories');
				
	}//<--- END METHOD
	
	public function storeCategories(Request $request) {
		
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-category/'; // Path General
	    					
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'name'        => 'required',
	        'slug'        => 'required|ascii_only|unique:categories',
	        'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|image_size:>=30,>=30',
        );
		
		$this->validate($request, $rules);
		
		if( $request->hasFile('thumbnail') )	{
		
		$extension              = $request->file('thumbnail')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('thumbnail')->getMimeType();
		$sizeFile                 = $request->file('thumbnail')->getSize();
		$thumbnail              = $request->slug.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('thumbnail')->move($temp, $thumbnail) ) {
			
			$image = Image::make($temp.$thumbnail);
			
			if(  $image->width() == 30 && $image->height() == 30 ) {
				
					\File::copy($temp.$thumbnail, $path.$thumbnail);
					\File::delete($temp.$thumbnail);
			
			} else {
				$image->fit(30, 30)->save($temp.$thumbnail);
				
				\File::copy($temp.$thumbnail, $path.$thumbnail);
				\File::delete($temp.$thumbnail);
			}
			
			}// End File
		} // HasFile
		
		$sql                      = New Categories;
		$sql->name         = $request->name;
		$sql->slug            = $request->slug;
		$sql->mode         = $request->mode;
		$sql->image       = $thumbnail;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/categories');
						
	}//<--- END METHOD
	
	public function editCategories($id) {
		
		$categories        = Categories::find( $id );
		
		return view('admin.edit-categories')->with('categories',$categories);
				
	}//<--- END METHOD
	
	public function updateCategories( Request $request ) {
		
		
		$categories        = Categories::find( $request->id );
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-category/'; // Path General
	    
	    if( !isset($categories) ) {
			return redirect('panel/admin/categories');
		}
			
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'name'        => 'required',
	        'slug'        => 'required|ascii_only|unique:categories,slug,'.$request->id,
	        'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|image_size:>=30,>=30',
	     );
		
		$this->validate($request, $rules);	
		
		if( $request->hasFile('thumbnail') )	{
		
		$extension              = $request->file('thumbnail')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('thumbnail')->getMimeType();
		$sizeFile                 = $request->file('thumbnail')->getSize();
		$thumbnail              = $request->slug.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('thumbnail')->move($temp, $thumbnail) ) {
			
			$image = Image::make($temp.$thumbnail);
			
			if(  $image->width() == 30 && $image->height() == 30 ) {
				
					\File::copy($temp.$thumbnail, $path.$thumbnail);
					\File::delete($temp.$thumbnail);
			
			} else {
				$image->fit(30, 30)->save($temp.$thumbnail);
				
				\File::copy($temp.$thumbnail, $path.$thumbnail);
				\File::delete($temp.$thumbnail);
			}
			
			// Delete Old Image
			\File::delete($path.$categories->thumbnail);
			
			}// End File
		} // HasFile
		else {
			$thumbnail = $categories->thumbnail;
		}	
		
		// UPDATE CATEGORY
		$categories->name         = $request->name;
		$categories->slug            = $request->slug;
		$categories->mode         = $request->mode;
		$categories->image         = $thumbnail;
		$categories->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/categories');
				
	}//<--- END METHOD
	
	public function deleteCategories($id){
		
		$categories        = Categories::find( $id );
		$thumbnail          = 'public/img-category/'.$categories->thumbnail; // Path General
		
		if( !isset($categories) ) {
			return redirect('panel/admin/categories');
		} else {
					
			// Delete Category	
			$categories->delete();
			
			// Delete Thumbnail
			if ( \File::exists($thumbnail) ) {
				\File::delete($thumbnail);	
			}//<--- IF FILE EXISTS
			
			return redirect('panel/admin/categories');
		}	
	}//<--- END METHOD

	// START reward
	public function reward() {
		
		$reward      = Reward::orderBy('id', 'desc')->get();
		$totalReward = count( $reward );
		
		return view('admin.reward', compact( 'reward', 'totalReward' ));
				
	}//<--- END METHOD
	
	public function addReward() {
		
		return view('admin.add-reward');
				
	}//<--- END METHOD
	
	public function storeReward(Request $request) {
		
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-reward/'; // Path General
	    					
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'hadiah'        => 'required',
	        'image'   => 'mimes:jpg,gif,png,jpe,jpeg',
        );
		
		$this->validate($request, $rules);
		
		if( $request->hasFile('image') )	{
		
		$extension              = $request->file('image')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('image')->getMimeType();
		$sizeFile                 = $request->file('image')->getSize();
		$image              = str_random(32).'.'.$extension;
		
		if( $request->file('image')->move($temp, $image) ) {
			
			$image = Image::make($temp.$image);
			
			if(  $image->width() == 30 && $image->height() == 30 ) {
				
					\File::copy($temp.$image, $path.$image);
					\File::delete($temp.$image);
			
			} else {
				$image->fit(30, 30)->save($temp.$image);
				
				\File::copy($temp.$image, $path.$image);
				\File::delete($temp.$image);
			}
			
			}// End File
		} // HasFile

		$sql                      = New Reward;
		$sql->hadiah         = $request->hadiah;
		$sql->tanggal_pengundian            = $request->tanggal_pengundian;
		$sql->keterangan         = $request->keterangan;
		$sql->pemenang         = $request->pemenang;
		$sql->id_user            = $request->id_user;
		$sql->status         = $request->status;
		$sql->date         = Carbon::now();
		$sql->image       = $image;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/reward');
						
	}//<--- END METHOD
	
	

	//edited cacip untuk Pohon
	// START
	public function pohon() {
		
		$pohon      = Pohon::orderBy('id_pohon')->get();
		$totalPohon = count( $pohon );
		
		return view('admin.pohon', compact( 'pohon', 'totalPohon' ));
				
	}//<--- END METHOD
	
	public function addPohon() {
		
		return view('admin.add-pohon');
				
	}//<--- END METHOD
	
	public function storePohon(Request $request) {
		
		$sql               = New Pohon;
		$sql->nama         = $request->nama;
		$sql->harga        = $request->harga;
		$sql->deskripsi    = $request->deskripsi;
		$sql->emisi    		= $request->emisi;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_pohon'));

    	return redirect('panel/admin/pohon');
						
	}//<--- END METHOD
	
	public function editPohon($id_pohon) {
		
		$pohon        = Pohon::findOrFail( $id_pohon );
		
		return view('admin.edit-pohon', ['pohon' => $pohon, 'settings' => $this->settings]);
				
	}//<--- END METHOD
	
	public function updatePohon( Request $request ) {
		
		$pohon        = Pohon::find( $request->id_pohon );
		
		// UPDATE pohon
		$pohon->nama         = $request->nama;
		$pohon->harga        = $request->harga;
		$pohon->deskripsi    = $request->deskripsi;
		$pohon->emisi    		= $request->emisi;
		$pohon->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/pohon');
				
	}//<--- END METHOD
	
	public function deletePohon($id_pohon){
		
		$pohon        = Pohon::find( $id_pohon );
		
		if( !isset($pohon) ) {
			return redirect('panel/admin/pohon');
		} else {
					
			// Delete Category	
			$pohon->delete();
			
			return redirect('panel/admin/pohon');
		}	
	}//<--- END METHOD

	//edited untuk partnership
	// START
	public function partner() {
		
		$partner      = Partner::orderBy('nama')->get();
		$totalPartner = count( $partner );
		
		return view('admin.partner', compact( 'partner', 'totalPartner' ));
				
	}//<--- END METHOD
	
	public function addPartner() {
		
		return view('admin.add-partner');
				
	}//<--- END METHOD
	
	public function storePartner(Request $request) {
		
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-partner/'; // Path General
	    					
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'nama'        => 'required',
	        //'deskripsi'        => 'required|ascii_only|unique:categories',
	        'gambar'   => 'mimes:jpg,gif,png,jpe,jpeg|image_size:>=200,>=200',
        );
		
		$this->validate($request, $rules);
		
		if( $request->hasFile('gambar') )	{
		
		$extension        = $request->file('gambar')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('gambar')->getMimeType();
		$sizeFile         = $request->file('gambar')->getSize();
		$gambar        	  = $request->id.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('gambar')->move($temp, $gambar) ) {
			
			$image = Image::make($temp.$gambar);
			
			if(  $image->width() == 200 && $image->height() == 200 ) {
				
					\File::copy($temp.$gambar, $path.$gambar);
					\File::delete($temp.$gambar);
			
			} else {
				$image->fit(200, 200)->save($temp.$gambar);
				
				\File::copy($temp.$gambar, $path.$gambar);
				\File::delete($temp.$gambar);
			}
			
			}// End File
		} // HasFile
		
		$sql			= New Partner;
		$sql->nama 		= $request->nama; 
		$sql->deskripsi	= $request->deskripsi;
		$sql->gambar    = $gambar;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/partner');
						
	}//<--- END METHOD
	
	public function editPartner($id) {
		
		$partner        = Partner::find( $id );
		
		return view('admin.edit-partner')->with('partner',$partner);
				
	}//<--- END METHOD
	
	public function updatePartner( Request $request ) {
		
		
		$partner        = Partner::find( $request->id );
		$temp           = 'public/temp/'; // Temp
	    $path           = 'public/img-partner/'; // Path General
	    
	    if( !isset($partner) ) {
			return redirect('panel/admin/partner');
		}
			
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'nama'        => 'required',
	        //'slug'        => 'required|ascii_only|unique:categories,slug,'.$request->id,
	        'gambar'   => 'mimes:jpg,gif,png,jpe,jpeg|image_size:>=200,>=200',
	     );
		
		$this->validate($request, $rules);	
		
		if( $request->hasFile('gambar') )	{
		
		$extension        = $request->file('gambar')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('gambar')->getMimeType();
		$sizeFile         = $request->file('gambar')->getSize();
		$gambar           = $request->id.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('gambar')->move($temp, $gambar) ) {
			
			$image = Image::make($temp.$gambar);
			
			if(  $image->width() == 200 && $image->height() == 200 ) {
				
					\File::copy($temp.$gambar, $path.$gambar);
					\File::delete($temp.$gambar);
			
			} else {
				$image->fit(200, 200)->save($temp.$gambar);
				
				\File::copy($temp.$gambar, $path.$gambar);
				\File::delete($temp.$gambar);
			}
			
			// Delete Old Image
			\File::delete($path.$partner->gambar);
			
			}// End File
		} // HasFile
		else {
			$gambar = $partner->gambar;
		}	
		
		// UPDATE CATEGORY
		$partner->nama         = $request->nama;
		$partner->deskripsi    = $request->deskripsi;
		$partner->gambar       = $gambar;
		$partner->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/partner');
				
	}//<--- END METHOD
	
	public function deletePartner($id){
		
		$partner        = Partner::find( $id );
		$gambar         = 'public/img-partner/'.$partner->gambar; // Path General
		
		if( !isset($partner) ) {
			return redirect('panel/admin/partner');
		} else {
					
			// Delete Category	
			$partner->delete();
			
			// Delete Thumbnail
			if ( \File::exists($gambar) ) {
				\File::delete($gambar);	
			}//<--- IF FILE EXISTS
			
			return redirect('panel/admin/partner');
		}	
	}//<--- END METHOD
	//end edited cacip

	//edited untuk testimoni
	// START
	public function testimoni() {
		
		$testimoni      = Testimoni::orderBy('id')->get();
		$totalTestimoni = count( $testimoni );
		
		return view('admin.testimoni', compact( 'testimoni', 'totalTestimoni' ));
				
	}//<--- END METHOD
	
	public function addTestimoni() {
		
		return view('admin.add-testimoni');
				
	}//<--- END METHOD
	
	public function storeTestimoni(Request $request) {
		
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-testimoni/'; // Path General
	    					
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'nama'        => 'required',
        );
		
		$this->validate($request, $rules);
		
		if( $request->hasFile('gambar') )	{
		
		$extension        = $request->file('gambar')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('gambar')->getMimeType();
		$sizeFile         = $request->file('gambar')->getSize();
		$gambar        	  = $request->id.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('gambar')->move($temp, $gambar) ) {
			
			$image = Image::make($temp.$gambar);
			
			if(  $image->width() == 100 && $image->height() == 100 ) {
				
					\File::copy($temp.$gambar, $path.$gambar);
					\File::delete($temp.$gambar);
			
			} else {
				$image->fit(100, 100)->save($temp.$gambar);
				
				\File::copy($temp.$gambar, $path.$gambar);
				\File::delete($temp.$gambar);
			}
			
			}// End File
		} // HasFile
		
		$sql			= New Testimoni;
		$sql->nama 		= $request->nama; 
		$sql->testimoni	= $request->testimoni;
		$sql->gambar    = $gambar;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/testimoni');
						
	}//<--- END METHOD
	
	public function editTestimoni($id) {
		
		$testimoni        = Testimoni::find( $id );
		
		return view('admin.edit-testimoni')->with('testimoni',$testimoni);
				
	}//<--- END METHOD
	
	public function updateTestimoni( Request $request ) {
		
		
		$testimoni        = Testimoni::find( $request->id );
		$temp           = 'public/temp/'; // Temp
	    $path           = 'public/img-testimoni/'; // Path General
	    
	    if( !isset($testimoni) ) {
			return redirect('panel/admin/testimoni');
		}
			
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'nama'        => 'required',
	     );
		
		$this->validate($request, $rules);	
		
		if( $request->hasFile('gambar') )	{
		
		$extension        = $request->file('gambar')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('gambar')->getMimeType();
		$sizeFile         = $request->file('gambar')->getSize();
		$gambar           = $request->id.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('gambar')->move($temp, $gambar) ) {
			
			$image = Image::make($temp.$gambar);
			
			if(  $image->width() == 100 && $image->height() == 100 ) {
				
					\File::copy($temp.$gambar, $path.$gambar);
					\File::delete($temp.$gambar);
			
			} else {
				$image->fit(100, 100)->save($temp.$gambar);
				
				\File::copy($temp.$gambar, $path.$gambar);
				\File::delete($temp.$gambar);
			}
			
			// Delete Old Image
			\File::delete($path.$testimoni->gambar);
			
			}// End File
		} // HasFile
		else {
			$gambar = $testimoni->gambar;
		}	
		
		// UPDATE CATEGORY
		$testimoni->nama         = $request->nama;
		$testimoni->testimoni    = $request->testimoni;
		$testimoni->gambar       = $gambar;
		$testimoni->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/testimoni');
				
	}//<--- END METHOD
	
	public function deleteTestimoni($id){
		
		$testimoni        = Testimoni::find( $id );
		$gambar         = 'public/img-testimoni/'.$testimoni->gambar; // Path General
		
		if( !isset($testimoni) ) {
			return redirect('panel/admin/testimoni');
		} else {
					
			// Delete Category	
			$testimoni->delete();
			
			// Delete Thumbnail
			if ( \File::exists($gambar) ) {
				\File::delete($gambar);	
			}//<--- IF FILE EXISTS
			
			return redirect('panel/admin/testimoni');
		}	
	}//<--- END METHOD
	//end edited testimoni cacip

	//edited untuk blog
	// START
	public function blog() {
		
		$blog      = Blog::orderBy('created_at','desc')->get();
		$totalBlog = count( $blog );
		
		return view('admin.blog', compact( 'blog', 'totalBlog' ));
				
	}//<--- END METHOD
	
	public function addBlog() {
		
		return view('admin.add-blog');
				
	}//<--- END METHOD
	
	public function storeBlog(Request $request) {
		
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-blog/'; // Path General
	    					
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'judul'        => 'required',
            'isi'        => 'required',
	        //'gambar'   => 'mimes:jpg,gif,png,jpe,jpeg|image_size:>=400,>=400',
        );
		
		$this->validate($request, $rules);
		
		if( $request->hasFile('gambar') )	{
		
		$extension        = $request->file('gambar')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('gambar')->getMimeType();
		$sizeFile         = $request->file('gambar')->getSize();
		$gambar        	  = $request->id.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('gambar')->move($temp, $gambar) ) {
			
			$image = Image::make($temp.$gambar);
			
			if(  $image->width() == 400 && $image->height() == 400 ) {
				
					\File::copy($temp.$gambar, $path.$gambar);
					\File::delete($temp.$gambar);
			
			} else {
				$image->fit(400, 400)->save($temp.$gambar);
				
				\File::copy($temp.$gambar, $path.$gambar);
				\File::delete($temp.$gambar);
			}
			
			}// End File
		} // HasFile
		
		$sql				= New Blog;
		$sql->judul 		= $request->judul; 
		$sql->isi			= $request->isi;
		$sql->keyword		= $request->keyword;
		$sql->gambar    	= $gambar;
		$sql->created_at	= Carbon::now();
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/blog');
						
	}//<--- END METHOD
	
	public function editBlog($id) {
		
		$blog        = Blog::find( $id );
		
		return view('admin.edit-blog')->with('blog',$blog);
				
	}//<--- END METHOD
	
	public function updateBlog( Request $request ) {
		
		
		$blog        = Blog::find( $request->id );
		$temp           = 'public/temp/'; // Temp
	    $path           = 'public/img-blog/'; // Path General
	    
	    if( !isset($blog) ) {
			return redirect('panel/admin/blog');
		}
			
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'judul'        => 'required',
            'isi'        => 'required',
	        //'gambar'   => 'mimes:jpg,gif,png,jpe,jpeg|image_size:>=400,>=400',
	     );
		
		$this->validate($request, $rules);	
		
		if( $request->hasFile('gambar') )	{
		
		$extension        = $request->file('gambar')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('gambar')->getMimeType();
		$sizeFile         = $request->file('gambar')->getSize();
		$gambar           = $request->id.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('gambar')->move($temp, $gambar) ) {
			
			$image = Image::make($temp.$gambar);
			
			if(  $image->width() == 400 && $image->height() == 400 ) {
				
					\File::copy($temp.$gambar, $path.$gambar);
					\File::delete($temp.$gambar);
			
			} else {
				$image->fit(400, 400)->save($temp.$gambar);
				
				\File::copy($temp.$gambar, $path.$gambar);
				\File::delete($temp.$gambar);
			}
			
			// Delete Old Image
			\File::delete($path.$blog->gambar);
			
			}// End File
		} // HasFile
		else {
			$gambar = $blog->gambar;
		}	
		
		// UPDATE CATEGORY
		$blog->judul    = $request->judul;
		$blog->isi    	= $request->isi;
		$blog->gambar   = $gambar;
		$blog->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/blog');
				
	}//<--- END METHOD
	
	public function deleteBlog($id){
		
		$blog        = Blog::find( $id );
		$gambar         = 'public/img-blog/'.$blog->gambar; // Path General
		
		if( !isset($blog) ) {
			return redirect('panel/admin/blog');
		} else {
					
			// Delete Category	
			$blog->delete();
			
			// Delete Thumbnail
			if ( \File::exists($gambar) ) {
				\File::delete($gambar);	
			}//<--- IF FILE EXISTS
			
			return redirect('panel/admin/blog');
		}	
	}//<--- END METHOD
	//end edited cacip

	//edited untuk media
	// START
	public function media() {
		
		$media      = Media::orderBy('nama')->get();
		$totalMedia = count( $media );
		
		return view('admin.media', compact( 'media', 'totalMedia' ));
				
	}//<--- END METHOD
	
	public function addMedia() {
		
		return view('admin.add-media');
				
	}//<--- END METHOD
	
	public function storeMedia(Request $request) {
		
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-media/'; // Path General
	    					
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'nama'        => 'required',
            'link'        => 'required',
	        //'deskripsi'        => 'required|ascii_only|unique:categories',
	        'gambar'   => 'mimes:jpg,gif,png,jpe,jpeg|image_size:>=200,>=200',
        );
		
		$this->validate($request, $rules);
		
		if( $request->hasFile('gambar') )	{
		
		$extension        = $request->file('gambar')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('gambar')->getMimeType();
		$sizeFile         = $request->file('gambar')->getSize();
		$gambar        	  = $request->id.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('gambar')->move($temp, $gambar) ) {
			
			$image = Image::make($temp.$gambar);
				
				\File::copy($temp.$gambar, $path.$gambar);
		 		\File::delete($temp.$gambar);
			// if(  $image->width() == 200 && $image->height() == 200 ) {
				
			// 		\File::copy($temp.$gambar, $path.$gambar);
			// 		\File::delete($temp.$gambar);
			
			// } else {
			// 	$image->fit(200, 200)->save($temp.$gambar);
				
			// 	\File::copy($temp.$gambar, $path.$gambar);
			// 	\File::delete($temp.$gambar);
			// }
			
			}// End File
		} // HasFile
		
		$sql			= New Media;
		$sql->nama 		= $request->nama; 
		$sql->link 		= $request->link; 
		$sql->deskripsi	= $request->deskripsi;
		$sql->gambar    = $gambar;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/media');
						
	}//<--- END METHOD
	
	public function editMedia($id) {
		
		$media        = Media::find( $id );
		
		return view('admin.edit-media')->with('media',$media);
				
	}//<--- END METHOD
	
	public function updateMedia( Request $request ) {
		
		
		$media        = Media::find( $request->id );
		$temp           = 'public/temp/'; // Temp
	    $path           = 'public/img-media/'; // Path General
	    
	    if( !isset($media) ) {
			return redirect('panel/admin/media');
		}
			
		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});
		
		$rules = array(
            'nama'        => 'required',
            'link'        => 'required',
	        //'slug'        => 'required|ascii_only|unique:categories,slug,'.$request->id,
	        'gambar'   => 'mimes:jpg,gif,png,jpe,jpeg|image_size:>=200,>=200',
	     );
		
		$this->validate($request, $rules);	
		
		if( $request->hasFile('gambar') )	{
		
		$extension        = $request->file('gambar')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('gambar')->getMimeType();
		$sizeFile         = $request->file('gambar')->getSize();
		$gambar           = $request->id.'-'.str_random(32).'.'.$extension;
		
		if( $request->file('gambar')->move($temp, $gambar) ) {
			
			$image = Image::make($temp.$gambar);

				\File::copy($temp.$gambar, $path.$gambar);
		 		\File::delete($temp.$gambar);
			// if(  $image->width() == 200 && $image->height() == 200 ) {
				
			// 		\File::copy($temp.$gambar, $path.$gambar);
			// 		\File::delete($temp.$gambar);
			
			// } else {
			// 	$image->fit(200, 200)->save($temp.$gambar);
				
			// 	\File::copy($temp.$gambar, $path.$gambar);
			// 	\File::delete($temp.$gambar);
			// }
			
			// Delete Old Image
			\File::delete($path.$media->gambar);
			
			}// End File
		} // HasFile
		else {
			$gambar = $media->gambar;
		}	
		
		// UPDATE CATEGORY
		$media->nama         = $request->nama;
		$media->link         = $request->link;
		$media->deskripsi    = $request->deskripsi;
		$media->gambar       = $gambar;
		$media->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/media');
				
	}//<--- END METHOD
	
	public function deleteMedia($id){
		
		$media        = Media::find( $id );
		$gambar         = 'public/img-media/'.$media->gambar; // Path General
		
		if( !isset($media) ) {
			return redirect('panel/admin/media');
		} else {
					
			// Delete Category	
			$media->delete();
			
			// Delete Thumbnail
			if ( \File::exists($gambar) ) {
				\File::delete($gambar);	
			}//<--- IF FILE EXISTS
			
			return redirect('panel/admin/media');
		}	
	}//<--- END METHOD
	//end edited cacip

	//edited untuk masalah
	// START
	public function masalah() {
		
		$masalah      = LaporanMasalah::join('status_laporan_masalah','status_laporan_masalah.id','=','laporan_masalah.id_status_laporan')
							->select('laporan_masalah.id','laporan_masalah.title','laporan_masalah.description','laporan_masalah.location','laporan_masalah.date','status_laporan_masalah.status')->orderBy('laporan_masalah.id','DESC')->get();
		
		$totalMasalah = count( $masalah );
		
		return view('admin.masalah', compact( 'masalah', 'totalMasalah' ));
				
	}//<--- END METHOD
	
	public function editMasalah($id) {
		
		$masalah        = LaporanMasalah::join('users','users.id','=','laporan_masalah.id_user')
			->select('laporan_masalah.id','laporan_masalah.title','laporan_masalah.description','laporan_masalah.location',
				'laporan_masalah.date','laporan_masalah.id_user','laporan_masalah.id_status_laporan','users.name')->find( $id );
		
		return view('admin.edit-masalah')->with('masalah',$masalah);
				
	}//<--- END METHOD
	
	public function updateMasalah( Request $request ) {
		
		
		$masalah        = LaporanMasalah::find( $request->id );
		
		// UPDATE CATEGORY
		$masalah->id_status_laporan         = $request->id_status_laporan;
		$masalah->date_update         = Carbon::now();
		$masalah->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/masalah');
				
	}//<--- END METHOD
	
	public function deleteMasalah($id){
		
		$masalah        = LaporanMasalah::find( $id );
		$masalah->delete();
		return redirect('panel/admin/masalah');
		
	}//<--- END METHOD
	//end edited cacip


	//edited cacip untuk Nilai
	// START
	public function nilai(){
		$nilai      = Nilai::findOrFail(1);
		return view('admin.nilai-settings', ['nilai' => $nilai, 'settings' => $nilai]);
	}//<--- End Method
	
	public function saveNilai(Request $request) {
			
		$sql = Nilai::find(1);

	    $sql->sampah_terkumpul     	= $request->sampah_terkumpul;
		$sql->panti_hewan    		= $request->panti_hewan;
		$sql->hewan_tertangani   	= $request->hewan_tertangani;
		$sql->laporan_alam   		= $request->laporan_alam;
		
		$sql->save();
	
	    \Session::flash('success_message', trans('admin.success_update'));
	
	    return redirect('panel/admin/nilai');
	}//<--- End Method

			
}// End Class