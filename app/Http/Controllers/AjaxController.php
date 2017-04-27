<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\Campaigns;
use App\Models\Categories;
use App\Models\Donations;
use App\Models\Updates;

class AjaxController extends Controller
{
	
	public function __construct( Request $request) {
		$this->request = $request;
	}
	
    /**
     *  
     * @return \Illuminate\Http\Response
     */
     
      public function campaigns()
    {
       
	   $settings = AdminSettings::first();
       $data      = Campaigns::orderBy('id','DESC')->paginate($settings->result_request);
		
		return view('ajax.campaigns',['data' => $data, 'settings' => $settings])->render();
    }
	
	public function category() {
		
		 $settings = AdminSettings::first();
		 
		 $slug = $this->request->slug;
			
		 $category = Categories::where('slug','=',$slug)->first();
	  	 $data       = Campaigns::where('status', 'active')->where('categories_id',$category->id)->orderBy('id','DESC')->paginate($settings->result_request);
		
		return view('ajax.campaigns',['data' => $data, 'settings' => $settings, 'slug' => $category->slug])->render();		
		
	}// End Method
	
    public function donations()
    {
       
	   $settings = AdminSettings::first();
		$page   = $this->request->input('page');
		$id        = $this->request->input('id');
		$data    = Donations::where('campaigns_id',$id)->where('confirmed','1')->orderBy('id','desc')->paginate(10);

 		return view('ajax.donations',['data' => $data, 'settings' => $settings])->render();

    }//<--- End Method
    
    public function updatesCampaign()
    {
       
	    $settings = AdminSettings::first();
		$page     = $this->request->input('page');
		$id         = $this->request->input('id');
		$data     = Updates::where('campaigns_id',$id)->orderBy('id','desc')->paginate(1);

 		return view('ajax.updates-campaign',['data' => $data, 'settings' => $settings])->render();

    }//<--- End Method
    
    public function search() {
		
		 $settings = AdminSettings::first();
		 
		 $q = $this->request->slug;
		
		$data = Campaigns::where( 'title','LIKE', '%'.$q.'%' )
		->where('status', 'active' )
		->orWhere('location','LIKE', '%'.$q.'%')
		->where('status', 'active' )
		->groupBy('id')
		->orderBy('id', 'desc' )
		->paginate( $settings->result_request );
		
		return view('ajax.campaigns',['data' => $data, 'settings' => $settings, 'slug' => $q])->render();		
		
	}// End Method
    
	
}
