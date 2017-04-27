<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\Campaigns;
use App\Models\Donations;
use App\Models\User;
use App\Models\User_campaign;
//use App\Models\User;
use Fahim\PaypalIPN\PaypalIPNListener;
use App\Helper;
use Mail;

class DonationsController extends Controller
{

	//use RegistersUsers;

	public function __construct( AdminSettings $settings, Request $request) {
		$this->middleware('guest');
		$this->settings = $settings::first();
		$this->request = $request;
	}
	
    /**
     *  
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug = null)
    {
    	
	   $response = Campaigns::where('id',$id)->where('status','active')->firstOrFail();
	   $id_user = Auth::id();
		$id_campaign = Campaigns::where('id',$id)->value('id');
		$relate = User_campaign::where('id_user', $id_user)->where('id_campaign', $this->request->id)->get();
		$joined = count($relate);

	   // Redirect if campaign is ended
	   if( $response->finalized == 1 ) {
	   	 return redirect('campaign/'.$response->id);
	   }
		
		$uri = $this->request->path();
		
		if( str_slug( $response->title ) == '' ) {
				$slugUrl  = '';
			} else {
				$slugUrl  = str_slug( $response->title );
			}
			
			$url_image = 'donate/'.$response->id.'/'.$slugUrl;
			
			//<<<-- * Redirect the user real page * -->>>
			$uriImage     =  $this->request->path();
			$uriCanonical = $url_image;
			
			if( $uriImage != $uriCanonical ) {
				return redirect($uriCanonical);
			}
			
		return view('default.donate', ['joined'=> $joined, 'id_user'=>$id_user, 'id_campaign'=>$id_campaign])->withResponse($response);
    }// End Method
    

    public function send(){
    	
		$messages = array (
		'amount.min' => trans('misc.amount_minimum', ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),
	);
	
	$campaign = Campaigns::findOrFail($this->request->_id);
	
		$validator = Validator::make($this->request->all(), [
			'amount' => 'required|integer|min:1',
	        'full_name'     => 'required|max:25',
	        'email'     => 'required|max:100',
	        //'country'     => 'required',
	        //'postal_code'     => 'required|max:30',
	        'phone'     => 'required|max:15',
	        'comment'     => 'max:100',
    	],$messages);
		
		if ($validator->fails()) {
		        return response()->json([
				        'success' => false,
				        'errors' => $validator->getMessageBag()->toArray(),
				    ]);
		    }

	if( $this->request->transdonation == 1 ){
		//<----------- ****** PAYPAL ************** ----->
		if( $this->settings->payment_gateway == 'Paypal' ) {
			
			if ( $this->settings->paypal_sandbox == 'true') {
				// SandBox
				$action = "https://www.sandbox.paypal.com/cgi-bin/webscr";
				} else {
				// Real environment
				$action = "https://www.paypal.com/cgi-bin/webscr";
				}

			$urlSuccess = url('paypal/donation/success',$campaign->id);
			$urlCancel   = url('paypal/donation/cancel',$campaign->id);
			$urlPaypalIPN = url('paypal/ipn');

			return response()->json([
					        'success' => true,
					        'formPP' => '<form id="form_pp" name="_xclick" action="'.$action.'" method="post"  style="display:none">
					        <input type="hidden" name="cmd" value="_donations">
					        <input type="hidden" name="return" value="'.$urlSuccess.'">
					        <input type="hidden" name="cancel_return"   value="'.$urlCancel.'">
					        <input type="hidden" name="notify_url" value="'.$urlPaypalIPN.'">
					        <input type="hidden" name="currency_code" value="'.$this->settings->currency_code.'">
					        <input type="hidden" name="amount" id="amount" value="'.$this->request->amount.'">
					        <input type="hidden" name="custom" value="id='.$campaign->id.'&fn='.$this->request->full_name.'&mail='.$this->request->email.'&cm='.$this->request->comment.'&anonymous='.$this->request->anonymous.'">
					        <input type="hidden" name="item_name" value="'.trans('misc.donation_for').' '.$campaign->title.'">
					        <input type="hidden" name="business" value="'.$this->settings->paypal_account.'">
					        <input type="submit">
					        </form>',
					    ]);
			//untuk country dan postalcode -> '&cc='.$this->request->country.'&pc='.$this->request->postal_code.
		}//<----------- ****** PAYPAL ************** ----->
		
		if( $this->settings->payment_gateway == 'Stripe' ) {
			
			$email    = $this->request->email;
			$cents    = bcmul($this->request->amount, 100);
			$amount = (int)$cents;
			$currency_code = $this->settings->currency_code;
			$description = trans('misc.donation_for').' '.$campaign->title;
			$nameSite = $this->settings->title;
	 
			
			if( isset( $this->request->stripeToken ) ) {
				
					\Stripe\Stripe::setApiKey($this->settings->stripe_secret_key);
					
							
					// Get the credit card details submitted by the form
					$token = $this->request->stripeToken;
					
					// Create a charge: this will charge the user's card
					try {
					  $charge = \Stripe\Charge::create(array(
					    "amount" => $amount, // Amount in cents
					    "currency" => strtolower($currency_code),
					    "source" => $token,
					    "description" => $description
					    ));
						
						if( !isset( $this->request->anonymous ) ) {
							$this->request->anonymous = '0';
						}
						
						// Insert DB and send Mail
					  $sql = new Donations;
			          $sql->campaigns_id     = $campaign->id;
					  $sql->txn_id                  = 'null';
					  $sql->fullname              = $this->request->full_name;
					  $sql->email                   = $this->request->email;
					  //$sql->country                = $this->request->country;
					  //$sql->postal_code          = $this->request->postal_code;
					  $sql->phone          = $this->request->phone;
					  $sql->donation                = $this->request->amount;
					  $sql->payment_gateway  = 'Stripe';
					  $sql->comment               = $this->request->comment;
					  $sql->anonymous           = $this->request->anonymous;
						$sql->transferbank  = $this->request->transdonation ;
					  $sql->save();

					  
					  $sender           = $this->settings->email_no_reply;
					  $titleSite          = $this->settings->title;
					  $_emailUser    = $this->request->email;
					  $campaignID   = $campaign->id;
					  $fullNameUser = $this->request->fullname;
					  
					  Mail::send('emails.thanks-donor', array( 'data' => $campaignID, 'fullname' => $fullNameUser, 'title_site' => $titleSite ), 
						function($message) use ( $sender, $fullNameUser, $titleSite, $_emailUser)
							{
							    $message->from($sender, $titleSite)
							    	->to($_emailUser, $fullNameUser)
									->subject( trans('misc.thanks_donation').' - '.$titleSite );
							});
				
				return response()->json([
					        'success' => true,
					        'stripeSuccess' => true,
					        'url' => url('paypal/donation/success',$campaign->id)
					    ]);
														
					} catch(\Stripe\Error\Card $e) {
					  // The card has been declined
					}
			} else {
				return response()->json([
					        'success' => true,
					        'stripeTrue' => true,
					        "key" => $this->settings->stripe_public_key,
					        "email" => $email,
					         "amount" => $amount,
						    "currency" => strtoupper($currency_code),
						    "description" => $description,
						    "name" => $nameSite
					    ]);
			}
			
			

			
		}//<----------- ****** STRIPE ************** ----->
		
	} else {

		$donasi           = $this->request->amount;
		$jumlahdonasi	= $donasi * $campaign->hargapohon;

		if( !isset( $this->request->anonymous ) ) {
			$this->request->anonymous = '0';
		}
		if( !isset( $this->request->transdonation ) ) {
			$this->request->transdonation = '0';
		}

		$sql = new Donations;
		$sql->campaigns_id     = $campaign->id;
		$sql->txn_id                  = 'null';
		$sql->fullname              = $this->request->full_name;
		$sql->email                   = $this->request->email;
		//$sql->country                = $this->request->country;
		//$sql->postal_code          = $this->request->postal_code;
		$sql->phone          = $this->request->phone;
		$sql->donation                = $jumlahdonasi;
		$sql->transferbank  = $this->request->transdonation ;
		$sql->comment               = $this->request->comment;
		$sql->anonymous           = $this->request->anonymous;
		$sql->save();

		
		// register user
		$user_email = User::where('email', $this->request->email)->count();
		if( $user_email == 0 ){
			User::create([
			        'name' => $this->request->full_name,
			        'email' => $this->request->email,
			        'telpon' => $this->request->phone,
			        'password' => bcrypt('123456'),
			        'avatar' => 'default.jpg',
			        'status' => 'active',
			        'role' => 'normal'
		        ]);
		}

		//$donatID = Campaigns::findOrFail($this->request->_id);
		return response()->json([
					        'success' => true,
					        'stripeSuccess' => true,
					        'url' => url('join/rekening', $sql->id)
					    ]);

		//return view('index.rekening', ['donasi' => $jumlahdonasi]);

		
	}			
    	
    }// End Method
    
    public function paypalIpn(){
    	
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
	    
		//$report = Helper::checkTextDb($ipn->getTextReport()); // Report the transation
		
		$custom  = $_POST['custom'];
		parse_str($custom, $donation);
		
		$payment_status = $_POST['payment_status'];
		$txn_id               = $_POST['txn_id'];
		$amount             = $_POST['mc_gross'];
		
	
	    if ($verified) {
	        if($payment_status == 'Completed'){
	          // Check outh POST variable and insert in DB
	          
	          $verifiedTxnId = Donations::where('txn_id',$txn_id)->first();
	        
			if( !isset( $verifiedTxnId ) ) {
				
				$sql = new Donations;
		          $sql->campaigns_id = $donation['id'];
				  $sql->txn_id = $txn_id;
				  $sql->fullname = $donation['fn'];
				  $sql->email = $donation['mail'];
				  //$sql->country = $donation['cc'];
				  //$sql->postal_code = $donation['pc'];
				  $sql->donation = $amount;
				  $sql->payment_gateway = 'Paypal';
				  $sql->comment = $donation['cm'];
				  $sql->anonymous = $donation['anonymous'];
				  $sql->save();
				  
				  $sender           = $this->settings->email_no_reply;
				  $titleSite          = $this->settings->title;
				  $_emailUser    = $donation['mail'];
				  $campaignID   = $donation['id'];
				  $fullNameUser = $donation['fn'];
				  
				  Mail::send('emails.thanks-donor', array( 'data' => $campaignID, 'fullname' => $fullNameUser, 'title_site' => $titleSite ), 
					function($message) use ( $sender, $fullNameUser, $titleSite, $_emailUser)
						{
						    $message->from($sender, $titleSite)
						    	->to($_emailUser, $fullNameUser)
								->subject( trans('misc.thanks_donation').' - '.$titleSite );
						});
			}// <--- Verified Txn ID
		          
		          
	        } // <-- Payment status
	    } else {
	    	//Some thing went wrong in the payment !
	    }
    	
    }// End Method

    	
}
