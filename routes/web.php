<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/* 
 |-----------------------------------
 | Index
 |-----------------------------------
 */
Route::get('/', 'HomeController@index');

Route::get('home/campaigns', 'HomeController@campaigns');
Route::get('home/join', 'HomeController@join');

Route::get('home', function(){
	return redirect('/');
});

/* 
 |
 |-----------------------------------
 | Search
 |--------- -------------------------
 */
Route::get('search', 'HomeController@search');

/* 
 |
 |-----------------------------------
 | Categories List
 |--------- -------------------------
 */
Route::get('category/{slug}','HomeController@category');

// Categories
Route::get('categories', function(){
 	
	$data = App\Models\Categories::where('mode','on')->orderBy('name')->get();
	
	return view('default.categories')->withData($data);
});


/* 
 |
 |-----------------------------------
 | Verify Account
 |--------- -------------------------
 */
Route::get('verify/account/{confirmation_code}', 'HomeController@getVerifyAccount')->where('confirmation_code','[A-Za-z0-9]+');

/* 
/* 
 |-----------------------------------
 | Authentication
 |-----------------------------------
 */	
Auth::routes();

// Logout
Route::get('/logout', 'Auth\LoginController@logout');

/* 
 |
 |-----------------------------------------------
 | Ajax Request
 |--------- -------------------------------------
 */
Route::get('ajax/donations', 'AjaxController@donations');
Route::get('ajax/campaign/updates', 'AjaxController@updatesCampaign');
Route::get('ajax/campaigns', 'AjaxController@campaigns');
Route::get('ajax/category', 'AjaxController@category');
Route::get('ajax/search', 'AjaxController@search');

/* 
 |
 |-----------------------------------
 | Contact Organizer
 |-----------------------------------
 */

Route::post('contact/organizer','CampaignsController@contactOrganizer');

/* 
 |
 |-----------------------------------
 | Details Campaign
 |--------- -------------------------
 */
Route::get('campaign/{id}/{slug?}','CampaignsController@view');

/* 
 |
 |-----------------------------------
 | User Views LOGGED
 |--------- -------------------------
 */
Route::group(['middleware' => 'auth'], function() {
	
	//edited cacip
	//laporkan masalah

	Route::get('home/lapor', function(){
		return view('index.lapor');
	});
	Route::post('home/lapor','HomeController@lapor');

	Route::get('home/laporsukses', function(){
		return view('index.laporsukses');
	});

	//<-------------- Create Campaign
	Route::get('create/campaign', function(){
	return view('campaigns.create');
	});
	//  Post
	Route::post('create/campaign','CampaignsController@create');
	
	//<-------------- Edit Campaign
	Route::get('edit/campaign/{id}','CampaignsController@edit');
	Route::post('edit/campaign/{id}','CampaignsController@post_edit');
	
	//<-------------- Post a Update
	Route::get('update/campaign/{id}','CampaignsController@update');
	Route::post('update/campaign/{id}','CampaignsController@post_update');
	
	//<-------------- Edit post a Update
	Route::get('edit/update/{id}','CampaignsController@edit_update');
	Route::post('edit/update/{id}','CampaignsController@post_edit_update');
	
	Route::post('delete/image/updates','CampaignsController@delete_image_update');
	
	// Delete Campaign
	Route::get('delete/campaign/{id}','CampaignsController@delete');
	
	// Withdrawal
	Route::get('account/withdrawals','CampaignsController@show_withdrawal');
	Route::post('campaign/withdrawal/{id}','CampaignsController@withdrawal');
	
	Route::get('account/withdrawals/configure', function(){
	return view('users.withdrawals-configure');
	});
	
	Route::post('withdrawals/configure/{type}','CampaignsController@withdrawalConfigure');
	
	Route::post('delete/withdrawal/{id}','CampaignsController@withdrawalDelete');
	
	// Account Settings
	Route::get('account','UserController@account');
	Route::post('account','UserController@update_account');
	
	// Password
	Route::get('account/password','UserController@password');
	Route::post('account/password','UserController@update_password');
	
	// Upload Avatar
	Route::post('upload/avatar','UserController@upload_avatar');
	
	// Campaigns
	Route::get('account/campaigns', function(){
	return view('users.campaigns');
	});
	
	// Donations
	Route::get('account/donations', function(){
	return view('users.donations');
	});
	
});
/* 
 |
 |-----------------------------------
 | Admin Panel
 |--------- -------------------------
 */
