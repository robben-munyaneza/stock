<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productout extends Model
{
    use HasFactory;
    protected $table = 'productouts';
 
    protected $fillable = [
     'pcode',
      'productout_date',
      'productout_quantity',
      'productout_unitprice',
      'productout_totalprice',
 
    ];
    public function product(){
 
     return $this->belongsTo(Product::class, 'pcode', 'pcode');
 
    }

    public function productin(){
        return $this->belongsTo(Productin::class, 'productin_id');
    }
}
