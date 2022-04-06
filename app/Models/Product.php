<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'title', 'description', 'image' ,'status'
    ];

     //relaton with active products in products table
    public function userProduct()
    {
        return $this->hasMany('App\Models\UserProducts', 'product_id');
    }
}
