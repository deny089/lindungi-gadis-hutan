<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Pohon extends Model
{
    protected $guarded = array();
	protected $table = 'pohon';
	protected $primaryKey = 'id_pohon';
	protected $fillable = ['nama','harga','deskripsi','emisi'];
	public $timestamps = false;
	
	public function campaigns() {
	 	 return $this->belongsTo('App\Models\Campaigns', 'id'); 
	 }
}
