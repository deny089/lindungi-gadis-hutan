<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = array();
	protected $table = 'media';
	//protected $primaryKey = 'id';
	protected $fillable = ['nama','deskripsi','gambar','link'];
	public $timestamps = false;
	
	
}
