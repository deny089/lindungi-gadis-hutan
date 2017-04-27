<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $guarded = array();
	protected $table = 'partner';
	//protected $primaryKey = 'id';
	protected $fillable = ['nama','deskripsi','gambar'];
	public $timestamps = false;
	
	
}