Route::group(['middleware' => 'role'], function() {
	
    // Upgrades
	Route::get('update/{version}','UpgradeController@update');
	
	// Dashboard
	Route::get('panel/admin','AdminController@admin');
	
	// Settings
	Route::get('panel/admin/settings','AdminController@settings');
	Route::post('panel/admin/settings','AdminController@saveSettings');
	
	// Limits
	Route::get('panel/admin/settings/limits','AdminController@settingsLimits');
	Route::post('panel/admin/settings/limits','AdminController@saveSettingsLimits');
	
	// Campaigns
	Route::get('panel/admin/campaigns','AdminController@campaigns');
	Route::post('panel/admin/campaigns','AdminController@saveCampaigns');
	
	// Edit Campaign
	Route::get('panel/admin/campaigns/edit/{id}','AdminController@editCampaigns');
	Route::post('panel/admin/campaigns/edit/{id}','AdminController@postEditCampaigns');
	
	// Pantau Campaign
	Route::get('panel/admin/campaigns/pantau/{id}','AdminController@pantauCampaigns');
	Route::post('panel/admin/campaigns/pantau/{id}','AdminController@postPantauCampaigns');
	
	//Withdrawals
	Route::get('panel/admin/withdrawals','AdminController@withdrawals');
	Route::get('panel/admin/withdrawal/{id}','AdminController@withdrawalsView');
	Route::post('panel/admin/withdrawals/paid/{id}','AdminController@withdrawalsPaid');
	
	Route::post('paypal/withdrawal/ipn','AdminController@withdrawlsIpn');
	
	
	// Delete Campaign
	Route::post('panel/admin/campaign/delete','AdminController@deleteCampaign');
	
	// Donations
	Route::get('panel/admin/donations','AdminController@donations');
	Route::get('panel/admin/saveconfirmed/{id}','AdminController@saveconfirmed');
	Route::get('panel/admin/donations/{id}','AdminController@donationView');
	Route::get('panel/admin/donations/delete/{id}','AdminController@deleteDonation');
	
	// Members
	Route::resource('panel/admin/members', 'AdminController', 
		['names' => [
		    'edit'    => 'user.edit',
		    'destroy' => 'user.destroy'
		 ]]
	);
	
	// Add Member
	Route::get('panel/admin/member/add','AdminController@add_member');
	Route::post('panel/admin/member/add','AdminController@storeMember');
	
	// Pages
	Route::resource('panel/admin/pages', 'PagesController', 
		['names' => [
		    'edit'    => 'pages.edit',
		    'destroy' => 'pages.destroy'
		 ]]
	);
	
	// Reward
	Route::get('panel/admin/reward','AdminController@reward');
	Route::get('panel/admin/reward/add','AdminController@addReward');
	Route::post('panel/admin/reward/add','AdminController@storeReward');
	
	// Payments Settings
	Route::get('panel/admin/payments','AdminController@payments');
	Route::post('panel/admin/payments','AdminController@savePayments');
	
	// Profiles Social
	Route::get('panel/admin/profiles-social','AdminController@profiles_social');
	Route::post('panel/admin/profiles-social','AdminController@update_profiles_social');
	
	// Admin categories
	Route::get('panel/admin/categories','AdminController@categories');
	Route::get('panel/admin/categories/add','AdminController@addCategories');
	Route::post('panel/admin/categories/add','AdminController@storeCategories');
	Route::get('panel/admin/categories/edit/{id}','AdminController@editCategories')->where(array( 'id' => '[0-9]+'));
	Route::post('panel/admin/categories/update','AdminController@updateCategories');
	Route::get('panel/admin/categories/delete/{id}','AdminController@deleteCategories')->where(array( 'id' => '[0-9]+'));
	
	// edited cacip
	// Admin pohon
	Route::get('panel/admin/pohon','AdminController@pohon');
	Route::get('panel/admin/pohon/add','AdminController@addPohon');
	Route::post('panel/admin/pohon/add','AdminController@storePohon');
	Route::get('panel/admin/pohon/edit/{id_pohon}','AdminController@editPohon');
	Route::post('panel/admin/pohon/update','AdminController@updatePohon');
	Route::get('panel/admin/pohon/delete/{id_pohon}','AdminController@deletePohon');

	// Admin testimoni
	Route::get('panel/admin/testimoni','AdminController@testimoni');
	Route::get('panel/admin/testimoni/add','AdminController@addTestimoni');
	Route::post('panel/admin/testimoni/add','AdminController@storeTestimoni');
	Route::get('panel/admin/testimoni/edit/{id}','AdminController@editTestimoni');
	Route::post('panel/admin/testimoni/update','AdminController@updateTestimoni');
	Route::get('panel/admin/testimoni/delete/{id}','AdminController@deleteTestimoni');

	// Admin partner
	Route::get('panel/admin/partner','AdminController@partner');
	Route::get('panel/admin/partner/add','AdminController@addPartner');
	Route::post('panel/admin/partner/add','AdminController@storePartner');
	Route::get('panel/admin/partner/edit/{id}','AdminController@editPartner');
	Route::post('panel/admin/partner/update','AdminController@updatePartner');
	Route::get('panel/admin/partner/delete/{id}','AdminController@deletePartner');

	// Admin blog
	Route::get('panel/admin/blog','AdminController@blog');
	Route::get('panel/admin/blog/add','AdminController@addBlog');
	Route::post('panel/admin/blog/add','AdminController@storeBlog');
	Route::get('panel/admin/blog/edit/{id}','AdminController@editBlog');
	Route::post('panel/admin/blog/update','AdminController@updatePartner');
	Route::get('panel/admin/blog/delete/{id}','AdminController@deleteBlog');

	// Admin masalah
	Route::get('panel/admin/masalah','AdminController@masalah');
	Route::get('panel/admin/masalah/edit/{id}','AdminController@editMasalah');
	Route::post('panel/admin/masalah/update','AdminController@updateMasalah');
	Route::get('panel/admin/masalah/delete/{id}','AdminController@deleteMasalah');

	// Admin media
	Route::get('panel/admin/media','AdminController@media');
	Route::get('panel/admin/media/add','AdminController@addMedia');
	Route::post('panel/admin/media/add','AdminController@storeMedia');
	Route::get('panel/admin/media/edit/{id}','AdminController@editMedia');
	Route::post('panel/admin/media/update','AdminController@updateMedia');
	Route::get('panel/admin/media/delete/{id}','AdminController@deleteMedia');

	// Admin nilai
	Route::get('panel/admin/nilai','AdminController@nilai');
	Route::post('panel/admin/nilai','AdminController@saveNilai');
	//end edited cacip

});

