<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Models\AdminSettings;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'telpon' => 'required|max:20',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
	

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
    	$settings    = AdminSettings::first();
		
		// Verify Settings Admin
		if( $settings->email_verification == 1 ) {
			
			$confirmation_code = str_random(100);
			$status = 'pending';
			
			//send verification mail to user		 
		 $_username      = $data['name'];
	     $_email_user    = $data['email'];
		 $_title_site    = $settings->title;
		 $_email_noreply = $settings->email_no_reply;
				
		 Mail::send('emails.verify', array('confirmation_code' => $confirmation_code, 'title_site' => $_title_site ), 
		 function($message) use ( 
				 $_username, 
				 $_email_user, 
				 $_title_site, 
				 $_email_noreply 
		 ) {
                $message->from($_email_noreply, $_title_site);
                $message->subject(trans('users.title_email_verify'));
                $message->to($_email_user,$_username);
            });
			
		} else {
			$confirmation_code = '';
			$status            = 'active';
		}
		
		$token = str_random(75);
		
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telpon' => $data['telpon'],
            'countries_id' => $data['countries_id'],
            'kode_area' => $data['kode_area'],
            'password' => bcrypt($data['password']),
            'avatar' => 'default.jpg',
            'status' => $status,
            'role' => 'normal',
            'token' => $token,
            'confirmation_code' => $confirmation_code
        ]);
    }
}
