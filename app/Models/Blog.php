<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = array();
	protected $table = 'blog';
	//protected $primaryKey = 'id';
	protected $fillable = ['judul','isi','created_at','keyword','gambar'];

	public $timestamps = false;
	
	
}
