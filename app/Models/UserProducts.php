<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProducts extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'user_id', 'product_id', 'quantity' ,'price'
    ];


    //relation with user in users table
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    //relaton with products in products table
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    //relaton with active products in products table
    public function activeProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id')->where('status','active');
    }


    public function createEntry($request)
    {
        return self::create($request);
    }

    static function updateEntry($request)
    { 
        return self::find($request['id'])->update($request);
    }
}
