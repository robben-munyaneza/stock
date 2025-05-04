<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  use HasFactory;
  protected $table = 'products';
  protected $primaryKey = 'pcode';
  public $incrementing =  true;
  protected $keyType = 'int';

  protected $fillable = [
 'pname',

  ];

    // Relationship to Productin
    public function productins()
    {
        return $this->hasMany(Productin::class, 'pcode', 'pcode');
    }

    // Relationship to Productiout
    public function productouts()
    {
        return $this->hasMany(Productout::class, 'pcode', 'pcode');
    
  }

}
