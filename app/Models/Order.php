<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
     protected $fillable=['country','first_name','last_name','company_name','address',
     'state_country','postal_zip','email_address','phone_no','total_bill','payment_status','user_id'];
    //user
    public function users()
    {
        return $this->belongsTo(User::class);
    }




}
