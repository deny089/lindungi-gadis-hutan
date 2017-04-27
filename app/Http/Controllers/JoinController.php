<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_campaign;
use App\Models\Campaigns;
use App\Models\Donations;
use App\Models\Pohon;
use Validator;
use App\Models\AdminSettings;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class JoinController extends Controller
{
     public function join($id_user, $id_campaign)
    {
        
        $response = Campaigns::where('id',$id_campaign)->where('status','active')->firstOrFail();
        $user = Auth::user();
        $id_user = Auth::id();
        $id_campaign = Campaigns::where('id',$id_campaign)->value('id');
        $relate = User_campaign::where('id_user', $id_user)->where('id_campaign', $id_campaign)->get();
        $joined = count($relate);
        $campaign = Campaigns::findOrFail($id_campaign);
        $user = Auth::id();

        $donasi_campaign = Donations::where('campaigns_id', $id_campaign)->sum('donation');
        $harga = Campaigns::where('id', $id_campaign)->value('hargapohon');
        if($donasi_campaign == 0 || $harga == 0){
            $jumlahdonasi = 0;
        }else{
            $jumlahdonasi = $donasi_campaign / $harga ;
        }

        // Redirect if campaign is ended
        if( Auth::check() ) {
            if( $campaign->finalized == 1 ) {
                return 'Campaign is Finished';
            }

        $sql                 = new User_campaign;
        $sql->id_user        = $user;
        $sql->id_campaign    = $campaign->id;
        $sql->save();

        return redirect('campaign/'.$campaign->id.'/');
        
         
        }
        return 'Please Login or Sign Up to Join Volunteer';
        
    }// End Method

          //transfer bank
    public function rekening($id)
    {
        $donasi = Donations::findOrFail($id);
        //$response = Campaigns::where('id',$id)->where('status','active')->firstOrFail();
        $jumlahdonasi           = $donasi->donation;
        $id_user = Auth::id();
	   $id_campaign = Donations::where('id', $id)->value('campaigns_id');
       $campaign = Campaigns::where('id',$id_campaign)->get()->first();
       $pohon = Pohon::where('id_pohon',  $campaign->id_pohon )->get()->first();
       $emisi = ( $jumlahdonasi / $pohon->harga ) * ( $pohon->emisi   / 100 ) * ( 1/ 365 ) * (100 / 100 );
        //$jumlahdonasi = $donasi * $campaign->hargapohon;

        return view('index.rekening', ['donasi' => $jumlahdonasi, 'id_user'=>$id_user, 'id_campaign'=>$id_campaign, 'pohon' => $pohon, 'emisi' => $emisi , 'campaign' => $campaign ]);
        //return 'jos gandos';
        //return view('default.donate', ['joined'=> $joined, 'id_user'=>$id_user, 'id_campaign'=>$id_campaign])->withResponse($response);
    }// End Method
}
