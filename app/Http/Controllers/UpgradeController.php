<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categories;
use App\Models\User;
use App\Models\AdminSettings;

class UpgradeController extends Controller {
	
	public function update($version) {
		
		//<--- Version 1.2
		if( $version == '1.2' ) {
			 
			 $category = Categories::first();
			 $upgradeDone = '<h2 style="text-align:center; margin-top: 30px; font-family: Arial, san-serif;color: #4BBA0B;">'.trans('admin.upgrade_done').' <a style="text-decoration: none; color: #F50;" href="'.url('/').'">'.trans('error.go_home').'</a></h2>';
			
			if( isset($category->image) ) {
				return redirect('/');
			} else {
				
				Schema::table('categories', function($table){
					$table->string('image', 200)->after('mode');
				 });
				 
				return $upgradeDone;
			}
			
		}//<--- Version 1.2

	}//<--- End Method

}
