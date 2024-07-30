<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_detail extends Model
{
    use HasFactory;
    protected $fillable=['order_id','product_id','Quantity'];
   protected $table = 'order_details';
    //Order Relationship
    public function orders(){
        return $this->belongsTo(Order::class);
    }
    //Products Relationship
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}