<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $guarded = array();
	protected $table = 'testimoni';
	//protected $primaryKey = 'id';
	protected $fillable = ['nama','testimoni','gambar'];
	public $timestamps = false;
	
	
}