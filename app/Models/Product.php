<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type','name','barcode','brand_id','product_category_id',
        'tax_id','tax_method','purchase_id','product_unit_id','sale_unit_id',
        'purchase_unit_id','cost','price','image','details','alert_quantity','discount',
    ];

    public function product_category(){
        return $this->belongsTo(ProductCategory::class);
    }

    

    public function product_unit(){
        return $this->belongsTo(Unit::class);
    }

    public function purchase_unit(){
        return $this->belongsTo(Unit::class);
    }

    public function sale_unit(){
        return $this->belongsTo(Unit::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function tax(){
        return $this->belongsTo(Tax::class);
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
