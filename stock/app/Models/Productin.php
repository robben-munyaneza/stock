<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productin extends Model
{
   use HasFactory;
   protected $table = 'productin';

   protected $fillable = [
    'pcode',
     'productin_date',
     'productin_quantity',
     'productin_unitprice',
     'productin_totalprice',

   ];
   public function product(){

    return $this->belongsTo(Product::class, 'pcode', 'pcode');

   }

   public function productouts(){
      return $this->hasMany(Productout::class, 'productin_id');
   }
}

