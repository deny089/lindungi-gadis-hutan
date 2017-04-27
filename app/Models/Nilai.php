<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $guarded = array();
	protected $table = 'nilai';
	//protected $primaryKey = 'id';
	protected $fillable = ['sampah_terkumpul','panti_hewan','hewan_tertangani','laporan_alam'];
	public $timestamps = false;
	
	
}
