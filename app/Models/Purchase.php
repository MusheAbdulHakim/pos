<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','supplier_id',
        'products','status','note'
    ];

    protected $casts = [
        'products' => 'array'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function purchaseProduct(){
        return $this->belongsTo(PurchaseProduct::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function tax(){
        return $this->belongsTo(Tax::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