/* 
 |
 |-----------------------------------
 | Donations
 |--------- -------------------------
 */
Route::get('donate/{id}/{slug?}','DonationsController@show');
Route::post('donate/{id}','DonationsController@send');


//edited cacip
//donate tranfer
Route::get('join/rekening/{id}','JoinController@rekening');

// join volunteer
Route::get('join/{id_user}/{id_campaign}','JoinController@join');
Route::post('join/{id}','JoinController@send');


// Paypal IPN
Route::post('paypal/ipn','DonationsController@paypalIpn');


	Route::get('paypal/donation/success/{id}', function($id){
			
			session()->put('donation_success', trans('misc.donation_success'));
			return redirect("campaign/".$id);
	});
	

	Route::get('paypal/donation/cancel/{id}', function($id){
			
			session()->put('donation_cancel', trans('misc.donation_cancel'));
	       return redirect("campaign/".$id);
	});
	
/* 
 |
 |------------------------
 | Pages Static Custom
 |--------- --------------
 */
Route::get('page/{page}', function( $page ){
	
	$response = App\Models\Pages::where( 'slug','=', $page )->first();
	
	$total = count( $response );
	
	if( $total == 0 ) {
		abort(404);
	} else {
		
		$title = $response->title.' - ';
		return view('pages.home', compact('response', 'title'));
	}

})->where('page','[^/]*' );


