<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_campaign extends Model
{
    protected $guarded = array();
	protected $table = 'user_campaign';
	//protected $primaryKey = 'id';
	protected $fillable = ['id_user','id_campaign'];
	public $timestamps = false;
	
	public function campaign(){
		return $this->hasMany('App\Models\Campaign');
	}
	
	public function user(){
		return $this->hasMany('App\Models\User');
	}
	
}
