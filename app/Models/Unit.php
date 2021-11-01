<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','name','unit_id','operator','value'
    ];

    

   public function unit(){
       return $this->belongsTo(Unit::class);
   }
}
